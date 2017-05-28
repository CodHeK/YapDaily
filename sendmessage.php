<?php  
	session_start();
	$name = $_SESSION['user'];
	$sendname = $_SESSION['tomsg'];

	// echo $name;
	// echo $sendname;

	if(isset($_POST['send'])) {
			define('MyConst', TRUE);
		}

		if(!defined('MyConst')) {
			echo '<script language="javascript">';
			echo 'alert("Access Denied");';
			echo '</script>';
			header("Refresh: 1; url=welcome.php");
		}

	else {
			if(!empty($_POST['tomsg']) && !empty($_POST['msgbody'])) {
					$tomsg = htmlentities($_POST['tomsg']);
					$msgbody = htmlentities($_POST['msgbody']);
			}
			else {
				echo '<script language="javascript">';
				echo 'alert("Enter All the Details first !");';
				echo '</script>';
				header("Location:message.php");
			}

			$servername = "localhost";
        	$username = "root";
        	$password = "";
        	$dbname = "pdologin";
        	$tbname = "messages";


        	try {
        		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql = $conn->prepare("INSERT INTO $tbname (tomsg,frommsg,msgbody) VALUES (:tomsg,:frommsg,:msgbody)");

				$do = $sql->execute(['tomsg' => $sendname, 'frommsg' => $name, 'msgbody' => $msgbody]);

				if($do) {
					echo '<script language="javascript">';
					echo 'alert("Message Sent Successfully !");';
					echo '</script>';
					header("Location:sent.php");
				}
				else {
					echo '<script language="javascript">';
					echo 'alert("Looks like there is some Error !");';
					echo '</script>';
					header("Refresh: 1; url=welcome.php");
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