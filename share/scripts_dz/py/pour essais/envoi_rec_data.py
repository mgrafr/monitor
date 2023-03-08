#!/usr/bin/env python3.7 -*- coding: utf-8 -*-
from periphery import Serial
# Open /dev/serial2 with baudrate 115200, and defaults of 8N1, no flow
# control
serial = Serial("/dev/ttyS0", 115200)
serial.write(b"Hello World!")
# Read up to 128 bytes with 500ms timeout
buf = serial.read(128, 0.5).decode()
print("read {:d} bytes: _{:s}_".format(len(buf), buf))



