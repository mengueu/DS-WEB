import serial

# Substitua pelas portas corretas do seu PC
porta_bluetooth = 'COM3'   # Porta gerada pelo pareamento Bluetooth
porta_arduino = 'COM4'    # Porta onde o Arduino está conectado

bt = serial.Serial(porta_bluetooth, 9600)
arduino = serial.Serial(porta_arduino, 9600)

print("Ponte ativa. Aguardando comandos...")

while True:
    if bt.in_waiting > 0:
        dados = bt.read()
        print(f"Recebido: {dados}")
        arduino.write(dados)
