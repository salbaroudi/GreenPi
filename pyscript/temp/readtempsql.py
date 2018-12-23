import os
import glob
import datetime
import mysql.connector
from mysql.connector import Error

#Support functions
#------------------------------------
#Signature: -> String[date]
#Purpose:Get the current time, and put it in a SQL DATETIME string format!
def getTime():
	d = datetime.datetime.now()
	return d.strftime("%Y-%m-%d %H:%M:%S")

#Signature: String -> String
#Purpose: Resolve location, read all lines, pass back.
def read_temp_raw(loc):
	f = open(loc, "r")
	lines = f.readlines()
	f.close()
	return lines

#---------------------------------
#This gets all folders that match 28-XXXX ids. There should only be one.
base_dir = "/sys/bus/w1/devices/"
device_folder = glob.glob(base_dir + "28*")

#these will be our values we pump into the database.
dbdate = getTime()
dbtemp = ""

#only have one device...using in operator to unpack.
for devStr in device_folder:
	devID = devStr[20:27] #fragile, but we have a consistent file system.
	lines = read_temp_raw(devStr + "/w1_slave")	
	#Basic Error Checking
	if ( lines[0].find("YES") == -1):
		print("ERROR: CRC check sum indicates an ERROR. Aborting")
		sys.exit(2)
	if (lines[1].find("t=") == -1):
		print("ERROR: No temp reading found; Aborting")
		sys.exit(2)
	equals_pos = lines[1].find("t=")	
	temp_string = lines[1][equals_pos+2:]
	temp_c = float(temp_string) / 1000.0
	dbtemp = str(temp_c)

#Now that we extracted out temp measurement, do the database call.
try :
	query = "INSERT INTO tprobe0417(date,temp) VALUES(%s,%s)"
	args = (dbdate,dbtemp)
	conn = mysql.connector.connect(host="localhost", database="datalogger",user="root",password="whatisthedealio")
	cursor = conn.cursor()
	if (not conn.is_connected()):
		raise Error("Connection not made, aborting")
	cursor.execute(query, args)
	
	if (not cursor.lastrowid):
		raise Error("No last insertion ID; reading not inserted.")
	#else:
	#	print("LAST ID =", cursor.lastrowid)
	conn.commit()
except Error as e:
		print(e)
		sys.exit(2)
finally:
	cursor.close()
	conn.close()
