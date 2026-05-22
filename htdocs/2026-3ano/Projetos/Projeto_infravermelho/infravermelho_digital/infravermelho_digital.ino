int LED = 13;
int SENSOR = 7;
int valor;

void setup() {
 pinMode(LED, OUTPUT);
 pinMode(SENSOR, INPUT);
}

void loop() {
  valor = digitalRead(SENSOR); //Obter o valor do sensor, LOW ou HIGH
  digitalWrite(LED, !valor);
}