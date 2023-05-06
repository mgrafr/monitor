#!/usr/bin/env python2.7
# -*- coding: utf-8 -*-
from fabric import Connection
from fabric.tasks import task
from connect import ip_monitor
HOST = ip_monitor
@task
def subtask(ctx, donn):
  with ctx.cd("/var/www/html/monitor/python"):
    ctx.run(donn)
    
@task( optional = ['don'])
def maintask(ctx, don = None ):
    con = Connection(host = HOST, user = 'root', connect_kwargs = {'password':'MOT_PASSE'})
    file = "python3 sqlite_mysql.py "
    donn = file+don
 
    print(subtask(con,donn))



 