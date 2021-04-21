#include "Arduino.h"
#include "Pump.h"
#include <Adafruit_Sensor.h>
#include <DHT.h>
// Set DHT pin:
#define DHTPIN 3

const int timeout = 10000;       //define timeout of 10 sec
char menuOption = 0;
long time0;


const int sensor_pin = A10;
#define RELAYMODULE4CH_PIN_IN1  5
#define RELAYMODULE4CH_PIN_IN2  6
#define RELAYMODULE4CH_PIN_IN4  8
#define RELAYMODULE4CH_PIN_IN3  7
const int RELAY_PIN = A5;

int RelayModule4chPins[] = { RELAYMODULE4CH_PIN_IN1, RELAYMODULE4CH_PIN_IN2, RELAYMODULE4CH_PIN_IN3, RELAYMODULE4CH_PIN_IN4 };
//Pump waterpump(WATERPUMP_PIN_COIL1);


// Set DHT type, uncomment whatever type you're using!
//#define DHTTYPE DHT11   // DHT 11
#define DHTTYPE DHT22   // DHT 22  (AM2302)
//#define DHTTYPE DHT21   // DHT 21 (AM2301)

// Initialize DHT sensor for normal 16mhz Arduino:
DHT dht = DHT(DHTPIN, DHTTYPE);

void setup() {
  // Begin serial communication at a baud rate of 9600:
  Serial.begin(9600);
    pinMode(RELAY_PIN, OUTPUT);



  // Setup sensor:
  dht.begin();
     pinMode(RELAYMODULE4CH_PIN_IN1, OUTPUT);
    pinMode(RELAYMODULE4CH_PIN_IN2, OUTPUT);
    pinMode(RELAYMODULE4CH_PIN_IN3, OUTPUT);
    pinMode(RELAYMODULE4CH_PIN_IN4, OUTPUT);

//mosfet
// digitalWrite(RELAY_PIN, LOW); 
}


void loop() {
 

  ///////////////////////////////////////////
  /////mosfet
  digitalWrite(RELAY_PIN, HIGH); // turn on pump 5 seconds
//  delay(1000);
//  digitalWrite(RELAY_PIN, LOW);  // turn off pump 5 seconds
//  delay(1000);  
   
   






//////////////light intensity module code
unsigned int AnalogValue;

AnalogValue = analogRead(24);

Serial.println(AnalogValue);

  ////////////////////////////////////////////
  float moisture_percentage;
  int sensor_analog;
  sensor_analog = analogRead(sensor_pin);
  moisture_percentage = ( ( (sensor_analog/1023.00) * 100 ) );
  Serial.print("Moisture Percentage = ");
  Serial.print(moisture_percentage);
  Serial.print("%\n");
  delay(1000);




///////////////////////////////////////////////
 
  //humidity temperature code
 
  // Wait a few seconds between measurements:
  delay(500);

  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)

  // Read the humidity in %:
  float h = dht.readHumidity();
  // Read the temperature as Celsius:
  float t = dht.readTemperature();
  // Read the temperature as Fahrenheit:
  float f = dht.readTemperature(true);

  // Check if any reads failed and exit early (to try again):
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }

  // Compute heat index in Fahrenheit (default):
  float hif = dht.computeHeatIndex(f, h);
  // Compute heat index in Celsius:
  float hic = dht.computeHeatIndex(t, h, false);


  Serial.print("Humidity: ");
  Serial.print(h);
  Serial.print(" % ");
  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.print(" \xC2\xB0");
  Serial.print("C | ");
  Serial.print(f);
  Serial.print(" \xC2\xB0");
  Serial.print("F ");
  Serial.print("Heat index: ");
  Serial.print(hic);
  Serial.print(" \xC2\xB0");
  Serial.print("C | ");
  Serial.print(hif);
  Serial.print(" \xC2\xB0");
  Serial.println("F");



  ///////////////////////////////////////////
    // Relay Module 4-Ch - Test Code
    //This loop will turn on and off each relay in the array for 0.5 sec
//    for (int i = 0; i < 4; i++) 
//{
//    digitalWrite(RelayModule4chPins[i],LOW);
//
//}
//    Serial.print("all are off\n");
 
//bulb
if(t<=28)
{
    digitalWrite(RelayModule4chPins[0],LOW);
        Serial.print("Bulb on\n");
    delay(500);
}
else if(t>28)
{
    digitalWrite(RelayModule4chPins[0],HIGH);
        Serial.print("Bulb off\n");
    //delay(500);
}    

//humidifier system
if(h<=45)
{
    digitalWrite(RelayModule4chPins[1],LOW);
        Serial.print("humidifier system on\n");
    delay(500);
}
else if(h<45)
{
    digitalWrite(RelayModule4chPins[1],HIGH);
        Serial.print("humidifier system off\n");
    //delay(500);
}

  //pump
if(moisture_percentage>=40)
{
    digitalWrite(RelayModule4chPins[2],LOW);
        Serial.print("Pump on\n");
//    delay(500);
}
else if(moisture_percentage<50)
{
    digitalWrite(RelayModule4chPins[2],HIGH);
    Serial.print("Pumpn off\n");
    //delay(500);
}



//    fan
if(t<=28)
{
    digitalWrite(RelayModule4chPins[3],LOW);
        Serial.print("fan on\n");
    delay(500);
}
else if(t>28)
{
    digitalWrite(RelayModule4chPins[3],HIGH);
        Serial.print("fan off\n");
    //delay(500);
}
//    }
/////////////////////////////////////////////////
   delay(3000);
}