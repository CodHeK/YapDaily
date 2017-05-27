<?php
	
		if(isset($_POST['signup'])) {
			define('MyConst', TRUE);
		}

		if(!defined('MyConst')) {
			echo '<script language="javascript">';
			echo 'alert("Access Denied");';
			echo '</script>';
			header("Refresh: 1; url=index.php");
		}

	else {
			if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
					$name = htmlentities($_POST['name']);
					$email = htmlentities($_POST['email']);
					$pass = md5(htmlentities($_POST['password']));
			}
			else {
				echo '<script language="javascript">';
				echo 'alert("Enter All the Details first !");';
				echo '</script>';
				header("Location:index.php");
			}


		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pdologin";
		$tbname = "userDetails";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare('SELECT * FROM userDetails WHERE email = :email');

			$stmt->execute(['email' => $email]);

			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if($user != NULL) {
				echo '<script language="javascript">';
				echo 'alert("Email Already Registered !");';
				echo '</script>';
				header("Refresh: 1; url=index.php");
			}
			else {
				$sql = $conn->prepare("INSERT INTO $tbname (name,email,password) VALUES (:name,:email,:password)");

				$do = $sql->execute(['name' => $name, 'email' => $email, 'password' => $pass]);

				if($do) {
					echo '<script language="javascript">';
					echo 'alert("Signed up Successfully !");';
					echo '</script>';
					header("Refresh: 1; url=login.php");
				}
				else {
					echo '<script language="javascript">';
					echo 'alert("Looks like there is some Error !");';
					echo '</script>';
					header("Refresh: 1; url=index.php");
				}
			}
		}
		catch(PDOException $e) {
			echo '<script language="javascript">';
			echo '$sql . "<br>" . $e->getMessage();';
			echo '</script>';
			header("Refresh: 1; url=index.php");
		}

		$conn = NULL;
	}

?>