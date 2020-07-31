<?php
	session_start();

	$errors = array();
	
    $pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'root', 'password');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['emails']) && isset($_POST['psw_1'])){
		if (!preg_match('/^\w{8,}$/', $_POST['psw_1']))
			$errors['psw_1'] = 'Invalid';
		if (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $_POST['emails']))
			$errors['emails'] = 'Invalid';
		
		if (count($errors) == 0) {
			$sql = "Select * from regist where email=? and password=?";
			$stmnt = $pdo->prepare($sql);
			$stmnt->bindValue(1, $_POST['emails']);
			$stmnt->bindValue(2, md5($_POST['psw_1']));
			try {
				$stmnt->execute();
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			$rows = $stmnt->fetchAll();
			if (count($rows) == 1){
            // Setting the session to the returned user ID.
				$_SESSION['id'] = $rows[0]['id'];
				$_SESSION['username'] = $rows[0]['username'];
				
				header("Location: https://{$_SERVER['HTTP_HOST']}/project3/signout.php");
			} else {
				header("Location: https://{$_SERVER['HTTP_HOST']}/project3/sign.php");
			}
		} else {
			foreach ($errors as $temp => $tmp) {
				echo $temp;
				echo " : ";
				echo $tmp;
				echo "<br>";
			}
			echo "Please return the original page";
		}

    } else {
        header("Location: https://{$_SERVER['HTTP_HOST']}/project3/sign.php");
    }
?>