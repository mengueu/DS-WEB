import codecs
from http.server import BaseHTTPRequestHandler, HTTPServer
import urllib.parse
import serial
import threading
import time

# --- CONFIGURAÇÃO DA PORTA SERIAL ---
# Substitua pela sua porta COM correta (ex: 'COM10')
porta_com = 'COM9' 

# Variável global para armazenar o último valor do LDR
ultimo_valor_ldr = "1023" # Valor alto = escuro/apagado inicialmente

try:
    arduino = serial.Serial(porta_com, 9600, timeout=1)
    print(f"Conectado com sucesso na porta {porta_com}!")
except Exception as e:
    print(f"ERRO: Nao foi possivel conectar na porta {porta_com}. Verifique se a IDE do Arduino esta com o Monitor Serial aberto.")
    print(e)
    exit()

def ler_serial_background():
    global ultimo_valor_ldr
    while True:
        try:
            if arduino.in_waiting > 0:
                linha = arduino.readline().decode('utf-8', errors='ignore').strip()
                if linha.isdigit():
                    ultimo_valor_ldr = linha
        except Exception as e:
            print("Erro ao ler serial:", e)
        time.sleep(0.1)

# Inicia a thread de leitura
thread_leitura = threading.Thread(target=ler_serial_background, daemon=True)
thread_leitura.start()

class ServidorWeb(BaseHTTPRequestHandler):
    def do_GET(self):
        self.send_response(200)
        self.send_header("Content-type", "text/plain")
        self.send_header("Access-Control-Allow-Origin", "*")
        self.end_headers()
        
        url_analisada = urllib.parse.urlparse(self.path)
        parametros = urllib.parse.parse_qs(url_analisada.query)
        
        if 'status' in parametros and parametros['status'][0] == 'jardim':
            # Se menor que 400, está claro o suficiente para considerar algo,
            # Espera, no código do Arduino:
            # if(valor < 400){ digitalWrite(pinJardim, HIGH); } else { digitalWrite(pinJardim, LOW); }
            # Então < 400 = HIGH = Aceso.
            try:
                valor_int = int(ultimo_valor_ldr)
                if valor_int < 400:
                    resposta = f"Aceso ({valor_int})"
                else:
                    resposta = f"Apagado ({valor_int})"
            except:
                resposta = "Desconhecido"
            
            self.wfile.write(resposta.encode('utf-8'))
            
        elif 'comando' in parametros:
            comando_completo = parametros['comando'][0]
            print(f"Recebido da Web: {comando_completo}")
            arduino.write((comando_completo + '\n').encode('utf-8'))
            self.wfile.write(b"OK")
            
        else:
            self.wfile.write(b"Nenhum comando recebido")

def rodar():
    endereco_servidor = ('', 8080)
    httpd = HTTPServer(endereco_servidor, ServidorWeb)
    print("Servidor rodando na porta 8080... (Aperte Ctrl+C para parar)")
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        pass
    httpd.server_close()
    print("Servidor parado.")

if __name__ == '__main__':
    rodar()