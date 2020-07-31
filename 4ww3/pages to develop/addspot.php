<?php 
	require './vendor/autoload.php';
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;
	
    session_start();
	
	$errors = array();
	$db = mysqli_connect('localhost', 'root', 'password', 'mydatabase') or die ('Error: Unable to connect');
	
	if (isset($_POST['travel']) && isset($_POST['geola']) && isset($_POST['geolo']) && isset($_POST['discribe']) && isset($_POST['type'])) {
		$na = mysqli_escape_string($db, $_POST['travel']);
		$la = mysqli_escape_string($db, $_POST['geola']);
		$lo = mysqli_escape_string($db, $_POST['geolo']);
		$disc = mysqli_escape_string($db, $_POST['discribe']);
		$tp = mysqli_escape_string($db, $_POST['type']);
		
		if (!preg_match('/^\w+[\s\w]*$/', $na)) {
			array_push($errors,'name invalid');
		}
		if (!preg_match('/^\w+[\s\w!?,.-]*$/', $disc)) {
			array_push($errors,'invalid input in discription');
		}
		
		if (count($errors)==0){
			if (isset($_POST['fileToUpload']) && $_POST['fileToUpload'] != '') {
				
				// AWS Info
				$bucketName = 'my-bucket';
				$IAM_KEY = 'AKIA243J3XYQIAXXXXXX';
				$IAM_SECRET = 'udcLCeWqvBAkaqOVvpyy4FEWD2hhP56TB7XXXXXX';

				// Connect to AWS
				try {
					// You may need to change the region. It will say in the URL when the bucket is open
					// and on creation.
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
					// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
					// return a json object.
					die("Error: " . $e->getMessage());
				}
	
				// For this, I would generate a unqiue random string for the key name. But you can do whatever.
				$keyName = 'test_example/' . basename($_FILES["fileToUpload"]['name']);
				$pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
				// Add it to S3
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
				$sql = "INSERT INTO spot (spot_name, latitude, longitude, rate, discribe, s3FilePath, trafoo) VALUES ('$na', '$la', '$lo', 0, '$disc', '$keyName', '$tp')";
				mysqli_query($db, $sql);
				header("Location: https://{$_SERVER['HTTP_HOST']}/project3/homepage.php");
			} else {
				$sql = "INSERT INTO spot (spot_name, latitude, longitude, rate, discribe, trafoo) VALUES ('$na', '$la', '$lo', 0, '$disc', '$tp')";
				mysqli_query($db, $sql);
				header("Location: https://{$_SERVER['HTTP_HOST']}/project3/homepage.php");
			}
		} else {
			foreach ($errors as $err) {
				echo $err;
				echo "<br>";
			}
			echo "<a href='objectsubmission.php'>Back</a>";
		}
	}
	else {
		header("Location: https://{$_SERVER['HTTP_HOST']}/project3/objectsubmission.php");
	}
?>