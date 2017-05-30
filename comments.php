<?php 
	session_start();
	$post = $_GET['id'];
	$nameuser = $_GET['user'];
	$name = $_SESSION['user'];
	if(isset($_POST['postcomment'])) {
			define('MyConst', TRUE);
		}

		if(!defined('MyConst')) {
			echo '<script language="javascript">';
			echo 'alert("Access Denied");';
			echo '</script>';
			header("Refresh: 1; url=welcome.php");
		}
	else {
		if(!empty($_POST['comment'])) {
			$comment = htmlentities($_POST['comment']);
			//echo $comment;
		}


		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pdologin";
		$tbname = "comments";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare("INSERT INTO $tbname (postid,name,comment) VALUES (:postid,:name,:comment)");

			$do = $stmt->execute(['postid' => $post, 'name' => $nameuser, 'comment' => $comment]);


				if($do) {
					header("Location:welcome.php");
				}
				else {
					echo '<script language="javascript">';
					echo 'alert("Looks like there is some Error !");';
					echo '</script>';
					header("Refresh: 1; url=index.php");
				}

		}
		catch(PDOException $e) {
			echo '<script language="javascript">';
			echo '$sql . "<br>" . $e->getMessage();';
			echo '</script>';
			header("Refresh: 1; url=welcome.php");
		}
		$conn = NULL;
	}

?>