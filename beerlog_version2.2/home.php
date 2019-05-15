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
	<?php
		include 'header.php';
	?>
	
	<div class = "container-fluid" id = "homesection">
		<h2 style = "text-align: center">Welcome to OurBeerLog.<small><code>com</code></small></h2> 
		<p style = "text-align: center">Post and get the beer comments from your friends</p>
		<p style = "text-align: center"><kbd>landscape</kbd> mode works the best!</p>
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
		echo "<p><span class = 'glyphicon glyphicon-time'></span> Current time</p>";
		echo date("Y/m/d l");
		echo "<p id = 'dt'></p>";
		echo "<p style = 'text-align: center'><span class = 'text-danger'>
			Total post at the BeerLog.beta</span> <span class = 'label label-success'>".$TotalCommentCount.
			"</span></p>";
		echo "</div>";
		
		echo "<h4><span class = 'glyphicon glyphicon-stats'></span><em> Your stats</em></h4>";
		echo "Log in <span class = 'badge'>".$LoginCount."</span><br>";
		echo "Posts <span class = 'badge'>".$CommentCount."</span><br>";
		echo "Pub selection <span class = 'badge'>".$PubCount."</span><br>";
		echo "Beer selection <span class = 'badge'>".$BeerCount."</span>";

		

		?>
		<p></p><br>
		</div>

		
<!--Quote section-->
		<div class = "col-sm-6">
			<div style = "text-align: center"><h4 class = "text-danger"><strong>The latest beer comments</strong></h4></div><br>
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
			<footer><?php echo $Latest1['UserName']." on <strong>".$Latest1['Beer']."</strong> [".$Latest1['VisitingDate']."]";?></footer>
		</blockquote>
		<blockquote class = "blockquote-reverse">
			<p id = "quote">
				<?php 
				echo $Latest2['Comments'];
				?>
			</p>
			<footer><?php echo $Latest2['UserName']." on <strong>".$Latest2['Beer']."</strong> [".$Latest2['VisitingDate']."]";?></footer>
		</blockquote>
		<blockquote>
			<p id = "quote">
				<?php 
				echo $Latest3['Comments'];
				?>
			</p>
			<footer><?php echo $Latest3['UserName']." on <strong>".$Latest3['Beer']."</strong> [".$Latest3['VisitingDate']."]";?></footer>
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
			<?php
				include('footer.php');
			?>
		</div>
		
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
