<?php 

	session_start();
	$idpass = $_SESSION['deleteid'];
	//echo $idpass;
	if(isset($_POST['yes'])){
        define('MyConst', TRUE);
    }

    if(!defined('MyConst')){
        echo '<script language="javascript">';
        echo 'alert("Access Denied")';
        echo '</script>';   
        header("Refresh: 1; url=profile.php");
        exit();
    }

    if(isset($_POST['yes'])) {


    	try {
    		

    		$servername = "localhost";
    		$username = "root";
    		$password = "";
    		$dbname = "pdologin";
    		$tbname = "posts";

    		

    		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    		

    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		

    		$stmt = $conn->prepare("DELETE FROM $tbname WHERE id = :id");
    		

    		$do = $stmt->execute(['id' => $idpass]);

    		

    		if($do) {
    			echo '<script language="javascript">';
                echo 'alert("Deleted Successfully. Click OK");';
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