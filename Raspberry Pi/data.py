#!/usr/bin/python
# coding:utf-8
import serial
from time import sleep
ser = serial.Serial("/dev/ttyACM0", 9600, timeout=0.5)
def recv(serial):

    while True:
        data =serial.read(300)
        if data.find('Read')!=-1:
            break
        else:
            continue

    return data

data =recv(ser)
f = open("data.txt","w")
f.write(data)
f.close()
