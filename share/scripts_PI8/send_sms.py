#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import time,serial,sys,logging

espace="..."
message=""
nb_arg=len(sys.argv)
message=message+sys.argv[1]+espace
phone=serial.Serial(port="/dev/ttyAMA0",baudrate=115200,timeout=2)
print(message)
mess = (message+'\r\n').encode('utf-8')
phone.write(mess)


