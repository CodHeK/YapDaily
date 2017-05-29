<?php
	session_start();

	//$user_id = $_GET['user'];
	$sendname = $_GET['sendto'];
	$id = $_SESSION['id'];

	if(!isset($_SESSION['user'])){  
        echo '<script language="javascript">';
        echo 'alert("What? Dude login first :P")';
        echo '</script>';   
        header("Refresh: 1; url=login.php"); 
        exit();
    }
    else {
        $name = $_SESSION['user'];
        $_SESSION['tomsgs'] = $sendname;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Message</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css?family=Changa:200|Source+Sans+Pro:200" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <style type="text/css">
    body {
      font-family: 'Source Sans Pro', sans-serif;
      font-weight: 700;
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
        <li><a href="welcome.php">ALL POSTS</a></li>
        <li style="color: black;font-weight: 700;border: 1px solid black;"><a href="profile.php"><?php echo $name ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id="content" style="margin: 0 auto;text-align: center;">
    <h1>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSend Message</h1>
    <hr>
    <br>
    <form method="POST" action="sendmessage.php">
    <div class="form-group col-md-6" style="margin-left: 27%;">
      <label>To:</label> <input type="text" name="tomsg" value="<?php 
      	if($name == $sendname) {
      		echo 'Self';
      	}
      	else {
      		echo $sendname;
      	}
      	 ?>" class="form-control"><br>
      <label>Message:</label> <textarea type="text" class="form-control" name="msgbody" rows="8" placeholder="Your Message to <?php if($name == $sendname) {
      		echo 'yourself...';
      	}
      	else {
      		echo $sendname, '...';
      	}
      	?>"></textarea><br>
      <a href="welcome.php"  class="btn btn-defaut" style="text-decoration: none;color: black;">CANCEL</a>
      <input type="submit" class="btn btn-defaut" name="send" value="SEND">
    </div>
    </form>
</div>
</body>
</html>