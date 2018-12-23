# Simple example of reading the MCP3008 analog input channels and printing
# them all out.
# Author: Tony DiCola
# License: Public Domain
import time

# Import SPI library (for hardware SPI) and MCP3008 library.
import Adafruit_GPIO.SPI as SPI
import Adafruit_MCP3008


# Software SPI configuration:
#Note that these are GPIO pin configurations; not physical or BCM.
CLK  = 12
MISO = 16
MOSI = 20
CS   = 21
mcp = Adafruit_MCP3008.MCP3008(clk=CLK, cs=CS, miso=MISO, mosi=MOSI)

# Hardware SPI configuration:
# SPI_PORT   = 0
# SPI_DEVICE = 0
# mcp = Adafruit_MCP3008.MCP3008(spi=SPI.SpiDev(SPI_PORT, SPI_DEVICE))


print('Running Experiment')
# Print nice channel column headers.
# Main program loop.
expList = []
for i in range(1,21):
	value = mcp.read_adc(0)
	print(str(value))
	time.sleep(0.5)

	if (i <= 10):
		continue 
	else: 
		expList.append(value)

print("ExpList: " + str(expList))
print("Max:" + str(max(expList)))
print("Min:" + str(min(expList)))
print("Average:" + str(sum(expList)/10))
