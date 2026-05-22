int LED = 13;
int SENSOR = A0;
int valor;

void setup() {
  Serial.begin(9600);
  pinMode(LED, OUTPUT);
}

void loop() {
  valor = analogRead(SENSOR); // Obter o valor do sensor (entre 0 e 1023-entrada analógica)
  Serial.print("Valor: ");
  Serial.println(valor);
    
  if (valor < 300){
    digitalWrite(LED, HIGH);}
  else {
    digitalWrite(LED, LOW);
  }
}