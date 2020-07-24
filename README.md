## TerraPi: A Multi-Relay and Sensor Terrarium Project:

### Introduction:

This project integrates various sensors and relays to produce a monitoring platform for a Terrararium.

### Precursors and Sources:

The original code base for this project was sourced from RasPiVivarium, a defunct Raspberry Pi sensor/relay project. This code based utilized python, php, javascript, mysql and was served on a standard LAMP stack, with a basic user interface.

### Design:

The project is made to automate the maintenance and monitoring of an indoor terrarium. It is a prototype device, as seen below:

![alt text][components]

![alt text][relays]

![alt text][sensors]

#### Hardware:
1) Large Indoor Planter.
2) Raspberry Pi 3.
2) Songle (5V, 10A) Double Relays (x2): These are connected to 120V mains power - and upto 4 receptacles can be independently toggled to control a variety of devices. For this project, we did: fans, pums, lights and a small heater.
3) Atlas Scientific K=1.0 ECM/PPM/Salt sensor: used to accurately feed the plants.
4) Analog Moisture Sensor + MCP3008 ADC.
5) DS1820B Waterproof temperature probe.

The project currently consolidates all controls, readouts and graphs onto one webpage. It is designed so that a client can use a cellphone to check on their terrarium when away.

A sample mock-up of Terrarium's front end page can be seen #### [here][site]

[components]: ./pics/components.jpg

[relays]: ./pics/relaywiring.jpg

[sensors]: ./pics/sensorwiring.jpg

[site]: http://www.cumulativeparadigms.org/html/monitor.html
