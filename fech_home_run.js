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
   function closeVideoOverlay(){
        document.getElementById('video-overlay').style.display = 'none';
        const canvas = document.querySelector('#video-overlay-content canvas');
       if(canvas){
           cancelAnimationFrame(canvas.animationId)
            canvas.videoElement.pause();
           canvas.videoElement = null
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
       const radius = 0.074;
       const volume = (4/3) * Math.PI * Math.pow(radius, 3);
        const density = 145;
       const baseMass = volume * density;
        const launchAngleInRadians = angle * (Math.PI / 180);
        const g = 9.81;
       const crossSectionalArea = 3 * Math.PI * Math.pow(radius, 2);
      const densityOfAir = 1.225;
        const dragCoefficient = Math.max(0.01, 1/ (speed * crossSectionalArea ) );
       const dragForce = 0.5 * dragCoefficient * densityOfAir * crossSectionalArea * Math.pow(speed,2);
       const effectiveWeight = baseMass + (dragForce * Math.sin(launchAngleInRadians)/g) ;
        return effectiveWeight;
  }
   function calculateRotation(speed, angle) {
       const radius = 0.074;
        const exitVelocityMps = speed * 0.44704;
       const launchAngleRad = angle * Math.PI / 180;
        const spinEfficiency = 0.7;
        const spinRateRadPerSec = (exitVelocityMps / radius) * Math.sin(launchAngleRad) * spinEfficiency;
       const rpm = (spinRateRadPerSec * 60) / (2 * Math.PI);
      return rpm;
    }
    function showVideoOnCanvas(videoUrl, formattedWeight, formattedRPM) {
        const videoOverlay = document.getElementById('video-overlay');
      const canvas = document.getElementById('video-canvas');
        const ctx = canvas.getContext('2d');
        videoOverlay.style.display = 'flex';
        const video = document.createElement('video');
       video.src = videoUrl;
       video.controls = false;
        video.onloadedmetadata = function(){
           canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            video.play();
            canvas.videoElement = video;
           drawFrame();
      }
        function drawFrame(){
            if(canvas.videoElement){
                ctx.drawImage(canvas.videoElement, 0, 0, canvas.width, canvas.height);
                ctx.font = '18px sans-serif';
                ctx.fillStyle = 'white';
                const formattedWeightDisplay = formattedWeight + ' kg';
                const formattedRPMDisplay =  formattedRPM + ' RPM';
               ctx.fillText(`Weight: ${formattedWeightDisplay}`, 10, 20);
               ctx.fillText(`Rotation: ${formattedRPMDisplay}`, 10, 40);
             canvas.animationId =  requestAnimationFrame(drawFrame);
          }
       }
       video.onerror = function() {
           console.error("Erro ao carregar o video:", videoUrl);
        }
    }

   function showVideoAndData(homeRunID, data, distance, exitVelocity, launchAngle, videoUrl, formattedWeight, formattedRPM) {
        const videoOverlay = document.getElementById('video-overlay');
        const videoContent = document.getElementById('video-overlay-data-container');
        videoOverlay.style.display = 'flex';
        videoContent.innerHTML = '';
       const parts = data.split(" on ");
        let htmlContent = `
           <p><strong>${parts[0].trim()}</strong></p>
        `;
        videoContent.innerHTML = htmlContent;
        showVideoOnCanvas(videoUrl, formattedWeight, formattedRPM);
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

       const geometry = new THREE.SphereGeometry(0.5, 32, 32);
       const redMaterial = new THREE.MeshBasicMaterial({ color: 0xff0000 });
        const deformedBall = new THREE.Mesh(geometry, redMaterial);
        const deformedScale = 1 + deformation / 40;
       deformedBall.scale.set(1, deformedScale, 1);
       const blueMaterial = new THREE.MeshBasicMaterial({
           color: 0x0000ff,
           transparent: true,
           opacity: 0.5,
           side: THREE.DoubleSide,
             depthWrite: false
      });
        const undeformedBall = new THREE.Mesh(geometry, blueMaterial);
        undeformedBall.position.z = 0.01;
        scene.add(deformedBall);
        scene.add(undeformedBall);
        camera.position.z = 5;
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
    document.addEventListener('DOMContentLoaded', function() {
        const loadingOverlay = document.getElementById('loading-overlay');
        const nav = document.querySelector('nav');
        setTimeout(function() {
            loadingOverlay.style.display = 'none';
             nav.style.display = 'flex';
        }, 4200);

    });
