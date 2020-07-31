<?php 
    session_start();
	
	$la = 0.0;
	$lo = 0.0;
	$rat = 0;
	if (isset($_POST['lati1']) && isset($_POST['longi1']) && isset($_POST["rate"])) {
		$la = floatval($_POST['lati1']);
		$lo = floatval($_POST['longi1']);
		$rat = intval($_POST['rate']);
	} else {
		header("Location: https://{$_SERVER['HTTP_HOST']}/project3/travel.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
<title>Landscape</title>
<link rel="shortcut icon" href="pic/favicon.ico">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
<style>

/*
***
*	header and navigation bar is always on the top and footer is always at bottom
*	table of object
*	The L.map setview give the view of given location and zoom
*	tilelayer set the url template to allowed me to use the osm
*	marker pop out a given location in the map (usually same as the location in set view----marker at center of map)
*	onmapclick will react to our mouse action or finger press on the screen.
*	The popup in the onmapclick means when click on the map, a popup bubble will appear.
*	Same change to sampleobject page, so comments are write here only
***
*/

table{
width: 100%;
}
table, th, td {
  border: 1px solid white;
  color: white;
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
#Map {
  position:relative;
  text-align:right;
  height:400px;
  width:320px;
  padding: 1px;
}


a {
  color: Red;
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

<!--this page are mainly a blueprint of the future page after serverside code introduced-->
<div class="header">
  <h1>Impression on Hamilton</h1>
  <p>Come to put and rate your trip around Hamilton here</p>
</div>
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

<!--table of object nearby in similar rate or just come out by name searching-->
<?php
	$pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'root', 'password');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (isset($_POST['tra'])) {
		$trfo = 0;
	} else if (isset($_POST['foo'])){
		$trfo = 1;
	} else {
		$trfo = 0;
		echo "<div><h2 style='color:white'>search default: travel spot</h2></div>";
	}
	
	if ($rat != 0) {
		$sql = "SELECT id, spot_name, latitude, longitude FROM spot WHERE latitude <= ? AND latitude >= ? AND longitude <= ? AND longitude >= ? AND rate = ? AND trafoo = ?";
		$stmnt = $pdo->prepare($sql);
		$stmnt->bindValue(1, $la + 0.035);
		$stmnt->bindValue(2, $la - 0.035);
		$stmnt->bindValue(3, $lo + 0.035);
		$stmnt->bindValue(4, $lo - 0.035);
		$stmnt->bindValue(5, $rat);
		$stmnt->bindValue(6, $trfo);
	} else {
		$sql = "SELECT id, spot_name, latitude, longitude FROM spot WHERE latitude <= ? AND latitude >= ? AND longitude <= ? AND longitude >= ? AND trafoo = ?";
		$stmnt = $pdo->prepare($sql);
		$stmnt->bindValue(1, $la + 0.035);
		$stmnt->bindValue(2, $la - 0.035);
		$stmnt->bindValue(3, $lo + 0.035);
		$stmnt->bindValue(4, $lo - 0.035);
		$stmnt->bindValue(5, $trfo);
	}
	
	try {
				$stmnt->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
		}
		
	$rows = $stmnt->fetchAll();
	
	echo "<form action='object.php' method='post'>";
	echo '<table><tr>
		<th>id</th>
		<th>Name of Tourist Spot</th>
		<th>Latitude</th>
		<th>Longitude</th>
		</tr>';

    foreach ($rows as $line) {
		echo "<tr><td><input type='radio' name='objectid' value=".$line['id']." /></td>".
			 "<td>".$line['spot_name']."</td>".
			 "<td>".$line['latitude']."</td>".
			 "<td>".$line['longitude']."</td></tr>";
	}
	echo '</table>';
	echo "<button type='submit'>enter</button></form>";
	echo "<br>";
	echo "<br>";
	if (isset($_SESSION['id']) && $_SESSION['id'] != '') {
		echo "<tr><td><a href='objectsubmission.php'>Post New Object</a></td>";
	}
?>

<!--following the guide on side for leaflet, just change the lati-longi value and leave only marker simbol on it-->
<div id="Map"></div>
<script>
	var lat  = "<?php echo $la ?>";
	var lon  = "<?php echo $lo ?>";
	var mymap = L.map('Map').setView([lat, lon], 12);
	
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(mymap);
	
	L.marker([lat, lon]).addTo(mymap);
	var popup = L.popup();
	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent(e.latlng.toString())
			.openOn(mymap);
	}

	mymap.on('click', onMapClick);
</script>

<!--Emailing address and name and student number-->
<div class="footer">
  <p>Made by: Shuo Zhang;  Student #: 400065241</p>
  <p>Contact information: <a href="mailto:zhans18@mcmaster.ca">zhans18@mcmaster.ca</a>.</p>
</div>
</body>
</html>