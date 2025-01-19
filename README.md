# MLB_HOME_RUNS
Search Home Runs

Instale o Node.js e npm: Faça a instalação corretamente e adicione-os ao PATH.

Instale o CMake: Instale o cmake no seu sistema e verifique a versão.

Instale as Dependências: Navegue até a pasta do server.js e execute o comando npm install express fluent-ffmpeg node-fetch opencv4nodejs

Instale as dependências do python: Execute pip install requests beautifulsoup4 mysql-connector-python.

Execute server.js: Execute node server.js para iniciar o servidor Node.js.

Execute code.py: Execute o script Python para popular a tabela jogadores_mlb (se você precisar usá-la).

Acesse a página: Acesse o seu site pelo navegador e tente fazer a busca, e verifique se o erro desapareceu.

-------------------------------------------------------------------------------------------------------------------------------------------
**verificar a porta 3001 - instalação do etherium.js

Use o comando netstat para verificar as portas:

O comando netstat exibe as conexões de rede (TCP/UDP) do seu sistema, incluindo quais portas estão sendo usadas.

Execute o comando abaixo para verificar as portas TCP/IP que estão em uso no seu sistema e filtre para exibir as conexões da porta 3001:

netstat -ano | findstr :3001
Use code with caution.
Bat
netstat -ano: Lista todas as conexões ativas e as portas "ouvindo" do sistema.

| findstr :3001: Filtra a saída do netstat para exibir apenas as linhas que contenham a porta 3001.

Você deverá ver o processo do seu nodejs (caso ele esteja rodando) utilizando essa porta.

---------------------------------------------------------------------------------------------------------------------------------------------
Verifique o git e o cmake: Garanta que eles estão instalados e no PATH.

Limpe o cache: Execute npm cache clean --force

Remova node_modules: Remova manualmente a pasta node_modules.

Instale a versão especifica do pacote Execute npm install opencv4nodejs@5.6.0 e veja se a instalação funciona.

Reinstale as dependências: Tente executar o comando npm install express fluent-ffmpeg node-fetch opencv4nodejs

Teste isoladamente: Execute o install.js manualmente na pasta opencv4nodejs.

Compartilhe os logs: Se o erro persistir, compartilhe os resultados dos passos acima e os logs de instalação.
-----------------------------------------------------------------------------------------------------------------------------------------------
pip install beautifulsoup4 instala a biblioteca BeautifulSoup4.

Para executar comandos do DOS no Python, use o módulo subprocess.

O BeautifulSoup4 é usado para analisar HTML e XML, mas não para exibir comandos do DOS.
