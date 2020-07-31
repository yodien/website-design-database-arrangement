<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<title>Register&Sign in account</title>
<link rel="shortcut icon" href="pic/favicon.ico">
<script src="validating.js" defer></script>
<style>

/*
***
*	header and navigation bar is always on the top and footer is always at bottom
*	form on picture
***
*/

body, html {
  height: 100%;
}
* {
  box-sizing: border-box;
}

.header {
  padding: 10px;
  text-align: center;
  background: #312F2E;
  color: white;
  font-size: 30px;
}
.footer {
   
   left: 0;
   bottom: 0px;
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

.bgi {

  background-image: url("pic/hamiltonart.jpg");
  min-height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
.container {
  position: absolute;
  right: 0;
  margin: 10px;
  width: 300px;
  padding: 20px;
  background-color: Grey;
  opacity: 0.95;
}

input[type=text], input[type=password],input[type=email] {
  width: 100%;
  padding: 10px;
  margin: 0px 0 5px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 10px;
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

<!--theme of the webpage and navigation bar-->
<div class="header">
  <h1>Impression on Hamilton</h1>
  <p>Come to put and rate your trip around Hamilton here</p>
</div>
<ul class="navi">
  <li class="navii"><a href="homepage.php">Home</a></li>
  <li class="navii"><a class="active" href="travel.php">Travel Spot</a></li>
  <li class="navii"><a href="food.php">Food</a></li>
  <li class="navii"><a href="#Register&Sign">Register&Sign</a></li>
</ul>

<!--registration form on image, need email, unsername and password to create account, has link to sign page-->
<div class="bgi">
  <form method="post" action="adduser.php" class="container" id="form">
    <h1>Register</h1>

    <div>
            <label id="error_List">


            </label>
        </div>

    <hr>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" id="email" name="emails">

    <label for="user"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" id="user" name="username">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="psw" name="psw_1">

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" id="psw-repeat" name="psw_2">
    <hr>
    <input type="submit" name="register">
    <p>For  Registered user: <a href="sign.php">Sign in</a>.</p>   
  </form>
</div>

<!--Emailing address and name and student number-->
<div class="footer">
  <p>Made by: Shuo Zhang;  Student #: 400065241</p>
  <p>Contact information: <a href="mailto:zhans18@mcmaster.ca">zhans18@mcmaster.ca</a>.</p>
</div>
</body>
</html>