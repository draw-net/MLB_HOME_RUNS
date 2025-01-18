const express = require('express');
const fetch = require('node-fetch');
const ffmpeg = require('fluent-ffmpeg');
const cv = require('opencv4nodejs');
const cors = require('cors');

const app = express();
const PORT = 3001;

app.use(cors());
app.use(express.json());

app.get('/get-mlb-home-runs', async (req, res) => {
    const nomeJogador = req.query.nome;
    if (!nomeJogador) {
        return res.status(400).json({ error: 'O parâmetro nome do jogador é obrigatório.' });
    }

    try {
       const response = await fetch(`https://www.mlb.com/player/${encodeURIComponent(nomeJogador)}/`);
         if (!response.ok) {
              throw new Error(`Erro ao obter página do jogador, código ${response.status}, ${response.statusText}`);
         }
       const text = await response.text()
       const regex = /<script id="__NEXT_DATA__" type="application\/json">(.*?)<\/script>/s;
       const match = text.match(regex);
        if (!match) {
            throw new Error("Não foi possível extrair os dados do jogador");
        }
      const jsonString = match[1];
       const jsonData = JSON.parse(jsonString);
       const playerId = jsonData.props.pageProps.player.id;
      const response2 = await fetch(`https://statsapi.mlb.com/api/v1/sports/1/players/${playerId}/homeruns?season=2023&group=hitting&gameType=R`);
        if (!response2.ok) {
              throw new Error(`Erro ao obter os dados do jogador, código ${response2.status}, ${response2.statusText}`);
         }

         const data = await response2.json();
         const homeRuns = data.homeRuns;
         const extractedHomeRuns = [];

         for (const hr of homeRuns) {
             extractedHomeRuns.push({
                 id: hr.id,
                 game_date: hr.gameDate,
                 nome: hr.playerName,
                 hit_distance: hr.hitDistance,
                 exit_velocity: hr.exitVelocity,
                 launch_angle: hr.launchAngle,
                 link_video: hr.playbacks[0].url,
             });
         }

       res.json(extractedHomeRuns);
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
