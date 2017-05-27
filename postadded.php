<?php 
	session_start();

	$id = $_SESSION['id'];
	//$name = $_SESSION['user'];

	if(isset($_POST['savepost'])) {
		define('MyConst', TRUE);
	}
	if(!defined('MyConst')) {
		echo '<script language="javascript">';
		echo 'alert("Access Denied");';
		echo '</script>';
		header("Refresh: 1; url=welcome.php");
	}
	else {
		if(!empty($_POST['name']) && !empty($_POST['title']) && !empty($_POST['dater']) && !empty($_POST['body'])) {
			$name = htmlentities($_POST['name']);
			$title = htmlentities($_POST['title']);
			$dater = htmlentities($_POST['dater']);
			$body = htmlentities($_POST['body']);
			
		}
		else {
			echo '<script language="javascript">';
			echo 'alert("Enter All the Details first !");';
			echo '</script>';
			header("Refresh: 1;addpost.php");
		}


		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pdologin";
		$tbname = "posts";


	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("INSERT INTO $tbname (user,name,title,dater,body) VALUES (:user,:name,:title,:dater,:body)");

		$do = $stmt->execute(['user' => $id, 'name' => $name, 'title' => $title, 'dater' => $dater, 'body' => $body]);

			if($do) {
				echo '<script language="javascript">';
				echo 'alert("Post Added Successfully !");';
				echo '</script>';
				header("Refresh: 1; url=welcome.php");
			}
			else {
				echo '<script language="javascript">';
				echo 'alert("Looks like there is some Error !");';
				echo '</script>';
				header("Refresh: 1; url=addpost.php");
			}
		}
	catch(PDOException $e) {
		echo '<script language="javascript">';
		echo '$sql . "<br>" . $e->getMessage();';
		echo '</script>';
		header("Refresh: 1; url=addpost.php");
	}

		$conn = NULL;
	}


?>