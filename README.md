# MLB_HOME_RUNS
Search Home Runs

Resumo do Código

Este é um projeto web que visa exibir dados sobre home runs da MLB (Major League Baseball). Ele busca informações de um banco de dados MySQL e as apresenta de forma organizada, com algumas funcionalidades adicionais. Aqui está uma decomposição:

Tecnologias e Componentes:

HTML: A estrutura da página web, incluindo:

Navegação (com links para o site da MLB e uma barra de pesquisa)

Exibição de resultados de busca (tabela paginada)

Exibição de informações de um home run específico

Integração com Three.js para visualizações 3D (não totalmente implementada)

Um "overlay" (camada sobreposta) para mostrar vídeos e dados

CSS: Estilos para a aparência da página, incluindo layout, cores e responsividade para diferentes tamanhos de tela.

JavaScript: Lógica do lado do cliente, para:

Fazer buscas de home runs pelo nome do jogador

Exibir vídeos e dados em um modal

Criar visualização da trajetória da bola (com Three.js)

Interações com o usuário (por exemplo, fechar overlays)

Um script de "loading" que desaparece em 4.2s

PHP: Lógica do lado do servidor para:

Conectar ao banco de dados MySQL

Consultar dados dos home runs (com paginação)

Retornar os dados para a página web (como tabelas e informações para visualização)

Realizar cálculos como peso da bola e rotação (baseado em dados físicos)

Selecionar um home run "top" baseado em critérios predefinidos

Banco de Dados MySQL: Armazena os dados dos home runs (jogador, distância, velocidade, ângulo, vídeo, etc.).

Funcionalidades Principais:

Busca por Nome de Jogador: O usuário pode buscar home runs por nome de jogador usando um campo de texto.

Exibição de Resultados: Os home runs correspondentes são exibidos em uma tabela paginada.

Visualização de Dados:

Os dados de cada home run são exibidos em uma tabela com informações como nome do jogador, distância, velocidade, ângulo, peso da bola e rotação.

Um vídeo relacionado ao home run pode ser exibido em um modal (overlay).

Existe uma visualização da trajetória da bola em 3D (utilizando Three.js).

Cálculos Físicos: O sistema calcula o peso da bola e a rotação (RPM) usando fórmulas físicas.

Destaque de Home Run Especial: O sistema identifica e destaca o "top" home run baseado em critérios específicos (ângulo de saída, peso da bola, rotação).

Loading Tela de loading com logo e uma mensagem.

Capitalização/Expansão do Projeto

Aqui estão algumas ideias sobre como esse projeto poderia ser expandido e/ou transformado em algo mais robusto:

Melhorias na Visualização 3D:

Renderização de um modelo 3D de um estádio da MLB.

Cálculos mais precisos da trajetória (incluindo a resistência do ar e o efeito Magnus).

Animação do vôo da bola.

Controles interativos da visualização.

Integração com Dados da MLB:

Usar a API oficial da MLB para obter dados mais completos e atualizados, como stats de jogadores, detalhes da partida e vídeos de alta qualidade.

Permitir que os usuários procurem por jogos ou equipes específicas.

Implementar filtros mais avançados (por data, por estádio, etc.).

Sistema de Pontuação/Ranking:

Criar um algoritmo de pontuação que considere vários fatores (distância, velocidade, ângulo, tipo de lançamento, etc.).

Gerar rankings dos melhores home runs.

Autenticação e Criação de Conteúdo:

Permitir que os usuários se registrem.

Permitir que os usuários adicionem informações sobre home runs que não estão no banco de dados.

Personalização:

Permitir que os usuários salvem suas buscas e vídeos favoritos.

Oferecer temas de cores e outros tipos de personalização.

Monetização:

Anúncios: Exibir anúncios relevantes para a audiência de beisebol.

Afiliados: Linkar para lojas de produtos de beisebol (camisetas, bonés, etc.).

Assinaturas: Oferecer funcionalidades premium (visualizações em 3D de alta qualidade, dados históricos mais detalhados, etc.) para usuários pagantes.

Venda de Dados: Criar uma API para que outras empresas possam utilizar os dados de home runs.

Observações Adicionais:

Segurança: O código deve ser revisado para garantir que não há vulnerabilidades de segurança (SQL injection, XSS, etc.).

Desempenho: Otimizar as consultas no banco de dados e o código JavaScript para garantir uma boa experiência do usuário.

Testes: Criar testes unitários e testes de integração para garantir a qualidade do projeto.

Responsividade: Garantir que a interface seja adequada para uma variedade de tamanhos de tela (computadores, tablets e smartphones).

Conclusão:

Este é um projeto promissor que combina dados, visualização e elementos interativos. Ele tem um bom potencial para se tornar uma ferramenta interessante para fãs de beisebol. As ideias de "capitalização" mostradas acima são uma direção para transformar este projeto em algo mais do que um simples exemplo de código.

Se precisar de mais informações ou ajuda específica com alguma parte do projeto, é só perguntar!

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
