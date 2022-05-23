#!/home/pi/WRP
import time, adafruit_dht, board
import mariadb
import sys
import paho.mqtt.client as mqttClient


# Connect to MariaDB Platform
try:
    conn = mariadb.connect(
        user="myadmin",
        password="",
        host="localhost",
        port=3306,
        database="WRP"

    )

except mariadb.Error as e:
    print(f"Error connecting to MariaDB Platform: {e}")
    sys.exit(1)

# Enable Auto-Commit
conn.autocommit = True

# Get Cursor
cur = conn.cursor()

# set the variable
dht22gpiopin = 'D4'

# Initial the dht device, with data pin connected to:
dhtboard = getattr(board, dht22gpiopin)

# you can pass DHT 22 use_pulseio=False if you don't want to use pulseio
# this may be necessary on the Pi zero but will not work in
# circuit python
dhtDevice = adafruit_dht.DHT22(dhtboard, use_pulseio=False)
# Standard is, but not working on the raspberry pi boards
#dhtDevice = adafruit_dht.DHT22(dhtboard)


try:
    # Print the values to the serial port
    temperature, humidity = dhtDevice.temperature, dhtDevice.humidity
    print("Temperature: {:.1f} °C  Humidity: {:.1f} %".format(temperature, humidity))

    cur.execute(
        "INSERT INTO Messung (Temperatur, Luftfeuchtigkeit) VALUES (?, ?)",
        (temperature, humidity))
    # conn.commit()


except RuntimeError as error:
    # Errors happen fairly often, DHT's are hard to read, just keep going
    time.sleep(2.0)
    temperature, humidity = dhtDevice.temperature, dhtDevice.humidity

except mariadb.Error as e:
    print(f"Error: {e}")
time.sleep(2)

conn.close()

t = str(temperature)
h = str(humidity)
msg = t + "-" + h

def on_connect(client, userdata, flags, rc):

    if rc == 0:

        print("Connected to broker")

        global Connected                #Use global variable
        Connected = True                #Signal connection

    else:

        print("Connection failed")

Connected = False   #global variable for the state of the connection

broker_address= "localhost"
port = 1883
user = "WRP"
password = ""

client = mqttClient.Client("Raspi")               #create new instance
client.username_pw_set(user, password=password)    #set username and password
client.on_connect= on_connect                      #attach function to callback
client.connect(broker_address, port=port)          #connect to broker

client.loop_start()        #start the loop

while Connected != True:    #Wait for connection
    time.sleep(0.1)

try:

    client.publish("Home/WRP",msg)

except KeyboardInterrupt:

    client.disconnect()
    client.loop_stop()