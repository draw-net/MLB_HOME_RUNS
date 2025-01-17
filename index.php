<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'modulo.php';



$caminhoArquivo = 'home_runs.csv';
$nomeTabela = 'HomeRuns';

function importCsv($servidor, $usuario, $senha, $dbname, $caminhoArquivo, $nomeTabela) {

    try {
         $conn = new mysqli($servidor, $usuario, $senha, $dbname);
         if ($conn->connect_error) {
             die("Erro de conexão: " . $conn->connect_error);
         }
     } catch (Exception $e) {
         die("Erro de conexão: " . $e->getMessage());
     }
   
    if (($handle = fopen($caminhoArquivo, "r")) !== FALSE) {
         fgetcsv($handle); // Ignorar a primeira linha (cabeçalho)
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
             var_dump($data);
             $sql = "INSERT INTO $nomeTabela (game_date, nome, hit_distance, exit_velocity, launch_angle, link_video) VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                echo "Erro na preparação da query: ".$conn->error;
                return false;
            }
            
             $date = DateTime::createFromFormat('m/d/Y', $data[0]);
            if($date)
                 $dateFormatted = $date->format('Y-m-d');
             else
                 $dateFormatted = null;
                
            $stmt->bind_param("ssdsss", $dateFormatted, $data[1], $data[2], $data[3], $data[4], $data[5]);
        
            if($stmt->execute() === FALSE)
             {
                 var_dump($stmt->error); // verificar erros na execução da query
                  echo "Erro ao executar query: ".$stmt->error;
                return false;
            }
           $stmt->close();
        }
        fclose($handle);
        $conn->close();
        return true;
    } else {
        echo "Erro ao abrir o arquivo CSV.";
        return false;
    }
    
}


if(importCsv($servidor, $usuario, $senha, $dbname, $caminhoArquivo, $nomeTabela))
    echo "CSV importado com sucesso utilizando método alternativo!";
else
     echo "Erro ao importar CSV utilizando método alternativo!";

// 3. Função para buscar home runs (será chamada pelo JavaScript)
function buscarHomeRun($conn, $nomeJogador) {
    $sql = "SELECT id, game_date, nome, hit_distance, exit_velocity, launch_angle, link_video FROM HomeRuns WHERE nome LIKE ? ORDER BY hit_distance DESC, exit_velocity DESC LIMIT 5";
    $stmt = $conn->prepare($sql);
    $nome_like = "%" . $nomeJogador . "%";
    $stmt->bind_param("s", $nome_like);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $homeRuns = [];
    while ($row = $resultado->fetch_assoc()) {
        $homeRuns[] = $row;
    }
    $stmt->close();
    return $homeRuns;
}

// 4. Função para buscar home runs por ID para trajetoria (será chamada pelo JavaScript)
function buscarHomeRunPorID($conn, $homeRunID) {
    $sql = "SELECT hit_distance, exit_velocity, launch_angle FROM HomeRuns WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $homeRunID);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $homeRun = $resultado->fetch_assoc();
    $stmt->close();
    return $homeRun;
}

// 5. Configurar cabeçalhos para requisições AJAX
header('Content-Type: application/json');

// 6. Verificar se a solicitação é para buscar home runs ou trajetória
if (isset($_GET['nome'])) {
    try {
        $conn = new mysqli($servidor, $usuario, $senha, $dbname);
        if ($conn->connect_error) {
            die(json_encode(["error" => "Erro de conexão: " . $conn->connect_error]));
        }

        $nomeJogador = $_GET['nome'];
        $homeRuns = buscarHomeRun($conn, $nomeJogador);
        echo json_encode($homeRuns);
        $conn->close();
    } catch (Exception $e) {
        die(json_encode(["error" => "Erro ao buscar home runs: " . $e->getMessage()]));
    }
} else if (isset($_GET['homeRunID'])) {
    try {
         $conn = new mysqli($servidor, $usuario, $senha, $dbname);
        if ($conn->connect_error) {
            die(json_encode(["error" => "Erro de conexão: " . $conn->connect_error]));
        }
        $homeRunID = $_GET['homeRunID'];
        $homeRun = buscarHomeRunPorID($conn, $homeRunID);
        echo json_encode($homeRun);
        $conn->close();
    } catch (Exception $e) {
        die(json_encode(["error" => "Erro ao buscar trajetória: " . $e->getMessage()]));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MLB Home Run Search</title>
    <style>
        /* Estilo da barra de navegação (similar ao seu código original) */
        nav {
            background-color: #041e42;
            overflow: hidden;
            font-family: sans-serif;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        nav a:hover {
            background-color: #223f5e;
        }
        @media screen and (max-width: 768px) {
            nav a {
                float: none;
                display: block;
                text-align: left;
                width: 100%;
                margin: 0;
                padding: 14px;
            }
        }
        #mlb-logo {
            float: left;
            height: 40px;
            padding: 6px 10px;
        }

         /* Estilos adicionais para o conteúdo principal */
         #video-container {
            display: none; /* Oculto inicialmente até encontrar um home run */
            margin: 20px auto; /* Centralizar e adicionar margem */
            max-width: 80%;  /* Reduzir a largura máxima */
            width: 800px;
            /*text-align: center;*/ /* Centralizar o vídeo */
            border: 1px solid #ccc;
         }

         #video-container video {
            width: 100%;
             max-width: 100%;
             display: block;
             /*padding-top: 20px;*/
         }

        #busca {
             margin: 20px auto;
             width: 800px;
             text-align: center;
         }
         #dados-homerun {
            margin-top: 20px;
            width: 800px;
            padding: 10px;
            border: 1px solid #eee;
            background-color: #f9f9f9;

         }
        #resultado {
            text-align: center;
            margin: 10px;
         }

         #canvas-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
         }

          #canvas-container  > div {
             display: flex;
            flex-direction: column;
            align-items: center;
        }

         canvas {
                background: white;
            }
         #result-table {
             width: 800px;
              margin: 0 auto;
                border-collapse: collapse;
                margin-bottom: 20px;
         }
         #result-table th, #result-table td {
                border: 1px solid black;
                padding: 8px;
            }
         #result-table th {
                background-color: #f2f2f2;
            }

    </style>
</head>
<body>
    <nav>
        <img id="mlb-logo" src="mlb_png.png" alt="MLB Logo">
        <a href="https://www.mlb.com/news">NEWS</a>
        <a href="https://www.mlb.com/WATCH">WATCH</a>
        <a href="https://www.mlb.com/SCHEDULE">SCHEDULE</a>
        <a href="https://www.mlb.com/STATS">STATS</a>
        <a href="https://www.mlb.com/STANDINGS">STANDINGS</a>
        <a href="https://www.youtube.com/@MLB">MLB.TV</a>
        <a href="https://www.mlb.com/TICKETS">TICKETS</a>
        <a href="https://www.mlb.com/SHOP">SHOP</a>
        <a href="https://www.mlb.com/TEAMS">TEAMS</a>
        <a href="https://www.sousatonet/mlb/index.php">HOME RUN</a>
    </nav>

     <div id="video-container">
        <video controls>
            <source src="" id="video-source">
            Seu navegador não suporta a tag de vídeo.
        </video>
        <div id="dados-homerun"></div>
    </div>

    <div id="busca">
         <input type="text" id="nome-jogador" placeholder="Nome do Jogador">
         <button onclick="buscarHomeRun()">Buscar</button>
    </div>

    <div id="resultado"></div>

     <div id="canvas-container">
        <div>
           <canvas id="trajectoryCanvas" width="600" height="400"></canvas>
           <button onclick="closeCanvas()" style="margin-top: 10px;">Fechar</button>
        </div>
    </div>


    <script>
      function closeCanvas() {
          document.getElementById('canvas-container').style.display = 'none';
      }

      let currentAnimationId;

      function buscarHomeRun() {
          const nomeJogador = document.getElementById('nome-jogador').value;
          const resultsDiv = document.getElementById('resultado');
          resultsDiv.innerHTML = '<p>Carregando...</p>';
          document.getElementById('video-container').style.display = 'none'; //esconder video ao buscar
            document.getElementById('dados-homerun').innerHTML = ''; //Limpar div dados-homerun

          fetch(`index.php?nome=${encodeURIComponent(nomeJogador)}`)
              .then(response => response.json())
              .then(data => {
                 resultsDiv.innerHTML = ''; // Limpar mensagem de carregando

                  if (data.error) {
                       resultsDiv.innerHTML = `<p style="color:red;">Erro: ${data.error}</p>`;

                    } else if (data.message) {
                        resultsDiv.innerHTML = `<p>${data.message}</p>`;

                    }else if (data && data.length > 0){

                        const table = document.createElement('table');
                        table.id = 'result-table';
                         // Criar cabeçalho da tabela
                        const headerRow = table.insertRow();
                        const headers = ["ID","Nome", "Data", "Distância", "Velocidade de Saída", "Ângulo de Saída", "Visualizar", "Video"];
                         headers.forEach(headerText => {
                            const th = document.createElement('th');
                            th.textContent = headerText;
                            headerRow.appendChild(th);
                         });

                         data.forEach(hr => {
                            const row = table.insertRow();

                            const idCell = row.insertCell();
                            idCell.textContent = hr.id;

                            const nameCell = row.insertCell();
                            nameCell.textContent = hr.nome;

                            const dateCell = row.insertCell();
                            dateCell.textContent = hr.game_date;

                            const distCell = row.insertCell();
                            distCell.textContent = hr.hit_distance;

                            const velCell = row.insertCell();
                            velCell.textContent = hr.exit_velocity;

                            const angleCell = row.insertCell();
                            angleCell.textContent = hr.launch_angle;

                             const viewCell = row.insertCell();
                            const viewButton = document.createElement('button');
                            viewButton.textContent = 'Visualizar';
                            viewButton.onclick = () => visualizeTrajectory(hr.id);
                            viewCell.appendChild(viewButton);

                            const videoCell = row.insertCell();
                            const videoButton = document.createElement('button');
                            videoButton.textContent = 'Video';
                            videoButton.onclick = () => exibirHomeRun(hr);
                            videoCell.appendChild(videoButton)

                        });
                       resultsDiv.appendChild(table);


                     } else {

                        resultsDiv.innerHTML = '<p>Nenhum home run encontrado para este jogador.</p>';

                     }

               })
               .catch(error => {
                   console.error('Erro na requisição:', error);
                    resultsDiv.innerHTML = '<p style="color:red;">Erro ao buscar home run. Tente novamente.</p>';
               });
       }


     function exibirHomeRun(dados) {

            document.getElementById('video-container').style.display = 'block';
            document.getElementById('video-source').src = dados.link_video;


             // Calcular o volume da bola (apenas para demonstração)
            const raio = 0.074; // Raio aproximado de uma bola de beisebol em metros (ajuste se necessário).
            const volume = 4/3 * Math.PI * Math.pow(raio, 3);

            document.getElementById('resultado').textContent = `Volume da bola (apenas demonstração): ${volume.toFixed(4)} metros cúbicos`;

             // Exibir dados do home run abaixo do vídeo
            const dadosHomerunDiv = document.getElementById('dados-homerun');
            dadosHomerunDiv.innerHTML = `
                <p>Nome: ${dados.nome}</p>
                <p>Exit Velocity: ${dados.exit_velocity}</p>
                <p>Hit Distance: ${dados.hit_distance}</p>
                <p>Launch Angle: ${dados.launch_angle}</p>
            `;
        }

        function visualizeTrajectory(homeRunID) {

           document.getElementById('canvas-container').style.display = 'flex';
           const canvas = document.getElementById('trajectoryCanvas');
           const ctx = canvas.getContext('2d');
           const raio = 0.5;
           let x = 0;
           let y = canvas.height;
           let tempo = 0;

           if (currentAnimationId) {
               cancelAnimationFrame(currentAnimationId);
           }

           fetch(`index.php?homeRunID=${encodeURIComponent(homeRunID)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                         alert("Erro ao buscar os dados da trajetória");
                    } else {

                       const distance = parseFloat(data.hit_distance);
                       const exitVelocity = parseFloat(data.exit_velocity);
                       const launchAngle = parseFloat(data.launch_angle);
                       let initialSpeedX = exitVelocity * Math.cos(launchAngle * (Math.PI / 180));
                       let initialSpeedY = -exitVelocity * Math.sin(launchAngle * (Math.PI / 180));

                        function animate() {
                            ctx.clearRect(0, 0, canvas.width, canvas.height);
                            ctx.beginPath();
                            ctx.arc(x, y, raio * 10, 0, 2 * Math.PI);
                            ctx.fillStyle = 'red';
                            ctx.fill();

                             x =  initialSpeedX * tempo;
                              y = canvas.height - (initialSpeedY * tempo + 0.5 * 9.8 * tempo * tempo);

                           tempo += 0.05;

                           if (y > canvas.height || x > canvas.width) {
                              return;
                            }

                             currentAnimationId = requestAnimationFrame(animate);

                         }
                       animate();
                     }
              })
             .catch(error => {
                   alert("Erro na requisição da trajetória");
              });
        }
    </script>
</body>
</html>
