  function closeCanvas() {
    document.getElementById('canvas-container').style.display = 'none';
  }

  let currentAnimationId;

  function calculateDeformation(speed, distance) {
    const maxDeformation = 15;
    const deformationFactor = 0.05;
    const deformation = speed * distance * deformationFactor;
    return Math.min(deformation, maxDeformation);
  }

  function searchHomeRuns() {
    const playerName = document.getElementById('nome-jogador').value;
    const resultsDiv = document.getElementById('resultado');
    resultsDiv.innerHTML = '<p>Carregando...</p>';
    document.getElementById('video-container').style.display = 'none';
    document.getElementById('dados-homerun').innerHTML = '';

    const url = playerName ? `http://localhost:3001/get-mlb-home-runs?nome=${encodeURIComponent(playerName)}` : `index.php?nome=${encodeURIComponent(playerName)}`;

    fetch(url)
      .then(response => response.json())
      .then(data => {
        resultsDiv.innerHTML = '';
        if (data.error) {
          resultsDiv.innerHTML = `<p style="color:red;">Erro: ${data.error}</p>`;
        } else if (data.message) {
          resultsDiv.innerHTML = `<p>${data.message}</p>`;
        } else if (data && data.length > 0) {
          const table = document.createElement('table');
          table.style.borderCollapse = 'collapse';
          table.style.width = '100%';

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
            viewButton.onclick = () => visualizeTrajectory(hr.id, hr.hit_distance, hr.exit_velocity, hr.launch_angle, url.includes("http://localhost:3001"));
            viewCell.appendChild(viewButton);
            viewCell.style.border = '1px solid black';
            viewCell.style.padding = '8px';

            const videoCell = row.insertCell();
            const videoButton = document.createElement('button');
            videoButton.textContent = 'Video';
            videoButton.onclick = () => exibirHomeRun(hr, url.includes("http://localhost:3001"));
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

  function visualizeTrajectory(homeRunID, distance, exitVelocity, launchAngle, isNodejs) {
    document.getElementById('canvas-container').style.display = 'flex';
    const canvas = document.getElementById('trajectoryCanvas');
    const ctx = canvas.getContext('2d');
    const raio = 0.5;
    let x = 0;
    let y = canvas.height;
    let tempo = 0;
    const deformation = calculateDeformation(parseFloat(exitVelocity), parseFloat(distance));
    let rotationAngle = 0;
    const rotationSpeed = 0.1; // Ajuste a velocidade de rotação conforme necessário
    if (currentAnimationId) {
      cancelAnimationFrame(currentAnimationId);
    }

    let initialSpeedX = exitVelocity * Math.cos(launchAngle * (Math.PI / 180));
    let initialSpeedY = -exitVelocity * Math.sin(launchAngle * (Math.PI / 180));

    function animate() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      x = initialSpeedX * tempo;
      y = canvas.height - (initialSpeedY * tempo + 0.5 * 9.8 * tempo * tempo);
      rotationAngle += rotationSpeed; // Atualiza o ângulo de rotação

      ctx.save();
      ctx.translate(x, y);
      ctx.rotate(rotationAngle);
       // Desenhar a bola deformada
        ctx.beginPath();
        const deformedRaioY = raio * 10 * (1 + deformation/20);
         ctx.ellipse(0, 0, raio * 10, deformedRaioY, 0, 0, 2 * Math.PI);
        ctx.fillStyle = 'red';
        ctx.fill();
      ctx.restore();
      tempo += 0.05;

       if (y > canvas.height || x > canvas.width) {
        return;
       }
      currentAnimationId = requestAnimationFrame(animate);
    }
    animate();
  }

  function exibirHomeRun(dados, isNodejs) {
    document.getElementById('video-container').style.display = 'block';
    document.getElementById('video-source').src = dados.link_video;

    if (isNodejs) {
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
    } else {
      const raio = 0.074;
      const volume = 4 / 3 * Math.PI * Math.pow(raio, 3);
      document.getElementById('resultado').textContent = `Volume da bola (apenas demonstração): ${volume.toFixed(4)} metros cúbicos`;
    }

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
