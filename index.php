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
    <div id="message"></div>

    <script src="js/etherium_client.js"></script>
    <script>
         function closeCanvas(){
             document.getElementById('canvas-container').style.display = 'none';
         }
        let currentAnimationId;
        function searchHomeRuns() {
            const playerName = document.getElementById('nome-jogador').value;
            const resultsDiv = document.getElementById('resultado');
            resultsDiv.innerHTML = '<p>Carregando...</p>';


            fetch(`index.php?nome=${encodeURIComponent(playerName)}`)
                .then(response => response.json())
                .then(data => {
                resultsDiv.innerHTML = '';
                    if (data.error) {
                        resultsDiv.innerHTML = `<p style="color:red;">Erro: ${data.error}</p>`;
                    } else if(data.message){
                        resultsDiv.innerHTML = `<p>${data.message}</p>`;
                    } else if (data.length > 0) {
                         const table = document.createElement('table');
                        table.style.borderCollapse = 'collapse';
                        table.style.width = '100%';

                        // Criar cabeçalho da tabela
                        const headerRow = table.insertRow();
                        const headers = ["ID", "Data", "Distância", "Velocidade de Saída", "Ângulo de Saída", "Visualizar", "Vídeo"];
                        headers.forEach(headerText => {
                            const th = document.createElement('th');
                            th.textContent = headerText;
                            th.style.border = '1px solid black';
                            th.style.padding = '8px';
                            headerRow.appendChild(th);
                        });
                        data.forEach(hr => {
                            const row = table.insertRow();

                             const idCell = row.insertCell();
                            idCell.textContent = hr.id;
                            idCell.style.border = '1px solid black';
                            idCell.style.padding = '8px';
                            
                             const dateCell = row.insertCell();
                            dateCell.textContent = hr.game_date;
                            dateCell.style.border = '1px solid black';
                            dateCell.style.padding = '8px';

                            const distCell = row.insertCell();
                            distCell.textContent = hr.hit_distance;
                            distCell.style.border = '1px solid black';
                            distCell.style.padding = '8px';
                            
                            const velCell = row.insertCell();
                            velCell.textContent = hr.exit_velocity;
                            velCell.style.border = '1px solid black';
                            velCell.style.padding = '8px';

                            const angleCell = row.insertCell();
                            angleCell.textContent = hr.launch_angle;
                            angleCell.style.border = '1px solid black';
                            angleCell.style.padding = '8px';

                             const viewCell = row.insertCell();
                            const viewButton = document.createElement('button');
                            viewButton.textContent = 'Visualizar';
                            viewButton.onclick = () => visualizeTrajectory(hr.id);
                            viewCell.appendChild(viewButton);
                            viewCell.style.border = '1px solid black';
                            viewCell.style.padding = '8px';
                          
                            const videoCell = row.insertCell();
                            const videoButton = document.createElement('button');
                            videoButton.textContent = 'Video';
                            videoButton.onclick = () => exibirHomeRun(hr);
                            videoCell.appendChild(videoButton);
                             videoCell.style.border = '1px solid black';
                            videoCell.style.padding = '8px';
                        });

                        resultsDiv.appendChild(table);


                    } else {
                        resultsDiv.innerHTML = '<p>Nenhum home run encontrado para este jogador.</p>';
                    }
                })
                .catch(error => {
                    resultsDiv.innerHTML = `<p style="color:red;">Erro na requisição: ${error}</p>`;
                });
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

                                  ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpar o canvas

                                  // Desenhar a bola
                                   ctx.beginPath();
                                     ctx.arc(x, y, raio * 10, 0, 2 * Math.PI); // Aumenta o raio para visualização
                                   ctx.fillStyle = 'red';
                                     ctx.fill();


                                    // Cálculo da posição da bola
                                     x =  initialSpeedX * tempo;
                                     y = canvas.height - (initialSpeedY * tempo + 0.5 * 9.8 * tempo * tempo);


                                  tempo += 0.05; // Incrementar o tempo
                                  // Parar a animação quando a bola sair do canvas

                                  if(y > canvas.height || x > canvas.width){
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

    </script>
</body>
</html>
