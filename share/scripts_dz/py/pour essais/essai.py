#!/usr/bin/env python3.7 -*- coding: utf-8 -*-
from periphery import Serial
import time
# control
serial = Serial("/dev/ttyUSB0", 115200) #pour le PI , ttyAMA1
while True:
    serial.write(b"Bonjour michel") # pour le PI bonjour Domoticz
    time.sleep(5)
    # Read up to 128 bytes with 500ms timeout
    buf = serial.read(128, 0.5).decode()
    print("read {:d} bytes: _{:s}_".format(len(buf), buf))
    time.sleep(5)
