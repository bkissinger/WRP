#include <WiFi.h>
#include <Wire.h>
#include <PubSubClient.h>
#include <LiquidCrystal_I2C.h>
 
const char* ssid = "3BaumH1";
const char* password = "";
const char* server = "10.0.1.110";
const int mqttPort = 1883;
const char* mqttUser = "WRP";
const char* mqttPassword = "";
 
WiFiClient espClient;
PubSubClient client(espClient);

// set the LCD number of columns and rows
int lcdColumns = 16;
int lcdRows = 2;
// set LCD address, number of columns and rows
// if you don't know your display address, run an I2C scanner sketch
LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);  
int temp;   //variable for temperature
int hum;    //variable for humidity

byte customCharDegree[] = {
  B00110,
  B01001,
  B01001,
  B00110,
  B00000,
  B00000,
  B00000,
  B00000
};

//Prints a frame with text but no data on the lcd-screen
void printTandH(){
  lcd.setCursor(0,0);
  lcd.print("Temp.:");
  lcd.setCursor(0,1);
  lcd.print("Humidity:");
  lcd.setCursor(14,0);
  lcd.write(0);
  lcd.print("C");
  lcd.setCursor(14,1);
  lcd.print("%");
}

void callback(char* topic, byte* payload, unsigned int length) {
  int index = -1;

  lcd.setCursor(10,0);
  for(int i = 0 ; i < length ; i++) {
    if ((char)payload[i] != '-') {
      lcd.print((char)payload[i]);
    } else {
      index = i;
    }
  }

  lcd.setCursor(10,1);
  for (int j = index + 1 ; j < length ; j++) {
    lcd.print((char)payload[j]);
  }
 
}
 
void setup() {

  // initialize LCD
  lcd.init();
  // turn on LCD backlight                      
  lcd.backlight();

  lcd.createChar(0,customCharDegree);
  lcd.home();

  printTandH();

  // --------------------------------------------------------------------------------------------------------
 
  Serial.begin(115200);

  WiFi.mode(WIFI_STA);
 
  WiFi.begin(ssid, password);
 
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println("Connecting to WiFi..");
  }
  Serial.println("Connected to the WiFi network");
 
  client.setServer(server, mqttPort);
  client.setCallback(callback);
 
  while (!client.connected()) {
    Serial.println("Connecting to MQTT...");
 
    if (client.connect("ESP32Client", mqttUser, mqttPassword )) {
 
      Serial.println("connected");  
 
    } else {
 
      Serial.print("failed with state ");
      Serial.print(client.state());
      delay(2000);
 
    }
  }
 
  client.subscribe("Home/WRP");
 
}
 
void loop() {
  client.loop();
}
