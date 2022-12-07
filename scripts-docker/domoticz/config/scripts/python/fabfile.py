#!/usr/bin/env python2.7
# -*- coding: utf-8 -*-
from fabric import Connection
from fabric.tasks import task


@task
def subtask(ctx, donn):
  with ctx.cd("/www/monitor/python"):
    ctx.run(donn)
    
@task( optional = ['don'])
def maintask(ctx, don = None ):
    con = Connection(host = '192.168.1.7', user = 'michel', connect_kwargs = {'password':'Idem4546'})
    file = "python3 sqlite_mysql.py "
    donn = file+don
 
    print(subtask(con,donn))



 