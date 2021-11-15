#!/bin/bash

echo $1
echo $2
a="#"
c=$1$a$2

echo $c
cd /home/michel/python
fab maintask --don=$c  > /home/michel/fab.log 2>&1