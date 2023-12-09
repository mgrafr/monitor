#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import time,serial,sys,logging

#if __name__ == "__main__":
    #logging.basicConfig(level=logging.DEBUG, filename="/home/michel/logfile", $
                        #format="%(asctime)-15s %(levelname)-8s %(message)s")
    #logging.info(sys.argv[0])
espace="..."
message=""
nb_arg=len(sys.argv)
message=message+sys.argv[1]+espace
n=2
phone=serial.Serial(port="/dev/ttyAMA1",baudrate=115200,timeout=2)
while n<nb_arg:
    tel=sys.argv[n]
    print(message)
    print(tel)
    mess = ('AT+SMSSEND='+tel+','+message+'\r\n').encode('utf-8')
    phone.write(mess)
    n=n+1
  