#!/usr/bin/python
import serial
from time import sleep
ser = serial.Serial("/dev/ttyACM0", 9600, timeout=0.5)
ser.write("2")
sleep(1)
ser.write("2")
sleep(1)
ser.write("2")
sleep(1)
