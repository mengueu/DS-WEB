int verde = 14;
int amarelo = 13;
int vermelho = 12;

int tempoAnterior = 0;
int estado = 1; // 0 = verde, 1 = amarelo, 2 = vermelho
int tempoCores[] = {1000, 1000, 1000};
char comando = '0';
bool parado = true;

void setup() {
  Serial.begin(9600);
  pinMode(verde, OUTPUT);
  pinMode(amarelo, OUTPUT);
  pinMode(vermelho, OUTPUT);

  digitalWrite(verde, LOW);
  digitalWrite(amarelo, LOW);
  digitalWrite(vermelho, LOW);
}

void loop() {

  if (Serial.available()) {
    comando = Serial.read();

    if (comando == '0'){
      tempoCores[0]=1000; tempoCores[1]=1000; tempoCores[2]=1000;
      parado = false;
    }
    if (comando == '1') { // lento
      tempoCores[0]=2000; tempoCores[1]=2000; tempoCores[2]=2000;
      parado = false;
    }
    else if (comando == '2') { // médio
      tempoCores[0]=1000; tempoCores[1]=1000; tempoCores[2]=1000;
      parado = false;
    }
    else if (comando == '3') { // rápido
      tempoCores[0]=500; tempoCores[1]=500; tempoCores[2]=500;
      parado = false;
    }
    else if (comando == '4') { // parar
      digitalWrite(verde, LOW);
      digitalWrite(amarelo, LOW);
      digitalWrite(vermelho, LOW);
      parado = true;
    }
  }

  if (!parado && millis() - tempoAnterior >= tempoCores[estado]) {
    estado = (estado + 1) % 3;
    tempoAnterior = millis();
    atualizarLuzes();
  }
}

void atualizarLuzes() {
  digitalWrite(vermelho, estado == 2 ? HIGH : LOW);
  digitalWrite(verde, estado == 0 ? HIGH : LOW);
  digitalWrite(amarelo, estado == 1 ? HIGH : LOW);
  
}