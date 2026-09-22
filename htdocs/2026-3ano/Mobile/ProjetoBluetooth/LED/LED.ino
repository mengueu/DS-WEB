const int pinoLed = 13; // Define o pino 13 para o LED integrado
char comando;          // Variável para armazenar o caractere recebido

void setup() {
  pinMode(pinoLed, OUTPUT); // Configura o pino do LED como saída
  Serial.begin(9600);       // Inicializa a comunicação serial a 9600 bps
  
  // Mensagem inicial de orientação no Monitor Serial
  Serial.println("Sistema pronto!");
  Serial.println("Digite 'l' para LIGAR o LED.");
  Serial.println("Digite 'd' para DESLIGAR o LED.");
}

void loop() {
  // Verifica se há dados disponíveis para leitura na porta serial
  if (Serial.available() > 0) {
    comando = Serial.read(); // Lê o caractere enviado

    // Compara o caractere recebido (aceita maiúsculas e minúsculas)
    if (comando == 'l' || comando == 'L') {
      digitalWrite(pinoLed, HIGH); // Liga o LED
      Serial.println("LED LIGADO");
    } 
    else if (comando == 'd' || comando == 'D') {
      digitalWrite(pinoLed, LOW);  // Desliga o LED
      Serial.println("LED DESLIGADO");
    }
  }
}
