#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import time,serial,sys,logging

nb_arg=len(sys.argv)
#if __name__ == "__main__":
    #logging.basicConfig(level=logging.DEBUG, filename="/home/michel/logfile", filemode="a+",
                        #format="%(asctime)-15s %(levelname)-8s %(message)s")
    #logging.info(sys.argv[0])
espace="..."
message=""
nb_arg=len(sys.argv)
n=1
while n<nb_arg:
    message=message+sys.argv[n]+espace
    print(message)
    n=n+1


message = ('AT+SMSSEND=06xxxxxxxx,'+message+'\r\n').encode('utf-8')
phone=serial.Serial(port="/dev/ttyAMA1",baudrate=115200,timeout=2)
phone.write(b'+++')
time.sleep(2)
phone.write(b'AT+VER\r\n')
time.sleep(1)
phone.write(message)
