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
    val1=temp[1]
    val=temp[2]+" "+temp[3]
    print(table)
    print(val)
    print(val1)               
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
        query = "INSERT INTO "+table+" (date,valeur) VALUES(%s, %s)"
        values = (val, val1)
        cursor.execute(query, values)
                          
        
    connection.commit()
    print(cursor.rowcount, "Record inserted successfully into Laptop table")
        
        
        

except Error as e:
    print("Error while connecting to MySQL", e)
finally:
    if (connection.is_connected()):
        cursor.close()
        connection.close()
        print("MySQL connection is closed")