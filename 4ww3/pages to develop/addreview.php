<?php 
	require './vendor/autoload.php';
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;
    session_start();
	
	if (isset($_SESSION['username']) && isset($_SESSION['spotname'])) {
		$users = $_SESSION['username'];
		$hding = $_SESSION['spotname'];
	} else {
		header("Location: https://{$_SERVER['HTTP_HOST']}/project3/sign.php");
	}
	
	$errors = array();
	/////////////
	$pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'root', 'password');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (isset($_POST['rate']) && isset($_POST['discribe'])) {
		$rt=intval($_POST['rate']);
		$disc =  $_POST['discribe'];
	}
	if (!preg_match('/^\w+[\s\w!?,.-]*$/', $disc)) {
			array_push($errors,'invalid input in discription');
	}
	if (count($errors)==0){
		if (isset($_POST['fileToUpload']) && $_POST['fileToUpload'] != '') {
			
			$bucketName = 'my-bucket';
			$IAM_KEY = 'AKIA243J3XYQIAXXXXXX';
			$IAM_SECRET = 'udcLCeWqvBAkaqOVvpyy4FEWD2hhP56TB7XXXXXX';
			
			try {
				$s3 = S3Client::factory(
					array(
						'credentials' => array(
							'key' => $IAM_KEY,
							'secret' => $IAM_SECRET
						),
						'version' => 'latest',
						'region'  => 'us-east-2'
					)
				);
			} catch (Exception $e) {
				die("Error: " . $e->getMessage());
			}
			
			$keyName = 'review_example/' . basename($_FILES["fileToUpload"]['name']);
			$pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
			
			try {
					// Uploaded:
				$file = $_FILES["fileToUpload"]['name'];
				$s3->putObject(
					array(
						'Bucket'=>$bucketName,
						'Key' =>  $keyName,
						'SourceFile' => $file,
						'StorageClass' => 'REDUCED_REDUNDANCY'
					)
				);
			} catch (S3Exception $e) {
				die('Error:' . $e->getMessage());
			} catch (Exception $e) {
				die('Error:' . $e->getMessage());
			}
			
			$sql = "INSERT INTO review (username, rate, reviewpoint, picture, objectname) VALUES (?, ?, ?, ?, ?)";
			$stmnt = $pdo->prepare($sql);
			$stmnt->bindValue(1, $users);
			$stmnt->bindValue(2, $rt);
			$stmnt->bindValue(3, $disc);
			$stmnt->bindValue(4, $keyName);
			$stmnt->bindValue(5, $hding);
			try {
				$stmnt->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			$sqll = "SELECT AVG(rate) FROM review WHERE objectname = ?";
			$stmntt = $pdo->prepare($sqll);
			$stmntt->bindValue(1, $hding);
			try {
				$stmntt->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			$row = $stmntt->fetchColumn();
			$sqlll = "UPDATE spot SET rate = ? WHERE spot_name = ?";
			$stmnttt = $pdo->prepare($sqlll);
			$stmnttt->bindValue(1, $row);
			$stmnttt->bindValue(2, $hding);
			try {
				$stmnttt->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			header("Location: https://{$_SERVER['HTTP_HOST']}/project3/homepage.php");
		} else {
			$sql = "INSERT INTO review (username, rate, reviewpoint, objectname) VALUES (?, ?, ?, ?)";
			$stmnt = $pdo->prepare($sql);
			$stmnt->bindValue(1, $users);
			$stmnt->bindValue(2, $rt);
			$stmnt->bindValue(3, $disc);
			$stmnt->bindValue(4, $hding);
			try {
				$stmnt->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			$sqll = "SELECT AVG(rate) FROM review WHERE objectname = ?";
			$stmntt = $pdo->prepare($sqll);
			$stmntt->bindValue(1, $hding);
			try {
				$stmntt->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			$row = $stmntt->fetchColumn();
			$sqlll = "UPDATE spot SET rate = ? WHERE spot_name = ?";
			$stmnttt = $pdo->prepare($sqlll);
			$stmnttt->bindValue(1, $row);
			$stmnttt->bindValue(2, $hding);
			try {
				$stmnttt->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			header("Location: https://{$_SERVER['HTTP_HOST']}/project3/homepage.php");
		}
	} else {
		foreach ($errors as $err) {
			echo $err;
			echo "<br>";
		}
		echo "<a href='reviewsubmission.php'>Back</a>";
	}
	////////////
?>