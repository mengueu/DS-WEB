int led = 13;
char comando;
int estado = 0;

void setup() {
  pinMode(led, OUTPUT);
  Serial.begin(9600);
}

void loop() {
  if (Serial.available()){
    comando = Serial.read();

    if (comando == 'p'){
      estado = 2;
    }
    else if (comando == 'l'){
      estado = 1;
    }
    else if (comando == 'd'){
      estado = 0;
    }
  }

  if (estado == 1){
    ligar();
  }
  else if (estado == 0){
    desligar();
  }
  else if (estado == 2){
    piscar();
  }
}

void ligar(){
  digitalWrite(led, HIGH);
}

void desligar(){
  digitalWrite(led, LOW);
}

void piscar(){
  digitalWrite(led, HIGH);
  delay(500);
  digitalWrite(led, LOW);
  delay(500);
  }
