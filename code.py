import requests
from bs4 import BeautifulSoup
import logging
import os
import time

# Configuração de logs
LOG_FILE = r'D:\SITE\SOUSATO\web\logs\code.log'  # Altere para o caminho correto
logging.basicConfig(filename=LOG_FILE, level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

logging.info('Iniciando script code.py')



def extract_player_data(player_url):
    """Função para extrair dados de uma página individual de jogador."""
    response = requests.get(player_url)
    try:
        response.raise_for_status()  # Verifica se houve erro na requisição HTTP
        soup = BeautifulSoup(response.content, 'html.parser')

        nome_completo = soup.find('h1', class_='player-name__name').text.strip()
        apelido_element = soup.find('span', class_='player-name__nickname')
        apelido = apelido_element.text.strip() if apelido_element else None
        numero_camisa = int(soup.find('div', class_='player-header__uniform-number').text.strip())
        posicao = soup.find('div', class_='player-header__position').text.strip()
        time_atual = soup.find('div', class_='player-header__team').find('span').text.strip()
        info_labels = soup.find_all('div', class_='player-bio__item')
        
        data_nascimento = None
        local_nascimento = None
        altura = None
        peso = None
        lanca_bate = None
        for item in info_labels:
          label = item.find('div', class_='player-bio__item-label').text.strip()
          value = item.find('div', class_='player-bio__item-value').text.strip()

          if label == "Birthdate":
              data_nascimento = value
          elif label == "Birthplace":
              local_nascimento = value
          elif label == "Height":
              altura = value
          elif label == "Weight":
              peso = value
          elif label == "Bats/Throws":
              lanca_bate = value
        
        stat_table = soup.find('table', class_='player-career-stats__table')
        jogos_carreira = 0
        rebatidas_carreira = 0
        home_runs_carreira = 0
        rbi_carreira = 0
        if stat_table:
          stat_rows = stat_table.find_all('tr')
          if len(stat_rows) > 1:
            stat_row = stat_rows[-1]
            stat_values = stat_row.find_all('td')
            jogos_carreira = int(stat_values[1].text.strip())
            rebatidas_carreira = int(stat_values[2].text.strip())
            home_runs_carreira = int(stat_values[6].text.strip())
            rbi_carreira = int(stat_values[7].text.strip())

        return {
            "nome_completo": nome_completo,
            "apelido": apelido,
            "numero_camisa": numero_camisa,
            "posicao": posicao,
            "time_atual": time_atual,
            "data_nascimento": data_nascimento,
            "local_nascimento": local_nascimento,
            "altura": altura,
            "peso": peso,
            "lanca_bate": lanca_bate,
            "jogos_carreira": jogos_carreira,
            "rebatidas_carreira": rebatidas_carreira,
            "home_runs_carreira": home_runs_carreira,
            "rbi_carreira": rbi_carreira
        }
    except requests.exceptions.RequestException as e:
         logging.error(f"Erro ao processar {player_url}: {e}")
         return None
    except Exception as e:
         logging.error(f"Erro ao processar {player_url}: {e}")
         return None


# Extrair URLs dos jogadores da página de listagem
def get_player_urls(players_page_url):
    """Função para extrair URLs de jogadores da página de listagem"""
    try:
        response = requests.get(players_page_url)
        response.raise_for_status()  # Verifica se houve erro na requisição HTTP
        soup = BeautifulSoup(response.content, 'html.parser')
        player_links = []
        for card in soup.find_all('a', class_='p-card-player__link'):
            player_links.append("https://www.mlb.com" + card.get('href'))
        return player_links
    except requests.exceptions.RequestException as e:
         logging.error(f"Erro ao obter lista de jogadores: {e}")
         return None
    except Exception as e:
        logging.error(f"Erro ao obter lista de jogadores: {e}")
        return None
            

players_page_url = "https://www.mlb.com/players"
player_urls = get_player_urls(players_page_url)

if player_urls:
    # Iterar pelos URLs dos jogadores
    for player_url in player_urls:
      player_data = extract_player_data(player_url)
      if player_data:
          logging.info(f"Dados extraidos do jogador: {player_data['nome_completo']}")
          print(player_data)

else:
    logging.error("Não foi possível obter a lista de jogadores")
logging.info('Script code.py finalizado')
