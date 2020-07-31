<?php 
    session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
<title>Hamilton Impression</title>
<link rel="shortcut icon" href="pic/favicon.ico">
<style>

/*
***
*	header and navigation bar is always on the top and footer is always at bottom
*	despay of image content to attract users.
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
   position: static;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #282828;
   color: white;
   text-align: center;
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


.row {
  content: "";
  clear: both;
}
.column {
  float: left;
  width: 50%;
  padding: 0px;
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
.column {
  float: none;
  width: 100%;
  padding: 0px;
}
}
</style>
</head>
<body style="background-color:Black;">

<!--header shows the theme of this webpage-->
<div class="header">
  <h1>Impression on Hamilton</h1>
  <p>Come to put and rate your trip around Hamilton here</p>
</div>

<!--navigation bar with 4 elements-->
<ul class="navi">
  <li class="navii"><a href="homepage.php">Home</a></li>
  <li class="navii"><a href="travel.php">Travel Spot</a></li>
  <li class="navii"><a href="food.php">Food</a></li>
<?php
	if (isset($_SESSION['id'])) {
		echo "<li class='navii'><a href='signout.php'>sign-out</a></li>";
	} else {
		echo "<li class='navii'><a href='register.php'>Register&Sign</a></li>";
	}
?>
</ul>

<!--These image are now for good look, may be implement as link to object in the future-->
<img src="pic/tewsfall.jpg" alt="tew's fall" style="width:100%">
<div class="row">
  <div class="column">
    <img src="pic/saigonBBQ.jpg" alt="saigon_Korean_BBQ" style="width:100%">
  </div>
  <div class="column">
    <img src="pic/mcmasterartmuseum.jpg" alt="museum_of_art" style="width:100%">
  </div>
</div>
<div class="row">
</div>

<!--Emailing address and name and student number-->
<div class="footer">
  <p>Made by: Shuo Zhang;  Student #: 400065241</p>
  <p>Contact information: <a href="mailto:zhans18@mcmaster.ca">zhans18@mcmaster.ca</a>.</p>
</div>
</body>
</html>