<?php 
	session_start();
	
	$name = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>HomePage</title>
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
        <li><a href="users.php">ALL AUTHORS</a></li>
        <li><a href="welcome.php">ALL POSTS</a></li>
        <li><a href="sent.php">SENT MSG</a></li>
        <li><a href="recv.php">RECV MSG</a></li>
        <li style="color: black;font-weight: 700;border: 1px solid black;"><a href="profile.php"><?php echo $name ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
	<h1 style="text-align: center;">Create a New Post</h1>
	<hr>
	<br>
	<form method="POST" action="postadded.php">
		<div class="form-group" style="width:60%;margin-left:20%;">
			<input type="text" class="form-control" name="name" value="<?php echo $name ?>"><br>
			<input type="text" class="form-control" name="title" placeholder="Enter Title"><br>
			<input type="text" class="form-control" name="dater" placeholder="Example: 24 May, 2017"><br>
			<textarea type="text" class="form-control" name="body" placeholder="Enter Body of your Post" rows="8"></textarea><br>
			<input type="submit" class="btn btn-default" name="savepost" style="margin-left: 43%;" value="ADD POST">
		</div>
	</form>
</div>
</body>
</html>