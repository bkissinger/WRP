#!/home/pi/WRP
import time, adafruit_dht, board
import mariadb
import sys
import time

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

while True:
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
    # Print the values to the serial port
    temperature, humidity = dhtDevice.temperature, dhtDevice.humidity
    print("Temperature: {:.1f} °C  Humidity: {:.1f} %".format(temperature, humidity))

  except mariadb.Error as e:
      print(f"Error: {e}")
  time.sleep(10)

conn.close()

