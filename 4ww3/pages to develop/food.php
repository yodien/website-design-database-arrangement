<?php 
    session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
<title>Eating around Hamilton</title>
<link rel="shortcut icon" href="pic/favicon.ico">
<script src="locationsort.js" defer></script>
<style>

/*
***
*	header and navigation bar is always on the top and footer is always at bottom
*	designed button
*	form on picture
***
*/

.header {
  padding: 10px;
  text-align: center;
  background: #312F2E;
  color: white;
  font-size: 30px;
}
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #282828;
   color: white;
   text-align: center;
}



.container {
  position: relative;
  //right: 30%;
  margin: 5px;
  max-width: 300px;
  padding: 5px;
  color: green;
}

.buttonTYP {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.touri {
  background-image: url("pic/food.jpg");
  min-height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.navi{
  background-color: #383838;
  margin: 0;
  padding: 0;
  overflow: hidden;
  list-style-type: none;
}
.navii{
  float: left;
}

.navii a {
  display: block;
  color: white;
  text-align: center;
  padding: 12px 30px;
  text-decoration: none;
}

.navii a:hover {
  background-color: #181818;
}

input[type=text], select {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

@media screen and (max-width: 540px) {
.footer {
   position: static;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #282828;
   color: white;
   text-align: center;
}
.navii{
  float: none;
}
}
</style>
</head>
<body style="background-color:Black;" class="globalo">

<!--Header shows the theme of this webpage-->
<div class="header">
  <h1>Impression on Hamilton</h1>
  <p>Come to put and rate your trip around Hamilton here</p>
</div>

<!--navigatin bar-->
<ul class="navi">
  <li class="navii"><a href="homepage.php">Home</a></li>
  <li class="navii"><a href="travel.php">Travel Spot</a></li>
  <li class="navii"><a href="#">Food</a></li>
<?php
	if (isset($_SESSION['id'])) {
		echo "<li class='navii'><a href='signout.php'>sign-out</a></li>";
	} else {
		echo "<li class='navii'><a href='register.php'>Register&Sign</a></li>";
	}
?>
</ul>

<!--Searching method, text for restraunt name, radio for location with makeup box button-->
<div class="touri">

  <div>
  <form action="result.php" class="container" method="post">
	<input type="hidden" name="foo" value=1>
    <h2>Search for spots: </h2>
    <p>whats the rate:
    <br />
    <input type="radio" name="rate" value=1 /> 1
    <input type="radio" name="rate" value=2 /> 2
    <input type="radio" name="rate" value=3 /> 3
    <input type="radio" name="rate" value=4 /> 4
    <input type="radio" name="rate" value=5 /> 5
    <input type="radio" name="rate" value=0 checked="checked" /> NULL
    </p>
	
	<label><b>search by your location</b></label>
    <input type="hidden" id="lati1" name="lati1" value=0.0>
    <input type="hidden" id="longi1" name="longi1" value=0.0>
    <button type="button" onclick="getLocation()">Your position</button>
	<p></p>
	<div id="demo"></div>
    <button type="submit" class="buttonTYP">Search</button>
  </form></div>


</div>

<!--Emailing address and name and student number-->
<div class="footer">
  <p>Made by: Shuo Zhang;  Student #: 400065241</p>
  <p>Contact information: <a href="mailto:zhans18@mcmaster.ca">zhans18@mcmaster.ca</a>.</p>
</div>

</body>
</html>