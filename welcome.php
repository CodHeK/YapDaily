<?php
	
	session_start();
	if(!isset($_SESSION['user'])) {
		echo '<script language="javascript">';
				echo 'alert("First Login!");';
				echo '</script>';
				header("Location:login.php");
		exit();
	}
	else {
		$id = $_SESSION['id'];
    //echo $id;
		$name = $_SESSION['user'];
	}
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
      background-color: rgb(220, 198, 224);
    }
    .cont {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.4);
      background-color: rgb(238, 238, 238);
      font-weight: 700;
    }
    .navbar {
      background-color: rgb(103, 65, 114)
    }
    hr {
        border: 1px solid black;
    }
    #sub {
      color: white;
      font-weight: 700;
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
        <!-- <li><a href="users.php">ALL AUTHORS</a></li> -->
        <li><a href="addpost.php"  style="color: white;font-weight: 700;">ADD POST</a></li>
        <li><a href="sent.php"  style="color: white;font-weight: 700;">SENT MSG</a></li>
        <li><a href="recv.php"  style="color: white;font-weight: 700;">RECV MSG</a></li>
        <li style="color: white;font-weight: 700;border: 1px solid black;background-color: black;"><a href="profile.php" style="color: white;font-weight: 700;"><?php echo $name ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div id="content" class="container">
    <h1 style="color: rgb(103, 65, 114)">All Posts <b style="font-size:13px;">( Refreshed every minute )</b></h1>
    <hr>
    <form method="POST">
    <table style="width: 100%;">
    <tr>
    <td style="padding-right: 0.5%;">
      <i class="fa fa-search" aria-hidden="true" style="color:black;font-size: 20px;"></i>
    </td>
    <td style="width:80%;">
      <input type="text" name="search" class="form-control" placeholder="Search an author..." >
    </td>
    <td style="
      padding-left: 1%;">
      <input type="submit" name="searchauth" class="btn btn-deafult" value="SEARCH"  style="background-color: rgb(103, 65, 114);color: #fff;font-weight: 700;">
      <input type="submit" name="showall" class="btn btn-deafult" value="ALL POSTS" style="background-color: rgb(103, 65, 114);color: #fff;font-weight: 700;">
    </td>
    </tr>
    </table>
    </form>
    <br>
    <?php 

      if(isset($_POST['searchauth'])) {
        $authorname = htmlentities($_POST['search']);
        
        if(empty($_POST['search'])) {
          echo '<script language="javascript">';
              echo 'alert("Enter Name please !");';
              echo '</script>';   
              header("Refresh: 1; url=welcome.php");
        }
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pdologin";
        $tbname = "posts";
        $tbname1 = "comments";

        try {

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM $tbname WHERE name = '$authorname' ORDER BY id DESC");

            $stmt1 = $conn->prepare("SELECT * FROM $tbname1");

            $stmt->execute(['name' => $authorname]);

            $stmt1->execute();

            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //echo $results['name'];

            $results1 = $stmt1->fetchAll();

            if($results != NULL) {
                  
                foreach($results as $rows) {
                  echo '<br>';
                  echo '<div class="container">';
                  echo '<div class="cont" style="border:1px solid black;border-radius:10px;">';
                  echo '<h3 style="font-family: Source Sans Pro;font-weight: 700;color: black;margin-left:2%;font-size:30px;">', $rows['title'], '</h3>';
                  echo '<hr style="margin-left:2%;width:93%;border:0.5px solid black;">';
                  echo '<h4 style = "font-family: Source Sans Pro;color: black;margin-left:2%;">By,  <a style="text-decoration:none;" href="message.php?user=' .$rows['user']. '&sendto=' .$rows['name']. '"><b> &nbsp',$rows['name'],'&nbsp</b></a> on  <b>&nbsp',$rows['dater'], '&nbsp</b></h4>', '<br>';
                  echo '<p class="jumbotron" style="font-family: Source Sans Pro;color:black;width:92%;margin-left:2%;font-size:25px;overflow-x:auto;overflow-y:auto;">',$rows['body'],'</p>';
                  echo '<h4 style="margin-left:2%;"><b>COMMENTS:</b></h4>';
                  echo '<hr style="margin-left:2%;width:92%;">';
                  foreach($results1 as $comm) {
                    if($comm['postid'] == $rows['id']) {
                      $idd = $comm['postid'];
                      $stmt2 = $conn->prepare("SELECT * FROM $tbname1 WHERE postid = '$idd' ORDER BY id DESC");
                      $stmt2->execute();

                      echo '<h4 style="margin-left:2%;"><b>',$comm['name'], ':</b>&nbsp&nbsp' , $comm['comment'], '</h4>';
                  }
                  }
                  echo '<br>';
                  echo '<form method="POST" action="comments.php?id=' .$rows['id']. '&user=' .$name. '">';
                  echo '<table  style="margin-left:2%;width:85%;" id="commenttable">';
                  echo '<tr>';
                  echo '<td>';
                  echo '<input class="form-control" type="text" style="margin-left:2%;" name="comment" placeholder="Write a comment...">';
                  echo '</td>';
                  echo '<td style="padding-left:2%;">';
                  echo '<input type="submit" name="postcomment" value"POST" id="sub" class="btn btn-deafult" style="background-color: rgb(103, 65, 114);color: #fff;font-weight: 700;">';
                  echo '</td>';
                  echo '</tr>';
                  echo '</table>','<br>';
                  echo '</form>';
                  echo '<a id="heart" href="likes.php?id=' .$rows['id']. '&user=' .$rows['user']. '" style="text-decoration:none;font-size:25px;color:black;margin-left:2.5%;"><i class="fa fa-heart" aria-hidden="true"></i></a>&nbsp&nbsp&nbsp&nbsp<b style="font-size:20px;">', $rows['likes'], '</b><br>';
                  echo '</div>';
                  echo '</div>';
                  echo '<br>';
               }
            }
            else {
              echo '<br>';
              echo '<h3 style="font-weight:700;font-family:Source Sans Pro;text-align:center;">We could not find this Author !</h3>';
            }
        }
        catch(PDOException $e){
              echo '<script language="javascript">';
              echo '$sql . "<br>" . $e->getMessage();';
              echo '</script>';   
              header("Refresh: 1; url=login.php");
        }

        $conn = null;
      }
      else {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pdologin";
        $tbname = "posts";
        $tbname1 = "comments";

        try {

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM $tbname ORDER BY id DESC");

            $stmt1 = $conn->prepare("SELECT * FROM $tbname1");

            $stmt->execute();

            $stmt1->execute();

            
            $results = $stmt->fetchAll();

            $results1 = $stmt1->fetchAll();

            if($results != NULL) {
                  
                foreach($results as $rows) {
                  echo '<br>';
                  echo '<div class="container">';
                  echo '<div class="cont" style="border:1px solid black;border-radius:10px;">';
                  echo '<h3 style="font-family: Source Sans Pro;font-weight: 700;color: black;margin-left:2%;font-size:30px;">', $rows['title'], '</h3>';
                  echo '<hr style="margin-left:2%;width:93%;border:0.5px solid black;">';
                  echo '<h4 style = "font-family: Source Sans Pro;color: black;margin-left:2%;">By,  <a style="text-decoration:none;" href="message.php?user=' .$rows['user']. '&sendto=' .$rows['name']. '"><b> &nbsp',$rows['name'],'&nbsp</b></a> on  <b>&nbsp',$rows['dater'], '&nbsp</b></h4>', '<br>';
                  echo '<p class="jumbotron" style="font-family: Source Sans Pro;color:black;width:92%;margin-left:2%;font-size:25px;overflow-x:auto;overflow-y:auto;border:0.5px solid black;">',$rows['body'],'</p>';
                  echo '<h4 style="margin-left:2%;"><b>COMMENTS:</b></h4>';
                  echo '<hr style="margin-left:2%;width:92%;">';
                  foreach($results1 as $comm) {
                    if($comm['postid'] == $rows['id']) {
                      $idd = $comm['postid'];
                      $stmt2 = $conn->prepare("SELECT * FROM $tbname1 WHERE postid = '$idd' ORDER BY id DESC");
                      $stmt2->execute();

                      echo '<h4 style="margin-left:2%;"><b>',$comm['name'], ':</b>&nbsp&nbsp' , $comm['comment'], '</h4>';
                  }
                  }
                  echo '<br>';
                  echo '<form method="POST" action="comments.php?id=' .$rows['id']. '&user=' .$name. '">';
                  echo '<table  style="margin-left:2%;width:85%;" id="commenttable">';
                  echo '<tr>';
                  echo '<td>';
                  echo '<input class="form-control" type="text" style="margin-left:2%;" name="comment" placeholder="Write a comment...">';
                  echo '</td>';
                  echo '<td style="padding-left:2%;">';
                  echo '<input type="submit" name="postcomment" value"POST" class="btn btn-deafult" style="background-color: rgb(103, 65, 114);color: #fff;font-weight: 700;">';
                  echo '</td>';
                  echo '</tr>';
                  echo '</table>','<br>';
                  echo '</form>';
                  echo '<a id="heart" href="likes.php?id=' .$rows['id']. '&user=' .$rows['user']. '" style="text-decoration:none;font-size:25px;color:black;margin-left:2.5%;"><i class="fa fa-heart" aria-hidden="true"></i></a>&nbsp&nbsp&nbsp&nbsp<b style="font-size:20px;">', $rows['likes'], '</b><br>';
                  echo '</div>';
                  echo '</div>';
                  echo '<br>';
               }
            }
            else {
              echo '<br>';
              echo '<h3 style="font-weight:700;font-family:Source Sans Pro;text-align:center;">No posts yet ! Be the first one to post!</h3>';
            }
        }
        catch(PDOException $e){
              echo '<script language="javascript">';
              echo '$sql . "<br>" . $e->getMessage();';
              echo '</script>';   
              header("Refresh: 1; url=login.php");
        }

        $conn = null;
      }

    ?>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
</body>
</html>