# Smart-Home-System
Based on WeChat Public Platform

# Arduino

Connect DHT11 and BH1750FVI sensors to get current temperature, humidity and
luminosity data.
It use Serial to communicate with sensors and Raspberry Pi.

# Raspberry Pi

1. write_open.py is to write the data to the Arduino to control the LED in the Arduino to open.

2. write_close.py is to write the data to the Arduino to control the LED in the Arduino to close.

3. data.py is receive the data from the Arduino board and save it to the file.

4. client.php is to write and read the data between the Arduino board and send the data to Alibaba ECS by socket communication.

# ali server

1. imagemake.php and image2make.php is to zoom the original picture to adapt the WeChat Public Platform requirement.

2. text.php is the function definition to the WeChat Public Platform.

3. server.php is to receive and send the message between the Raspberry Pi.

4. sample.php is to receive and send message between users. According to the user's information to select which command run.
