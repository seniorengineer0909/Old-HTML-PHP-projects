<?php
	session_start();
	if(!isset($_SESSION['is_login'])) {
		header("location: index.php");
	} 
?>
<!doctype html>
<html lang = "en-US">
<head>
	<title>WHAT BEER ARE YOU DRINKING?</title>
	<meta charset = "utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  	<script language = "javascript" type = "text/javascript" src = "beerlogscript.js"></script>

  	<link rel = "stylesheet" type = "text/css" href = "beerlogstyle.css">

	
</head>
<?php
	include 'connection.php';
?>
<body>
<div id = "main" class = "container">
	<header>
  		<h1 id = "Firstpagebutton">
  			<strong>The BeerLog.</strong><button id = "titlebutton" type = "button" class = "btn btn-danger btn-xs" 
  			data-toggle = "modal" data-target = "#Sinfo"><span data-toggle = "tooltip" data-placement = "bottom" 
						title = "Page Info">beta</span></button>
  		</h1>
	</header>
<!--Modal-->
	<div class = "modal fade" id = "Sinfo" role = "dialog">
		<div class = "modal-dialog">
			<div class = "modal-content">
				<div class = "modal-header">
					<button type = "button" class = "close" data-dismiss = "modal">&times;</button>
					<h4 id = "modaltext" class = "modal-title"><strong>Page info</strong></h4>
				</div>
				<div class = "modal-body">
					<p class="bg-primary" id = "modaltext">Version: 2.1</p>
					<p class="bg-success" id = "modaltext">Publish date: Sep 9, 2015<p>
					<p class="bg-info" id = "modaltext">Publisher: Sean Choi</p>
					<p class="bg-warning" id = "modaltext"><a href = "mailto: ss.choi@mail.utoronto.ca">E-mail</a></p>
					<p id = "modaltext" class = "footercopyright bg-danger"></p>
				</div>
			</div>
		</div>
	</div>
	<nav class = "navbar navbar-default">
		<div class = "container-fluid">
			<div class = "navbar-header">
				<button type = "button" class = "navbar-toggle" data-toggle = "collapse" data-target = "#myNavbar">
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
				</button>
				<a class = "navbar-brand" href = "home.php" data-toggle = "tooltip" data-placement = "auto" 
						title = "Home">
					<img id = "homeicon" src = "images/icon/beerbottle.png" alt = "homticon">
				</a>
				<a class = "navbar-brand" href = "post.php">
					Post
				</a>
			</div>

			<div class = "collapse navbar-collapse" id = "myNavbar">
				<ul class = "nav navbar-nav">
					<li><a href = "commentlist.php">Comment List</a></li>
					<li class = "dropdown">
						<a class = "dropdown-toggle" data-toggle = "dropdown" href = "#">
							Comment Search<span class = "caret"></span>
						</a>
							<ul class = "dropdown-menu">
								<li><a href = "SBB.php">By Beer Name</a></li>
								<li><a href = "SBU.php">By User Name</a></li>
								<li><a href = "SBP.php">By Pub Name</a></li>
								<li><a href = "SBD.php">By Date</a></li>
							</ul>
					</li>
					<li><a href = "beerinfo.php">Beer Info</a></li>
				</ul>

				<ul class = "nav navbar-nav navbar-right">
					<li><a href = "logoutprocess.php">Log out</a></li>
				</ul>
			</div>
		</div>
	</nav>
		<div class = "container-fluid" id = "postprocesssection" style = "min-height: 600px;">

			<?php
				session_start();

				include 'connection.php';

				$post_user = $_SESSION['nickname'];

				if($_POST['CityList'] === 'Not on the list? Please type') {
					$post_city = $_POST['CityNotOnList'];
					} else {
						$post_city = $_POST['CityList'];
					}
				if($_POST['PubList'] === 'Not on the list? Please type') {
					$post_pub = $_POST['PubNotOnList'];
					} else {
						$post_pub = $_POST['PubList'];
					}

				$post_vd = $_POST['vdate'];

				if($_POST['BeerList'] === 'Not on the list? Please type') {
					$post_beer = $_POST['BeerNotOnList'];
					} else {
						$post_beer = $_POST['BeerList'];
					}

				$post_comment = $_POST['Comments'];

				$post_city = mysql_real_escape_string($post_city);
				$post_pub = mysql_real_escape_string($post_pub);
				$post_vd = mysql_real_escape_string($post_vd);
				$post_beer = mysql_real_escape_string($post_beer);
				$post_comment = mysql_real_escape_string($post_comment);

				if(!isset($_POST['BeerList'])) {
					header("location: home.php");
				} else {

					$postprocessing = "INSERT INTO records  
					VALUES (null, '$post_user', '$post_city','$post_pub','$post_vd','$post_beer','$post_comment', now());";

					mysql_query($postprocessing);
					

					echo "<br>";
					echo "<h3 style = 'text-align: center'>Thank you "."<strong>".$post_user."!</strong>"."</h3>";
					echo "<h4 style = 'text-align: center'>Your post is successfully posted</h4>";

					$TotalCommentCountList = "SELECT COUNT(UserName) from records";
				 	$TotalCommentCountResult = mysql_query($TotalCommentCountList);
				 	$TotalCommentCount = mysql_result($TotalCommentCountResult, 0);

					echo "<h4 style = 'text-align: center'><span class = 'bg-warning'>
					Total post at the BeerLog.beta</span> <span class = 'badge'>".
					$TotalCommentCount."</span></h4><br>";

					mysql_close($con);

				}
			?>
			<br><br>
			<div class = "container-fluid">
				<div class = "col-sm-6">
					<button type = "button" class = "btn btn-success btn-block btn-lg" 
					onclick = "window.location.href = 'post.php'">
						Post one more!
					</button>		
				<br>
				</div>
				
				<div class = "col-sm-6">
					<button type = "button" class = "btn btn-warning btn-block btn-lg"
					onclick = "window.location.href = 'home.php'">
						Back to Home
					</button>	
				</div>
				<div class = "col-sm-12">
					 <div class="alert alert-danger fade in">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Note: </strong> Duplicated comments are automatically rejected by the database.
				  	</div>
				</div>

				</div>
			</div>
	</div>
	</div>
</body>
</html>
