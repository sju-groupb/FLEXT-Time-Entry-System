#!/usr/bin/env python

#import mysql.connector
import MySQLdb
#from mysql.connector import (connection)
import os
import glob
import time
import datetime


now = datetime.datetime.now()
date = now.strftime("%Y-%m-%d")
print date

db = MySQLdb.connect(host="timeflexsystem.cjjaiocspkz6.us-east-1.rds.amazonaws.com", user="timeflexsystem", passwd="timeflexsystem", db="timeflexsystem")
curs=db.cursor()
zero=0.0

curs.execute("INSERT INTO TimeClock (Name,Date) VALUES (%s,%s)", ["Employee Name",date])

db.commit()
curs.close()
db.close()