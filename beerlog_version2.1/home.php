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
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  	<script language = "javascript" type = "text/javascript" src = "beerlogscript.js"></script>

  	<link rel = "stylesheet" type = "text/css" href = "beerlogstyle.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	
</head>

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
	
	<div class = "container-fluid" id = "homesection">
		<h2 style = "text-align: center">Welcome to The BeerLog.<small><code>beta</code></small></h2> 
		<p style = "text-align: center">Post and get the beer comments from your friends</p>
		<p style = "text-align: center">Data appears in the best way on <kbd>landscape</kbd> mode!</p>
		<br><br>
		<div class = "container-fluid">
		
		<div class = "col-sm-6">
<!--Log in information-->		
		<?php
		include 'connection.php';
		?>
		<?php
//connection completed
		$login_username = $_SESSION['nickname'];
		
		$NameList = "SELECT Name FROM user WHERE UserName = '$login_username'"; 
	 	$NameResult = mysql_query($NameList);
	 	$Name = mysql_result($NameResult, 0);

	 	$LoginCountList = "SELECT COUNT(UserName) from loginlog where UserName = '$login_username'";
	 	$LoginCountResult = mysql_query($LoginCountList);
	 	$LoginCount = mysql_result($LoginCountResult, 0);

	 	$CommentCountList = "SELECT COUNT(UserName) from records where UserName = '$login_username'";
	 	$CommentCountResult = mysql_query($CommentCountList);
	 	$CommentCount = mysql_result($CommentCountResult, 0);

	 	$PubCountList = "SELECT COUNT(DISTINCT PubName) from records where UserName = '$login_username'";
	 	$PubCountResult = mysql_query($PubCountList);
	 	$PubCount = mysql_result($PubCountResult, 0);

	 	$BeerCountList = "SELECT COUNT(DISTINCT Beer) from records where UserName = '$login_username'";
	 	$BeerCountResult = mysql_query($BeerCountList);
	 	$BeerCount = mysql_result($BeerCountResult, 0);

	 	$TotalCommentCountList = "SELECT COUNT(UserName) from records";
	 	$TotalCommentCountResult = mysql_query($TotalCommentCountList);
	 	$TotalCommentCount = mysql_result($TotalCommentCountResult, 0);
	 	
		echo "Hello "."<strong class = 'text-uppercase'><mark>".$login_username."</mark></strong>"." (<em>".$Name."</em>)"."!<br>";
		echo "<br>";

		echo "<div class = 'well' style = 'text-align: center'>";
		date_default_timezone_set("America/New_York");
		echo "<p>Current time</p>";
		echo date("Y/m/d l");
		echo "<p id = 'dt'></p>";
		echo "<p style = 'text-align: center'><span class = 'text-danger'>
			Total post at the BeerLog.beta</span> <span class = 'label label-success'>".$TotalCommentCount.
			"</span></p>";
		echo "</div>";
		
		echo "<h4><em>Your statistics</em></h4>";
		echo "Log in <span class = 'badge'>".$LoginCount."</span><br>";
		echo "Posts <span class = 'badge'>".$CommentCount."</span><br>";
		echo "Pub selection <span class = 'badge'>".$PubCount."</span><br>";
		echo "Beer selection <span class = 'badge'>".$BeerCount."</span>";

		

		?>
		<p></p><br>
		</div>

		
<!--Quote section-->
		<div class = "col-sm-6">
			<div style = "text-align: center"><strong>The latest beer comments</strong></div><br>
			<?php
				$LatestList1 = "SELECT * FROM records order by VisitingDate DESC, PostedTime DESC LIMIT 1";
				$Latestresult1 = mysql_query($LatestList1);
				$Latest1 = mysql_fetch_assoc($Latestresult1);

				$LatestList2 = "SELECT * FROM records order by VisitingDate DESC, PostedTime DESC LIMIT 1, 1";
				$Latestresult2 = mysql_query($LatestList2);
				$Latest2 = mysql_fetch_assoc($Latestresult2);

				$LatestList3 = "SELECT * FROM records order by VisitingDate DESC, PostedTime DESC LIMIT 2, 1";
				$Latestresult3 = mysql_query($LatestList3);
				$Latest3 = mysql_fetch_assoc($Latestresult3);
			?>
		<blockquote>
			<p id = "quote">
				<?php 
				echo $Latest1['Comments'];
				?>
			</p>
			<footer><?php echo $Latest1['UserName']." on ".$Latest1['VisitingDate'];?></footer>
		</blockquote>
		<blockquote class = "blockquote-reverse">
			<p id = "quote">
				<?php 
				echo $Latest2['Comments'];
				?>
			</p>
			<footer><?php echo $Latest2['UserName']." on ".$Latest2['VisitingDate'];?></footer>
		</blockquote>
		<blockquote>
			<p id = "quote">
				<?php 
				echo $Latest3['Comments'];
				?>
			</p>
			<footer><?php echo $Latest3['UserName']." on ".$Latest3['VisitingDate'];?></footer>
		</blockquote>
		</div>

		
		</div>
		<div class = "container-fluid">
			<br>
			<div id = "middlebox">
			<div id = "BeerSlide" class = "carousel slide" data-ride = "carousel">
				<ol class = "carousel-indicators">
					<li data-target = "BeerSlide" data-slide-to = "0" class = "active"></li>
					<li data-target = "BeerSlide" data-slide-to = "1"></li>
					<li data-target = "BeerSlide" data-slide-to = "2"></li>
					<li data-target = "BeerSlide" data-slide-to = "3"></li>
				</ol>
				<div class = "carousel-inner" role = "listbox">
					<div class = "item active">
						<img id = "slideimages" src = "images/picture/beerslide1.jpg" alt = "beerslide1">
					</div>
					<div class = "item">
						<img id = "slideimages" src = "images/picture/beerslide2.jpg" alt = "beerslide2">
					</div>
					<div class = "item">
						<img id = "slideimages" src = "images/picture/beerslide3.jpg" alt = "beerslide3">
					</div>
					<div class = "item">
						<img id = "slideimages" src = "images/picture/beerslide4.jpg" alt = "beerslide4">
					</div>
				</div>

				<a class = "left carousel-control" href = "#BeerSlide" role = "button" data-slide = "prev">
					<span class = "glyphicon glyphicon-chevron-left" aria-hidden = "ture"></span>
					<span class = "sr-only">Previous</span>
				</a>
				<a class = "right carousel-control" href = "#BeerSlide" role = "button" data-slide = "next">
					<span class = "glyphicon glyphicon-chevron-right" aria-hidden = "ture"></span>
					<span class = "sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
<br><br>
	</div>
		<div id = "webfoot">
			<p>compatible in both desktop and mobile phones || 
				some images were obtained from google.ca <span class = "footercopyright"></span></p>
		</div>
		<script>
		$(document).ready(function() {
				$(".footercopyright").html("<p>&copy;  " + new Date().getFullYear() + " The BeerLog. All rights reserved.</p>");
			});
		</script>
</div>


</body>
<script>
var TInt = setInterval(function(){changeFunction()}, 1000);
function changeFunction() {
	var x = document.getElementById("dt");
	x.innerHTML = new Date().toLocaleTimeString();
	x.style.color = "black";
}
</script>
</html>
