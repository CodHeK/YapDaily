<?php 
	session_start();

	$user_id = $_GET['user'];
	$idpass = $_GET['id'];
	$id = $_SESSION['id'];

	//echo $id;

	if(!isset($_SESSION['user'])){  
        echo '<script language="javascript">';
        echo 'alert("What? Dude login first :P")';
        echo '</script>';   
        header("Refresh: 1; url=login.php"); 
        exit();
    }
    else {
        $name = $_SESSION['user'];
        //$_SESSION['liker'] = $idpass;

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pdologin";
        $tbname = "posts";


        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM $tbname WHERE id = :id");

            $stmt->execute(['id' => $idpass]);

            $query = $stmt->fetch(PDO::FETCH_ASSOC);

            echo $query['title'];

            $query['likes'] = $query['likes'] + 1;

            $newlikes = $query['likes'];

            $stmt1 = $conn->prepare("UPDATE $tbname SET likes = :likes WHERE id = :id");

            $stmt1->execute(['likes' => $newlikes, 'id' => $idpass]);

            header("Location:welcome.php");
            
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
