<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
<title>object submission</title>
<link rel="shortcut icon" href="pic/favicon.ico">
<style>

/*
***
*	input required make sure the input cannot be left empty and input type corrects the form of input.
***
*/



body {
  width: 100%;
}
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
.container {
  padding: 15px;
  background-color: white;
}
input[id=name],input[type=file],textarea {
  width: 98%;
  padding: 20px;
  margin: 5px 5px 22px 0px;
  display: inline-block;
  border: none;
  background: #f1f1f1;
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
<body style="background-color:Black;">

<!--theme of the webpage-->
<div class="header">
  <h1>Impression on Hamilton</h1>
  <p>Come to put and rate your trip around Hamilton here</p>
</div>

<!--navigation bar-->
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

<!--new object need name, exact location, some description and may include an image-->
<form action="addspot.php" method="post">
  <div class="container">
    <h1>Post New Object</h1>
    <hr>
	<p>Type of object:
    <br />
    <input type="radio" name="type" value=0 checked="checked" /> Travel Spot
    <input type="radio" name="type" value=1 /> food
    </p>
    <label for="name"><b>Object Name</b></label>
    <input type="text" placeholder="Enter Object Name" id="name" name="travel" required>
    <p><b>Location (at most 6 index)</b></p>
    <div>
    <br>
    <input type="number" step="0.000001" placeholder="latitude" name="geola" required>
    <input type="number" step="0.000001" placeholder="longitude" name="geolo" required>
    </div>
    <br>
    <p><b>Description</b></p>
    <textarea name="discribe" rows="5" required>Enter the description</textarea>
    <label for="image"><b>Upload image (optional)</b></label>
    <input type="file" id="fileToUpload" name="fileToUpload" accept="image/*">
    <hr>
    <input type="submit">
  </div>
</form>


<!--Emailing address and name and student number-->
<div class="footer">
  <p>Made by: Shuo Zhang;  Student #: 400065241</p>
  <p>Contact information: <a href="mailto:zhans18@mcmaster.ca">zhans18@mcmaster.ca</a>.</p>
</div>
</body>
</html>