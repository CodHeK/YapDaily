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
    	$_SESSION['editid'] = $idpass;
    	//echo $_SESSION['deleteid'];
    
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

    	}
    	catch(PDOException $e) {
    		  echo '<script language="javascript">';
              echo '$sql . "<br>" . $e->getMessage();';
              echo '</script>';   
              header("Refresh: 1; url=welcome.php");
    	}
      if ($query['user'] != $id) {
            echo '<script language="javascript">';
            echo 'alert("You are not allowed to access this")';
            echo '</script>';   
            header("Refresh: 1; url=profile.php"); 
            exit();
        }

    	$conn = NULL;
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="refresh" content="60" > 
  <link href="https://fonts.googleapis.com/css?family=Changa:200|Source+Sans+Pro:200" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <style type="text/css">
    body {
      font-family: 'Source Sans Pro', sans-serif;
      font-weight: 700;
      background-color: rgb(220, 198, 224);
    }
    .navbar {
      background-color: rgb(103, 65, 114);
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
      <a class="navbar-brand" href="#" style="color: white;margin-left: 7%;font-weight: 700;">PDOphp</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"  style="color: white;font-weight: 700;">LOG OUT</a></li>
        <li><a href="welcome.php"  style="color: white;font-weight: 700;">ALL POSTS</a></li>
        <li><a href="sent.php"  style="color: white;font-weight: 700;">SENT MSG</a></li>
        <li><a href="recv.php"  style="color: white;font-weight: 700;">RECV MSG</a></li>
        <li style="color: black;font-weight: 700;border: 1px solid black;background-color: black;"><a href="profile.php"  style="color: white;font-weight: 700;"><?php echo $name ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
  <h1 style="text-align: center;">Edit your Post</h1>
  <hr>
  <br>
  <form method="POST" action="posteditadd.php">
    <div class="form-group" style="width:60%;margin-left:20%;">
      <input type="text" class="form-control" name="name" value="<?php echo $name ?>"><br>
      <input type="text" class="form-control" name="title" value="<?php echo $query['title'] ?>"><br>
      <input type="text" class="form-control" name="dater" value="<?php echo $query['dater'] ?>"><br>
      <textarea type="text" class="form-control" name="body" rows="8"><?php echo $query['body'] ?></textarea><br>
      <a href="profile.php" class="btn btn-default" style="margin-left:37%;font-weight: 700;">CANCEL</a>
      <input type="submit" class="btn btn-default" name="editpost" value="SAVE CHANGES" style="background-color: rgb(103, 65, 114);color: white;font-weight: 700;">
    </div>
  </form>
</div>
</body>
</html>