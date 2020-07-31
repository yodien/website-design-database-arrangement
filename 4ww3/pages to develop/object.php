<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
<title>Object</title>
<link rel="shortcut icon" href="pic/favicon.ico">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
<style>

/*
***
*	header and navigation bar is always on the top and footer is always at bottom
*	some review may have picture and some may not
***
*/

table {
  border-collapse: collapse;
  width: 100%;
}
table, th, td {
  border: 1px solid white;
  color: white;
}

.whitenote {
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
  height:300px;
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

<!--theme of the webpage and this is a sample object, real one need serverside, contain a link back to sample result page-->
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

<!--image, location, description of the object and others review-->
<?php
	if (!isset($_POST['objectid'])) {
		echo "<h2 class='whitenote'>whoop... sth wrong happens</h2>";
	} else {
		$idnum = $_POST['objectid'];
		$pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'root', 'password');
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM spot WHERE id = ?";
		$stmnt = $pdo->prepare($sql);
		$stmnt->bindValue(1, $idnum, PDO::PARAM_INT);
		try {
				$stmnt->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
		}
		$rows = $stmnt->fetchAll();
		$pic ="https://MYS3BUCKETWEBSITE".$rows[0]['s3FilePath'];
		$hding = $rows[0]['spot_name'];
		$la = $rows[0]['latitude'];
		$lo = $rows[0]['longitude'];
		$disc = $rows[0]['discribe'];
		echo "<div>";
		if (empty($rows[0]['s3FilePath']) || $rows[0]['s3FilePath'] == '') {
			echo "<h3 class='whitenote'>No image here</h3>";
		} else {
			echo "<img src=".$pic." alt=".$hding." style='width:100%'>";
		}
		echo "</div>";
		echo "<div class='whitenote'>";
		echo "<h2>".$hding."</h2>";
		echo "<p><b>Latitude</b>:  ".$la."</p>";
		echo "<p><b>Longitude</b>:  ".$lo."</p>";
		echo "<p><b>Detail</b>:  ".$disc."</p>";
		
	}
?>
<div id="Map"></div>
<script>
	var lat  = "<?php echo $la ?>";
	var lon  = "<?php echo $lo ?>";
	var nm = "<?php echo $hding ?>";
	var mymap = L.map('Map').setView([lat, lon], 13);
	
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(mymap);
	
	L.marker([lat, lon]).addTo(mymap).bindPopup(nm).openPopup();;
	var popup = L.popup();
	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent(e.latlng.toString())
			.openOn(mymap);
	}

	mymap.on('click', onMapClick);
</script>

<br>
<h3>Reviews</h3>
</div>

<?php
$statm = "SELECT * FROM review WHERE objectname = '$hding'";
$myline = $pdo->prepare($statm);
	try {
				$myline->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
		}
$myrows = $myline->fetchAll();
if (count($myrows) > 0) {
	echo '<table>
	<tr>
		<th>Username</th>
		<th>Rating (out of 5)</th>
		<th>review</th>
		<th>image attached</th>
	</tr>';

	foreach ($myrows as $que) {
		echo "<tr>
		<td>".$que['username']."</td>";
		echo "<td>".$que['rate']."</td>";
		if (isset($que['reviewpoint']) && $que['reviewpoint']!='') {
			echo "<td>".$que['reviewpoint']."</td>";
		} else {
			echo "<td></td>";
		}
		echo "";
		
	}
	echo "</table>";
} else {
	echo "<h3 class='whitenote'>There is no review for now</h3>";
}
	if (isset($_SESSION['id'])) {
		$_SESSION['spotname']=$hding;
		echo "<a href='reviewsubmission.php'>post review</a>";
	}
?>



<!--Emailing address and name and student number-->
<div class="footer">
  <p>Made by: Shuo Zhang;  Student #: 400065241</p>
  <p>Contact information: <a href="mailto:zhans18@mcmaster.ca">zhans18@mcmaster.ca</a>.</p>
</div>
</body>
</html>