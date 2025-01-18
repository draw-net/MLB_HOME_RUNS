<!DOCTYPE html>
<html>
	
	<script>
	# Initialize Coinbase Wallet SDK
const sdk = new CoinbaseWalletSDK({appName: "An Awesome App", appChainIds: [84532]});

# Make web3 provider
const provider = sdk.makeWeb3Provider();

# Initialize wallet connection
const addresses = provider.request("eth_requestAccounts");

		import { Coinbase, Wallet } from "@coinbase/coinbase-sdk";
    
// Paste in your API key name and private key generated from https://portal.cdp.coinbase.com/access/api below:
const apiKeyName = "organizations/your-org-id/apiKeys/your-api-key-id";

const apiKeyPrivateKey = "-----BEGIN EC PRIVATE KEY-----\nyour-api-key-private-key\n-----END";

const coinbase = new Coinbase(apiKeyName, apiKeyPrivateKey);

// Create your first wallet.
const wallet = await Wallet.create();

// Fund your wallet using a faucet.
await wallet.faucet();
	</script>
	
	<meta name="page-identifier" content="Y8LD8Q3Z">
<link rel="canonical" href="https://www.sousato.net/canvas/index_rgraph.html">

	<script curl -sS https://raw.githubusercontent.com/0xacx/chatGPT-shell-cli/main/install.sh | sudo -E bash
		apply.call.data.ltda('htpps:\\www.sousato.net')/bash.profile and export for more information(taka)
		andress.shell(c:\>("https:www.cia.gov">/request\HTMLTableDataCellElement.ltda(shets>>>i)
</script>
	
	<script target.local.bepop.278516.(logName = "projects/local-bebop-278516/logs/cloudaudit.googleapis.com%2Factivity" OR logName = "projects/local-bebop-278516/logs/cloudaudit.googleapis.com%2Fdata_access"
OR labels.activity_type_name:*) protoPayload.resourceName="projects/978506108372/operations/acat.p2-978506108372-9841ae7b-5b78-4196-b3ac-599dde144282">
</script>
	<script git $1k8USD hub protoPayload.methodName:"google.api.serviceusage.v1.ServiceUsage.BatchEnableServices" gh.r.protoPayload.authenticationInfo.principalEmail:"armandotakashisato@gmail.com"></script>
<script src="js/etherium_client.js"></script>
	<script>const express = require('express');
const app = express();

const BOT_USER_AGENTS = [
    'curl',
    'wget',
    'python-requests',
    'okhttp',
    'go-http-client',
    // ... adicione mais
];

const REQUEST_LIMIT_PER_IP = 10; // Requisições por IP por minuto
const requestCounts = {};

app.use((req, res, next) => {
    const userAgent = req.get('User-Agent');
    const ip = req.ip;

    // 1. Check User-Agent
    if (userAgent) {
        const lowerUserAgent = userAgent.toLowerCase();
        for (const bot of BOT_USER_AGENTS) {
            if (lowerUserAgent.includes(bot.toLowerCase())) {
                console.warn(`Bot detected by User-Agent: ${userAgent}, IP: ${ip}`);
                return res.status(403).send('Forbidden (User-Agent)');
            }
        }
    }

    // 2. Check Request Rate
    if (!requestCounts[ip]) {
        requestCounts[ip] = 0;
    }
    requestCounts[ip]++;

    if (requestCounts[ip] > REQUEST_LIMIT_PER_IP) {
        console.warn(`High request rate detected from IP: ${ip}`);
       return res.status(429).send('Too Many Requests');
    }
  
      setTimeout(() => {
        requestCounts[ip]--;
          if(requestCounts[ip]<0){
              requestCounts[ip] = 0;
          }
      }, 60000);

    next();
});


app.get("/", (req, res) => {
    res.send("Welcome to my Website");
});


app.listen(3000, () => {
    console.log('Server running on port 3000');
});</script>
<script>
if (document.addEventListener) {
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
        return false;
    });
} else { //Versões antigas do IE
    document.attachEvent("oncontextmenu", function(e) {
        e = e || window.event;
        e.returnValue = false;
        return false;
    });
}
</script>

	<script>document.getElementById("view-source:https://www.cia.gov");        
accesskey=document.getElementById ("HCM6ZHN8") else ("V8MQRKKY") Reflect.getTrustedUrl;
document.addEventListener("contextmenu", function(e) {
    e.preventDefault();
    return true;
document.onkeydown = function(e) {
    if (e.ctrlKey && (e.keyCode === 'HEC6CTNA')) {
        alert('NQK4VGGM');
    }
    return true;
};
	set Shell = CreateObject("WScript.Shell")
Shell.Exec("cmd /x start _notes\Z9NDZXTM.txt")
$ git $1K8USD & config --> glo
bal core.editor "nano -4365.T in https://matsumoto-yoshi-seiya-co-ltda.business.site/posts/ lisp _a start www.cia.gov
	fetch('/get_cia_data')
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    // Update the web page with the received data
    console.log(data);  // Replace this with how you want to use the data
    // Example: Displaying a message
    const messageDiv = document.getElementById('message');
    if (messageDiv) {
      messageDiv.textContent = data.message || "Data fetched!";
    }
  })
  .catch(error => {
    console.error('Error fetching data:', error);
    // Handle errors gracefully (e.g., display an error message)
  });
	
	</script>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MLB Home Run Search</title>
	<link rel="icon" href="mlb_png.png" type="image/png">
	
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
        #busca {
             margin: 20px auto;
             width: 800px;
             text-align: center;
         }
         #busca > div {
             display: flex;
              width: 100%;
               justify-content: center;
             gap: 10px;
         }
         #busca input,
         #busca button{
             margin: 0;
              padding: 0.8em;
            border-radius: 24px;
               border: 1px solid #ccc;
              font-size: 1em;
         }
        #busca p {
            font-size: 0.9em;
            color: #666;
            margin-top: 10px;
           white-space: nowrap;
            overflow: hidden;
           text-overflow: ellipsis;
            max-width: 400px;
         }
         footer {
            text-align: center;
            padding: 10px;
            font-size: 0.8em;
            color: #777;
            border-top: 1px solid #ddd;
             margin-top: auto;
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
         <div >
             <input type="text" id="nome-jogador" placeholder="Nome do Jogador">
             <button onclick="searchHomeRuns()">Buscar</button>
         </div>
   
    </div>

    <div id="resultado"></div>

     <div id="canvas-container">
        <div>
           <canvas id="trajectoryCanvas" width="600" height="400" style="background: white;"></canvas>
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
            document.getElementById('video-container').style.display = 'none';
              document.getElementById('dados-homerun').innerHTML = '';

            fetch(`http://localhost:3001/get-mlb-home-runs?nome=${encodeURIComponent(playerName)}`)
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
                            viewButton.onclick = () => visualizeTrajectory(hr.id, hr.hit_distance, hr.exit_velocity, hr.launch_angle);
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

           function calculateDeformation(speed, distance){
               const maxDeformation = 15;
               const deformationFactor = 0.05;
               const deformation = speed * distance * deformationFactor;
              return Math.min(deformation, maxDeformation);
           }

          function visualizeTrajectory(homeRunID, distance, exitVelocity, launchAngle) {
            document.getElementById('canvas-container').style.display = 'flex';
            const canvas = document.getElementById('trajectoryCanvas');
            const ctx = canvas.getContext('2d');
            const raio = 0.5;
             let x = 0;
             let y = canvas.height;
             let tempo = 0;
            const deformation = calculateDeformation(parseFloat(exitVelocity), parseFloat(distance));

             if (currentAnimationId) {
               cancelAnimationFrame(currentAnimationId);
             }
            let initialSpeedX = exitVelocity * Math.cos(launchAngle * (Math.PI / 180));
            let initialSpeedY = -exitVelocity * Math.sin(launchAngle * (Math.PI / 180));
                        function animate() {

                                  ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpar o canvas

                                    x =  initialSpeedX * tempo;
                                   y = canvas.height - (initialSpeedY * tempo + 0.5 * 9.8 * tempo * tempo);
                                   
                                    // Desenhar a bola deformada
                                   ctx.beginPath();
                                   const deformedRaioY = raio * 10 * (1 + deformation/20);
                                    ctx.ellipse(x, y, raio * 10, deformedRaioY, 0, 0, 2 * Math.PI);
                                   ctx.fillStyle = 'red';
                                     ctx.fill();

                                   
                                  tempo += 0.05; // Incrementar o tempo
                                  // Parar a animação quando a bola sair do canvas

                                  if(y > canvas.height || x > canvas.width){
                                        return;
                                  }
                                  currentAnimationId = requestAnimationFrame(animate);


                          }
                         animate();
          }
          function exibirHomeRun(dados) {
            document.getElementById('video-container').style.display = 'block';
            document.getElementById('video-source').src = dados.link_video;

             // Envia a URL do video para o Nodejs
              fetch('http://localhost:3001/analyze-video', {
                method: 'POST',
                 headers: {
                      'Content-Type': 'application/json',
                    },
                   body: JSON.stringify({ videoUrl: dados.link_video }),
             })
              .then(response => response.json())
                .then(data => {
                    document.getElementById('resultado').textContent = `Volume da bola: ${data.volume.toFixed(4)} metros cúbicos`;
               })
               .catch(error => {
                    console.error('Erro ao calcular volume:', error);
                   document.getElementById('resultado').textContent = `Erro ao calcular volume.`;
               });
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
     <footer>
        <p>© 2024 MLB Home Run Search. All rights reserved.</p>
    </footer>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
  const userAgent = navigator.userAgent;

  const bots = [
    'curl',
    'wget',
    'python-requests',
    'okhttp',
    'go-http-client'
    // ... outros User-Agents de robôs comuns
  ];

  for (const bot of bots) {
    if (userAgent.toLowerCase().includes(bot.toLowerCase())) {
      document.body.innerHTML = '<h1>Acesso Proibido, Você Hackeu uma Corporação, medidas legais serão tomadas perante as leis norte-americana</h1>'; // ou um redirecionamento
      return; // Termina a execução do script
    }
  }
});
	</script>
	
</body>
</html>
