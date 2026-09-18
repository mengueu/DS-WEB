int LED = 13;
int SENSOR = 7;
int valor;

void setup() {
  Serial.begin(9600); 
  pinMode(LED, OUTPUT);
  pinMode(SENSOR, INPUT);
}

void loop() {
  valor = digitalRead(SENSOR);
  digitalWrite(LED, !valor); 
  
  Serial.println(valor); 
  delay(100); 

}