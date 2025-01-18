const express = require('express');
const fetch = require('node-fetch');
const ffmpeg = require('fluent-ffmpeg');
const cv = require('opencv4nodejs');
const cors = require('cors');

const app = express();
const PORT = 3001;

app.use(cors());
app.use(express.json());

app.get('/get-home-runs', async (req, res) => {
    const nomeJogador = req.query.nome;
    if (!nomeJogador) {
        return res.status(400).json({ error: 'O parâmetro nome do jogador é obrigatório.' });
    }

    try {
       const response = await fetch(`https://www.sousatonet/mlb/index.php?nome=${encodeURIComponent(nomeJogador)}`);
       if (!response.ok) {
           throw new Error(`Erro ao buscar os home runs, ${response.status}, ${response.statusText}`);
       }

       const data = await response.json();
       res.json(data);
    } catch(error) {
         console.error('Erro ao buscar home runs:', error);
         res.status(500).json({ error: 'Erro ao buscar home runs.' });
     }

});

app.post('/analyze-video', async (req, res) => {
    const { videoUrl } = req.body;

    if (!videoUrl) {
        return res.status(400).json({ error: "É preciso fornecer a URL do vídeo" });
    }
    try {
        const volume = await calculateBallVolume(videoUrl);
        res.json({volume: volume});
    } catch (error) {
        console.error("Erro ao analisar o vídeo:", error);
        res.status(500).json({ error: "Erro ao analisar o vídeo." });
    }
});


async function calculateBallVolume(videoUrl){
   console.log("Iniciando análise de vídeo");

   return new Promise(async (resolve, reject) => {
       try {
         const tempFile = 'temp-video.mp4';

          const videoResponse = await fetch(videoUrl);
           if (!videoResponse.ok) {
               throw new Error(`Erro ao buscar vídeo: ${videoResponse.status} ${videoResponse.statusText}`);
           }
           const fileStream = require('fs').createWriteStream(tempFile);

             videoResponse.body.pipe(fileStream);
           await new Promise((resolveStream, rejectStream) => {
               fileStream.on('finish', resolveStream);
               fileStream.on('error', rejectStream);
           });


             console.log("Video baixado");

             const videoCapture = new cv.VideoCapture(tempFile);
              let raio = 0;
              let numFrames = 0;
              let totalRaio = 0;

           while (true) {
              const frame = videoCapture.read();
                 if(frame.empty) break;
               numFrames++;

               const grayFrame = frame.cvtColor(cv.COLOR_BGR2GRAY);
               const circles = grayFrame.houghCircles(cv.HOUGH_GRADIENT, 1, 20, 100, 50, 10, 100);
              if(circles && circles.length > 0){
                  for(const circle of circles)
                     totalRaio += circle[2];
               }

             }

           const averageRaio = totalRaio/numFrames/1.0;
           
           console.log(`Raios detectados ${totalRaio} em ${numFrames} frames`)
            if(averageRaio <= 0){
                 resolve(0);
                 console.log("Nenhum raio detectado!");
            }

           raio = averageRaio;


        console.log(`Raio Médio: ${raio}`);
         const volume = (4 / 3) * Math.PI * Math.pow(raio, 3);
         console.log("Video analisado");
           resolve(volume);
       } catch (error) {
            console.error("Erro ao analisar o vídeo", error);
            reject(error)
       }

   });
}
 app.listen(PORT, () => {
   console.log(`Server running on port ${PORT}`);
 });
