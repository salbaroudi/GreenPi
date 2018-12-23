//JavaScript, use pictures as buttons, sends and receives values to/from the Rpi
//These are all the buttons

var fan_button = document.getElementById("fan_button");
var lights_button = document.getElementById("lights_button");
var heater_button = document.getElementById("heater_button");
var pumps_button = document.getElementById("pumps_button");


//this function sends and receives the pin's status
function change_pin (pin, status) {
	//this is the http request
	var request = new XMLHttpRequest();
	request.open( "GET" , "gpio.php?pin=" + pin + "&status=" + status );
	request.send(null);
	//receiving information
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			return (parseInt(request.responseText));
		}
	//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
	//else
		else { return ("fail"); }
	}
}

//these are all the button's events, it just calls the change_pin function and updates the page in function of the return of it.

fan_button.addEventListener("click", function () {
	//if red
	if ( fan_button.alt === "off" ) {
		//use the function
		var new_status = change_pin ( 4, 0);
		if (new_status !== "fail") {
			fan_button.alt = "on"
			fan_button.src = "./data/buttonimage/fans_on.png";
			return 0;
			}
		}
	//if green
	if ( fan_button.alt === "on" ) {
		//use the function
		var new_status = change_pin ( 4, 1);
		if (new_status !== "fail") {
			fan_button.alt = "off"
			fan_button.src = "./data/buttonimage/fans_off.png";
			return 0;
			}
		}
} );

lights_button.addEventListener("click", function () {
	//if red
	if ( lights_button.alt === "off" ) {
		//use the function
		var new_status = change_pin ( 6, 0);
		if (new_status !== "fail") {
			lights_button.alt = "on"
			lights_button.src = "./data/buttonimage/lights_on.png";
			return 0;
			}
		}
	//if green
	if ( lights_button.alt === "on" ) {
		//use the function
		var new_status = change_pin ( 6, 1);
		if (new_status !== "fail") {
			lights_button.alt = "off"
			lights_button.src = "./data/buttonimage/lights_off.png";
			return 0;
			}
		}
} );

heater_button.addEventListener("click", function () {
	//if red
	if ( heater_button.alt === "off" ) {
		//use the function
		var new_status = change_pin ( 1, 0);
		if (new_status !== "fail") {
			heater_button.alt = "on"
			heater_button.src = "./data/buttonimage/heaters_on.png";
			return 0;
			}
		}
	//if green
	if ( heater_button.alt === "on" ) {
		//use the function
		var new_status = change_pin ( 1, 1);
		if (new_status !== "fail") {
			heater_button.alt = "off"
			heater_button.src = "./data/buttonimage/heaters_off.png";
			return 0;
			}
		}
} );

pumps_button.addEventListener("click", function () {
	//if red
	if ( pumps_button.alt === "off" ) {
		//use the function
		var new_status = change_pin ( 5, 0);
		if (new_status !== "fail") {
			pumps_button.alt = "on"
			pumps_button.src = "./data/buttonimage/pumps_on.png";
			return 0;
			}
		}
	//if green
	if ( pumps_button.alt === "on" ) {
		//use the function
		var new_status = change_pin ( 5, 1);
		if (new_status !== "fail") {
			pumps_button.alt = "off"
			pumps_button.src = "./data/buttonimage/pumps_off.png";
			return 0;
			}
		}
} );
