#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import sys
import mysql.connector
from mysql.connector import Error
total_arg = len(sys.argv)
if (total_arg>0) :
    x= str(sys.argv[1])
    temp = x.split('#')
    table=temp[0]
    champ=temp[1]
    val1=temp[2]
    val=temp[3]+" "+temp[4]
if (len(temp)==7) :
    champ2=temp[5]
    val2=temp[6]
try:
    connection = mysql.connector.connect(
          host = "127.0.0.1",
          user = "michel",
          password = "Idem4546",
          database = "domoticz")

    if connection.is_connected():
        db_Info = connection.get_server_info()
        print("Connected to MySQL Server version ", db_Info)
        cursor = connection.cursor()
        cursor.execute("select database();")
        record = cursor.fetchone()
        print("You're connected to database: ", record)
        if (len(temp)==7) :
            query = "INSERT INTO "+table+" (date,"+champ+","+champ2+") VALUES(%>
            values = (val, val1, val2)
        else :
            query = "INSERT INTO "+table+" (date,"+champ+") VALUES(%s, %s)"
            values = (val, val1)
        cursor.execute(query, values)


    connection.commit()
    print(cursor.rowcount, "Record inserted successfully into Laptop table")

except Error as e:
    print("Error while connecting to MySQL", e)
finally:
    if (connection.is_connected()):
        cursor.close()

