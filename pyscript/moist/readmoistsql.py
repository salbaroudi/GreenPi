import os
import datetime
import mysql.connector
from mysql.connector import Error
import Adafruit_GPIO.SPI as SPI
import Adafruit_MCP3008
from math import floor

#Support functions
#------------------------------------
#Signature: -> String[date]
#Purpose:Get the current time, and put it in a SQL DATETIME string format!
def getTime():
	d = datetime.datetime.now()
	return d.strftime("%Y-%m-%d %H:%M:%S")

#Signature: Float Float Int Int -> None
#Purpose: Just print out to inquire if things are working.
def debugQuery(m_slope,b_int,reading,dbmoist):
	print( "slope is: " + str(m_slope))
	print("intercept is: " + str(b_int))
	print("Digital Level is" + str(reading))
	print("Moisture % is:" + str(dbmoist))
#---------------------------------
# Software SPI configuration:
#Note that these are GPIO pin configurations; not Physical Locations on Board.
CLK  = 12
MISO = 16
MOSI = 20
CS   = 21
mcp = Adafruit_MCP3008.MCP3008(clk=CLK, cs=CS, miso=MISO, mosi=MOSI)
analoginputnum = 0 #first pin on our chip.

#Calibration Settings: Assume a simple linear scale (for now).
hiLev =  1024 #Corresponds to 0 moisture
loLev  = 300 #Corresponds to "totally wet"

#Lets calcualate our line parameters for our moisture scale
m_slope = -100 / (hiLev - loLev) #y = mx + b....
b_int =  -m_slope*hiLev 

#these will be our values we pump into the database.
dbdate = getTime()
reading=  mcp.read_adc(analoginputnum) #returns an integer

if (not (reading > 0 and reading < 1024)):
	print("Error: MCP library returned Digitized value out of range. Aborting")
	sys.exit(2)

#Successful, so now lets convert our value.
dbmoist = floor(m_slope*reading + b_int)
#debugQuery(m_slope,b_int,reading,dbmoist)

try :
	query = "INSERT INTO mprobe(date,moistlevel) VALUES(%s,%s)"
	args = (dbdate,dbmoist)
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

