#!/usr/bin/env python3 -*- coding: utf-8 -*-

import datetime

def is_odd_week():
    week_number = datetime.date.today().isocalendar()[1]
    if week_number % 2 == 0:
        a='Semaine_paire'
    else:
        a='Semaine_impaire' 
    return a
a= is_odd_week()  

file = open('/opt/domoticz/www/modules_lua/week.lua', 'w+') 
file.write('sem="'+a+'"')
file.close()
