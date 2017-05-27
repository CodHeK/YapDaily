<?php 

	session_start();
	$idpass = $_SESSION['editid'];
	//echo $idpass;
	if(isset($_POST['editpost'])){
        define('MyConst', TRUE);
    }

    if(!defined('MyConst')){
        echo '<script language="javascript">';
        echo 'alert("Access Denied")';
        echo '</script>';   
        header("Refresh: 1; url=profile.php");
        exit();
    }

    if(isset($_POST['editpost'])) {

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
            header("Refresh: 1;postedit.php");
        }

    	try {
    		

    		$servername = "localhost";
    		$username = "root";
    		$password = "";
    		$dbname = "pdologin";
    		$tbname = "posts";

    		

    		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    		

    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		

    		$stmt = $conn->prepare("UPDATE $tbname SET name = :name, title = :title, dater = :dater, body = :body WHERE id = :id");
    		

    		$do = $stmt->execute(['name' => $name, 'title' => $title, 'dater' => $dater, 'body' => $body, 'id' => $idpass]);

    		

    		if($do) {
    			echo '<script language="javascript">';
                echo 'alert("Changes to your post have been made !");';
                echo '</script>';   
               	header("Refresh: 1; url=profile.php");
    		}
    		else {
    			echo '<script language="javascript">';
                    echo 'alert("Oops! Looks like there is some error. Try Again!");';
                    echo '</script>';   
                    header("Refresh: 1; url=profile.php");
    		}
    	}
    	catch(PDOException $e){
                echo '<script language="javascript">';
                echo '$sql . . $e->getMessage();';
                echo '</script>';   
                header("Refresh: 1; url=profile.php");
        }

        $conn = NULL;
    }
?>