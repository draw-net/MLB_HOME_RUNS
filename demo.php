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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MLB Home Run Search</title>
    <link rel="icon" href="mlb_png.png" type="image/png">
    <style>
        /* Estilos CSS */
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
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Garante que o body tenha pelo menos 100% da altura da viewport */
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        #canvas-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        #canvas-overlay-content{
            position: relative;
            width: 80%;
            height: 80%;
            border: none;
            overflow: hidden;
        }
        #close-canvas{
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            padding: 10px;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #ballWeightLabel{
             position: absolute;
             bottom: 20px;
             left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
</head>
<body>
<nav style="display:none;">
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

<div id="video-container" style="display:none;">
    <div id="dados-homerun"></div>
</div>

<div id="busca" style="display:none;">
    <div >
        <input type="text" id="nome-jogador" placeholder="Nome do Jogador">
        <button onclick="searchHomeRuns()">Buscar</button>
    </div>

</div>

<div id="resultado"></div>

<div id="canvas-container">
    <div id="canvas-overlay-content">
        <span id="close-canvas" onclick="closeCanvas()">X</span>
        <canvas id="trajectoryCanvas" width="600" height="400"></canvas>
        <label id="ballWeightLabel"></label>
    </div>
</div>
<div id="message"></div>
<div id="loading-overlay" >
    <img id="mlb-logo" src="mlb_png.png" alt="MLB Logo">
    <p style="font-size: 2em; color: #333; margin-top: 10px;">Em breve...</p>
</div>
<script src="js/etherium_client.js"></script>
<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'modulo.php';

// Conectar ao banco de dados usando as informações de modulo.php
$conexao = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$playerName = isset($_GET['nome']) ? $conexao->real_escape_string($_GET['nome']) : '';
$items_per_page = 10;

$sql_count = "SELECT COUNT(*) as total FROM mlb_homeruns";
$sql_data = "SELECT * FROM mlb_homeruns";

if (!empty($playerName)){
    $sql_count = "SELECT COUNT(*) as total FROM mlb_homeruns WHERE data LIKE '%" . $playerName . "%'";
    $sql_data = "SELECT * FROM mlb_homeruns WHERE data LIKE '%" . $playerName . "%'";
}

$result_count = $conexao->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_rows = $row_count['total'];
$total_pages = ceil($total_rows / $items_per_page);
$current_page = isset($_GET['page']) ? max(1, min($_GET['page'], $total_pages)) : 1;
$start_index = ($current_page - 1) * $items_per_page;


$sql_data .= " LIMIT {$start_index}, {$items_per_page}";
$result = $conexao->query($sql_data);
$conexao->close();
?>
<div id="tabela-resultados">
    <table id="result-table">
        <thead>
        <tr>
            <th>Data</th>
            <th>Distância</th>
            <th>Velocidade de Saída</th>
            <th>Ângulo de Saída</th>
            <th>Visualizar</th>
        </tr>
        </thead>
        <tbody>
        <?php  if ($result->num_rows > 0):
            while($row = $result->fetch_assoc()):
                $parts = explode(" on ", $row['data']);
                ?>
                <tr>
                    <td><?php echo htmlspecialchars(trim($parts[0] ?? '')); ?></td>
                    <td><?php echo htmlspecialchars($row['distancia'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row['velocidade'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row['angulo'] ?? ''); ?></td>
                    <td><button onclick="visualizeTrajectory('<?php echo htmlspecialchars($row['id'] ?? ''); ?>', '<?php echo htmlspecialchars($row['distancia'] ?? ''); ?>','<?php echo htmlspecialchars($row['velocidade'] ?? ''); ?>','<?php echo htmlspecialchars($row['angulo'] ?? ''); ?>','<?php echo htmlspecialchars($row['video'] ?? ''); ?>' )">Visualizar</button></td>
                </tr>
            <?php endwhile;
        else: ?>
            <tr><td colspan="5">Nenhum resultado encontrado.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div style="text-align: center; margin: 20px;">
        <?php if ($current_page > 1): ?>
            <a href="?page=<?php echo '?nome=' . urlencode($playerName). '&page=' . ($current_page - 1); ?>">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo '?nome=' . urlencode($playerName). '&page=' . $i; ?>" <?php if ($i == $current_page) echo 'style="font-weight:bold;"'; ?> > <?php echo $i; ?> </a>
        <?php endfor; ?>
        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?php echo '?nome=' . urlencode($playerName). '&page=' . ($current_page + 1); ?>">Próxima</a>
        <?php endif; ?>
    </div>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
        const loadingOverlay = document.getElementById('loading-overlay');
        const nav = document.querySelector('nav');
        const busca = document.getElementById('busca');

        setTimeout(function() {
            loadingOverlay.style.display = 'none';
            nav.style.display = 'block';
            busca.style.display = 'flex';
        }, 4200);

    });
   function closeCanvas(){
        document.getElementById('canvas-container').style.display = 'none';
        const canvas = document.getElementById('trajectoryCanvas');
        if(canvas.dataset.scene){
            const scene = JSON.parse(canvas.dataset.scene)
            scene.renderer.dispose();
        }
           const iframe = document.getElementById('canvas-iframe');
            if(iframe){
               iframe.remove()
            }
    }
    let currentAnimationId;
    function calculateDeformation(speed, distance){
        const maxDeformation = 15;
        const deformationFactor = 0.05;
        const deformation = speed * distance * deformationFactor;
        return Math.min(deformation, maxDeformation);
    }


   function calculateBallWeight(speed, angle, distance) {
        const radius = 0.074; // Radius of the baseball in meters
        const volume = (4/3) * Math.PI * Math.pow(radius, 3);
        const density = 145;
        const baseMass = volume * density;


         // Convert the launch angle from degrees to radians
        const launchAngleInRadians = angle * (Math.PI / 180);

        //Gravitational Acceleration
        const g = 9.81;

        // Calculate the cross-sectional area of the ball
        const crossSectionalArea = 3 * Math.PI * Math.pow(radius, 2);

        // Density of air
        const densityOfAir = 1.225; // kg/m^3;

        // Calculate drag coefficient using the speed and the area of the ball. The higher the speed the lower the drag, and the higher the area of the ball, the higher the drag, so the drag becomes a "ratio" of speed / area
        const dragCoefficient = Math.max(0.01, 1/ (speed * crossSectionalArea ) );


        //Calculate the drag force on the ball
        const dragForce = 0.5 * dragCoefficient * densityOfAir * crossSectionalArea * Math.pow(speed,2);


         // Calculate effective weight using an estimation based on force generated by the velocity and angle
        const effectiveWeight = baseMass + (dragForce * Math.sin(launchAngleInRadians)/g) ;

        return effectiveWeight;


    }

    function calculateRotation(speed, angle) {
        const radius = 0.074; // Radius of the baseball in meters
        const exitVelocityMps = speed * 0.44704; // Convert mph to m/s
        const launchAngleRad = angle * Math.PI / 180; // Convert degrees to radians
        const spinEfficiency = 0.7; // Estimation, adjust as needed

        // Simplified model: spin depends on exit velocity and launch angle.
        const spinRateRadPerSec = (exitVelocityMps / radius) * Math.sin(launchAngleRad) * spinEfficiency;

        const rpm = (spinRateRadPerSec * 60) / (2 * Math.PI); // Convert to RPM
        return rpm;
    }

   function visualizeTrajectory(homeRunID, distance, exitVelocity, launchAngle, videoUrl) {
        document.getElementById('canvas-container').style.display = 'flex';
        const canvas = document.getElementById('trajectoryCanvas');
        const canvasOverlay = document.getElementById('canvas-overlay-content');
         const ballWeightLabel = document.getElementById('ballWeightLabel');
         const iframe = document.getElementById('canvas-iframe');
         if (iframe){
                iframe.remove();
            }
        const width = canvas.offsetWidth;
        const height = canvas.offsetHeight;

        const deformation = calculateDeformation(parseFloat(exitVelocity), parseFloat(distance));
         const ballWeight = calculateBallWeight(parseFloat(exitVelocity), parseFloat(launchAngle), parseFloat(distance));
       const rotation = calculateRotation(parseFloat(exitVelocity), parseFloat(launchAngle));


        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas: canvas });
        renderer.setSize(width, height);
        canvas.dataset.scene = JSON.stringify({scene, camera, renderer})

        // Geometry and Material
        const geometry = new THREE.SphereGeometry(0.5, 32, 32);

        // Red Deformed Ball
        const redMaterial = new THREE.MeshBasicMaterial({ color: 0xff0000 }); // Red
        const deformedBall = new THREE.Mesh(geometry, redMaterial);
        const deformedScale = 1 + deformation / 40;
        deformedBall.scale.set(1, deformedScale, 1);


        // Blue Undeformed Ball (Perfect)
         const blueMaterial = new THREE.MeshBasicMaterial({
            color: 0x0000ff, // Blue
            transparent: true,
            opacity: 0.5,
            side: THREE.DoubleSide,
            depthWrite: false
        });
        const undeformedBall = new THREE.Mesh(geometry, blueMaterial);
        undeformedBall.position.z = 0.01; // A tiny offset


       scene.add(deformedBall);
        scene.add(undeformedBall);

        camera.position.z = 5;



        // Render the scene once
        renderer.render(scene, camera);


        const newIframe = document.createElement('iframe');
        newIframe.src = videoUrl;
        newIframe.id = 'canvas-iframe';
         canvasOverlay.appendChild(newIframe);

        const formattedWeight = ballWeight.toLocaleString(undefined, { minimumFractionDigits: 4, maximumFractionDigits: 4 });
        const formattedRotation = rotation.toLocaleString(undefined, { maximumFractionDigits: 0 });

        ballWeightLabel.innerHTML = `Peso da Bola: ${formattedWeight} kg <br/> Rotação: ${formattedRotation} RPM`;
    }


    function searchHomeRuns() {
           const playerName = document.getElementById('nome-jogador').value;

        window.location.href = `index.php?nome=${encodeURIComponent(playerName)}`;
    }
	</script>
<footer>
    <p>© 2024 MLB Home Run Search. All rights reserved.</p>
</footer>
</body>
</html>
