<?php
	include 'validateuser.php';

	//$username = "";
	$errors = array();
	
	//connect to the database
	$db = mysqli_connect('localhost', 'root', 'password', 'mydatabase') or die ('Error: Unable to connect');
	
	if (isset($_POST['register'])) {
		$username = mysqli_escape_string($db, $_POST['username']);
		$email = mysqli_escape_string($db, $_POST['emails']);
		$psw_1 = mysqli_escape_string($db, $_POST['psw_1']);
		$psw_2 = mysqli_escape_string($db, $_POST['psw_2']);
		
		validatePattern($errors, $_POST, 'username', '/^\w+$/');
		validatePattern($errors, $_POST, 'psw_1', '/^\w{8,}$/');
		//validatePattern($errors, $_POST, 'psw_2', '/^\w{8,}$/');
		validatePattern($errors, $_POST, 'emails', '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/');
		if ($psw_1 != $psw_2)
			$errors[$psw_2] = 'PSWdoesnt match';
		if (count($errors) == 0) {
			$duplicate_check = "SELECT email FROM regist WHERE email='$email' OR username='$email'";
			$result = mysqli_query($db, $duplicate_check);
			$countt = mysqli_num_rows($result);
			if ($countt > 0) {
				echo '<script language="javascript">';
				echo 'alert("your email already registered or name has been used.")';
				echo '</script>';
				echo "please return the orginal page";
			}
			else {
				$psw = md5($psw_1);
				$sql = "INSERT INTO regist (username, email, password) VALUES ('$username', '$email', '$psw')";
				mysqli_query($db, $sql);
				header("Location: https://{$_SERVER['HTTP_HOST']}/project3/sign.php");
			}
		}
		else {
			foreach ($errors as $temp => $tmp) {
				echo $temp;
				echo " : ";
				echo $tmp;
				echo "<br>";
			}
			echo "Please return the original page";
		}
	}
	else {
		echo "submission failed. please return original page";
	}
	
?>