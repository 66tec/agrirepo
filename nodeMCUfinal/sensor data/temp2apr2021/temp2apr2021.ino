#include <ESP8266WiFi.h>
#include "DHT.h"


#define DHTPIN D1
#define DHTTYPE DHT22
#define LDRPIN D2
#define MOISTUREPIN D3
#define RELAYMODULE4CH_PIN_IN1  D4
#define RELAYMODULE4CH_PIN_IN2  D5
#define RELAYMODULE4CH_PIN_IN4  D6
#define RELAYMODULE4CH_PIN_IN3  D7
const int RELAY_PIN = D8;
 
int RelayModule4chPins[] = { RELAYMODULE4CH_PIN_IN1, RELAYMODULE4CH_PIN_IN2, RELAYMODULE4CH_PIN_IN3, RELAYMODULE4CH_PIN_IN4 };
 
const char* ssid     = "Rasheeda-Cottage";
const char* password = "92466860";
const char* host = "portal.agritech.gq";
DHT dht(DHTPIN, DHTTYPE);

void setup() {
    pinMode(RELAY_PIN, OUTPUT);
    pinMode(RELAYMODULE4CH_PIN_IN1, OUTPUT);
    pinMode(RELAYMODULE4CH_PIN_IN2, OUTPUT);
    pinMode(RELAYMODULE4CH_PIN_IN3, OUTPUT);
    pinMode(RELAYMODULE4CH_PIN_IN4, OUTPUT);


  
  Serial.begin(115200);
  delay(100);
  dht.begin();
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password); 
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 
  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.print("Netmask: ");
  Serial.println(WiFi.subnetMask());
  Serial.print("Gateway: ");
  Serial.println(WiFi.gatewayIP());




  
}
void loop() {
  float moisture_percentage;
  int sensor_digital ;
  int ldr_value;
   sensor_digital = digitalRead(MOISTUREPIN);
   ldr_value = digitalRead(LDRPIN);
   moisture_percentage = ( ( (sensor_digital/1023.00) * 100 ) );
  
  
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }

  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  String pump_status = "on";
  String humidifier_status = "off";
  String bulb_status = "on";
  int chamber_id = 1;
  String url = "/insert2.php?temp=" + String(t) + "&hum="+ String(h)+ "&moisture="+ String(moisture_percentage)+"&ldr="+ String(ldr_value)+"&pump_status="+ String(pump_status)+"&humidifier_status="+ String(humidifier_status)+"&chamber_id="+ String(chamber_id);
  Serial.print("Requesting URL: ");
  Serial.println(url);
  
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  delay(500);
  
  while(client.available()){
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }
  
  Serial.println();
  Serial.println("closing connection");
  delay(8000);
}
