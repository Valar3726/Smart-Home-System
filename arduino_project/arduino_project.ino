#include <dht11.h>
#include<Wire.h>
#include<math.h>
dht11 DHT11;

#define DHT11PIN 2
#define BH1750_ADDRESS 0x23
#define lx1_120ms 0x10
byte buff[2];
byte ch;
byte state;
void setup()
{

  Wire.begin();
  Serial.begin(9600);
  Serial.println("DHT11 TEST PROGRAM ");
  Serial.print("LIBRARY VERSION: ");
  Serial.println(DHT11LIB_VERSION);
  Serial.println();
  pinMode(13, OUTPUT);
}

void loop()
{

  Serial.println("\n");

  int chk = DHT11.read(DHT11PIN);

  Serial.print("Read sensor: ");
  switch (chk)
  {
    case DHTLIB_OK:
                Serial.println("OK");
                break;
    case DHTLIB_ERROR_CHECKSUM:
                Serial.println("Checksum error");
                break;
    case DHTLIB_ERROR_TIMEOUT:
                Serial.println("Time out error");
                break;
    default:
                Serial.println("Unknown error");
                break;
  }


  Serial.println((float)DHT11.humidity, 2);


  Serial.println((float)DHT11.temperature, 2);

  Serial.print("Temperature (oF): ");
  Serial.println(Fahrenheit(DHT11.temperature), 2);

  Serial.print("Temperature (K): ");
  Serial.println(Kelvin(DHT11.temperature), 2);

  Serial.print("Dew Point (oC): ");
  Serial.println(dewPoint(DHT11.temperature, DHT11.humidity));

  Serial.print("Dew PointFast (oC): ");
  Serial.println(dewPointFast(DHT11.temperature, DHT11.humidity));


  Serial.println( BH1750() );
  if ( state == '1')
  {
    Serial.println("LED OPEN");
  }
  else
  {
    Serial.println("LED CLOSED");
  }
  if ( Serial.available() )
  {
    ch = Serial.read();
    if ( ch == '1' )
    {
      Serial.println("LED already open");
      digitalWrite(13, HIGH);
      state = '1';
    }
    else if ( ch == '2')
    {
      digitalWrite(13, LOW);
      Serial.println("LED already close");
      state = '0';
    }
  }

   delay(2000);
}
double BH1750(){

  int counter=0;
  double value=0;
  Wire.beginTransmission(BH1750_ADDRESS);
  Wire.write(lx1_120ms);
  Wire.endTransmission();
  delay(200);


  Wire.beginTransmission(BH1750_ADDRESS);
  Wire.requestFrom(BH1750_ADDRESS, 2);
  while( Wire.available() ){
    buff[counter++]=Wire.read();
  }
  Wire.endTransmission();

  if(2==counter){
    value=( buff[0]<<8 | buff[1] )/1.2;
  }
  return value;
}


double Fahrenheit(double celsius)
{
        return 1.8 * celsius + 32;
}


double Kelvin(double celsius)
{
        return celsius + 273.15;
}


double dewPoint(double celsius, double humidity)
{
        double A0= 373.15/(273.15 + celsius);
        double SUM = -7.90298 * (A0-1);
        SUM += 5.02808 * log10(A0);
        SUM += -1.3816e-7 * (pow(10, (11.344*(1-1/A0)))-1) ;
        SUM += 8.1328e-3 * (pow(10,(-3.49149*(A0-1)))-1) ;
        SUM += log10(1013.246);
        double VP = pow(10, SUM-3) * humidity;
        double T = log(VP/0.61078);
        return (241.88 * T) / (17.558-T);
}


double dewPointFast(double celsius, double humidity)
{
        double a = 17.271;
        double b = 237.7;
        double temp = (a * celsius) / (b + celsius) + log(humidity/100);
        double Td = (b * temp) / (a - temp);
        return Td;
}
