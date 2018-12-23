import os
import glob
import datetime

base_dir = "/sys/bus/w1/devices/"
base_write_dir = "/home/pi/pythonTemp/"
device_folder = glob.glob(base_dir + "28*")

def getTime():
	d = datetime.datetime.now()
	return (str(d.hour) + ":" + str(d.minute))

def read_temp_raw(loc):
	f = open(loc, "r")
	lines = f.readlines()
	f.close()
	return lines

for devStr in device_folder:
	devID = devStr[20:27] #fragile, but we have a consistent file system.
	lines = read_temp_raw(devStr + "/w1_slave")
	#print(lines)
	#while lines[0].strip()[-3:] != "YES":
	#	time.sleep(0.2)
	#	lines = read_temp_raw()
	equals_pos = lines[1].find('t=')
	if equals_pos != -1: #pull and write the data.
		temp_string = lines[1][equals_pos+2:]
		temp_c = float(temp_string) / 1000.0
		print(str(temp_c))
		#Now, we open our premade files, and append lines to them.
		fO = open(base_write_dir + devID + ".csv" ,"a")
		fO.write(getTime() + "," + devID  + "," +  str(temp_c) + "\n")
		fO.close()
