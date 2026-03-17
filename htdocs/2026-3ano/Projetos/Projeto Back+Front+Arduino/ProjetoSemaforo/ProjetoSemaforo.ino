int vermelho = 8;
int amarelo = 9;
int verde = 10;

int comando;
int estado = 3;
int tempo;

void setup(){
  Serial.begin(9600);

  pinMode(vermelho, OUTPUT);
  pinMode(amarelo, OUTPUT);
  pinMode(verde, OUTPUT);
}
void loop(){
  if (Serial.available()){
    comando = Serial.read();

    if (comando == '0'){
      estado = 0;
      tempo = 2000;
    }
    else if (comando == '1'){
      estado = 1;
      tempo = 1000;
    }
    else if (comando == '2'){
      estado = 2;
      tempo = 500;
    }
    else if (comando == '3'){
      estado = 3;
    }
  }

  if (estado == 0){
    semaforo();
  }
  else if (estado == 1){
    semaforo();
  }
  else if (estado == 2){
    semaforo();
  }
  else if (estado == 3){
    desligar();
  }
}

void semaforo(){
  digitalWrite(vermelho, HIGH);
  delay(tempo);
  digitalWrite(vermelho, LOW);
  digitalWrite(verde, HIGH);
  delay(tempo);
  digitalWrite(verde, LOW);
  digitalWrite(amarelo, HIGH);
  delay(tempo);
  digitalWrite(amarelo, LOW);
}

void desligar(){
  digitalWrite(vermelho, LOW);
  digitalWrite(amarelo, LOW);
  digitalWrite(verde, LOW);
}