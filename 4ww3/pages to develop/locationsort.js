// All the java script file writen in a seperate .js file need a "script src" in the corresponding html file.
// THe "defer" in script means that the js file will be executed only when the corresponding html page is open

// For html 5 Geolocation API:
// "navigator.geolocation.getCurrentPosition" will try to get the location of your device, The first arguement in
// the bracket will be the function under the condition that the broswer open get the position successfully. and
// the location package will become the argument of that function.
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
}

// "coords.latitude" and "coords.longitude" pass the values to two hidden input. and submit buttom in the html page will submit these two value
// input of type hidden does not provide space for user to enter the value, instead, its value altered by runing functions or simply be a
// constant that passed to the server.
//The submit method will submitt the form and all the value of different id.

function showPosition(position) {
  document.getElementById("lati1").value = position.coords.latitude;
  document.getElementById("longi1").value = position.coords.longitude;
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}