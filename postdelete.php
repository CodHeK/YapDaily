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
    elseif ($user_id != $id) {
        echo '<script language="javascript">';
        echo 'alert("You are not allowed to access this")';
        echo '</script>';   
        header("Refresh: 1; url=profile.php"); 
        exit();
    }
    else {
    	$name = $_SESSION['user'];
    	$_SESSION['deleteid'] = $idpass;
    	//echo $_SESSION['deleteid'];
    }

    // 	$servername = "localhost";
    // 	$username = "root";
    // 	$password = "";
    // 	$dbname = "pdologin";
    // 	$tbname = "posts";


    // 	try {
    // 		$conn = new PDO("mysql:host=$servername,dbname=$dbname", $username, $password);

    // 		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 		$stmt = $conn->prepare("SELECT * FROM $tbname WHERE id = :id");

    // 		$stmt->execute(['id' => $idpass]);

    // 		$query = $stmt->fetch(PDO::FETCH_ASSOC);

    // 	}
    // 	catch(PDOException $e) {
    // 		  echo '<script language="javascript">';
    //           echo '$sql . "<br>" . $e->getMessage();';
    //           echo '</script>';   
    //           header("Refresh: 1; url=welcome.php");
    // 	}

    // 	$conn = NULL;
    // }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="refresh" content="60" > 
  <link href="https://fonts.googleapis.com/css?family=Changa:200|Source+Sans+Pro:200" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <style type="text/css">
    body {
      font-family: 'Source Sans Pro', sans-serif;
      font-weight: 700;
    }
    .cont {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
  </style>
</head>
<body>
		<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">PDOphp</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">LOG OUT</a></li>
        <li><a href="addpost.php">ADD POST</a></li>
        <li style="color: black;font-weight: 700;border: 1px solid black;"><a href="profile.php"><?php echo $name ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<form method="POST" action="confirmdelpost.php">
<div id="overlay" style="margin: 0 auto;text-align: center;padding-top: 5%;">
	<h2>Confirm delete ?</h2><br>
	<a href="profile.php" class="btn btn-default" role="button">NO</a>&nbsp&nbsp
    <button type="submit" class="btn btn-primary" name="yes">YES</button>
</div>
</form>
</body>
</html>