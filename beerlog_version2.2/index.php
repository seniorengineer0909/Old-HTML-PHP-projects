<?php
	session_start();
	if(isset($_SESSION['is_failed'])) {
		$loginfail = "Wrong ID or Password";
		echo "<script>alert('$loginfail')</script>";
	}
	if(isset($_SESSION['is_confirmed'])) {
		echo "<script>alert('Successfully registered!')</script>";
	}
	session_destroy();
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

<body>
<div id = "main" class = "container">
	<?php
		include 'header-index.php';
	?>
	
	<div class = "container-fluid" id = "pleaselogin" style = "display: none">
		<div class = "alert alert-danger fade in">
			<a href = "#" class = "close" data-dismiss = "alert" aria-label = "close">&times;</a>
			<strong>Please log in to access the data</strong>
		</div>
	</div>
	<div class = "container-fluid" id = "mainsection">
		<h2 style = "text-align: center">Welcome to OurBeerLog.<small><code>com</code></small></h2> 
		<p style = "text-align: center">Post and get the beer comments from your friends</p>
		<br><br>
		<div class = "container-fluid">
		
		<div class = "col-sm-5">
<!--Log in section-->		
		<form role = "form" method = "post" action = "loginprocess.php">
			<div class = "form-group">
				<label for = "LoginID">ID:</label>
				<input type = "text" class = "form-control input-sm" name = "LoginID" id = "LoginID" placeholder = "Enter ID" maxlength = "15" required>
				<span class = "help-block">Maximum 15 characters</span>
			</div>
			<div class = "form-group">
				<label for = "LoginPassword">Password:</label>
				<input type = "password" class = "form-control input-sm" name = "LoginPassword" id = "LoginPassword" placeholder = "Enter Password" maxlength = "8" required>
				<span class = "help-block">Maximum 8 characters</span>
			</div>
			<button type = "submit" class = "btn btn-default"><a style = "text-decoration: none" 
				data-toggle = "tooltip" data-placement = "bottom" title = "Yay!">
				<span class = 'glyphicon glyphicon-log-in'></span> Log in</a></button>
		</form>
			<br>
				<a href = "register.php" data-toggle = "tooltip" data-placement = "auto" 
						title = "Yay!"><span class = 'glyphicon glyphicon-plus-sign'></span> Sign up!</a><br><br>
				<a onclick = "alert('Please contact Sean!')"><span class = 'glyphicon glyphicon-question-sign'></span> Forgot your password?</a>
		<p></p>		
		</div>

		<div class = "col-sm-1">
		</div>
<!--Quote section-->
		<div class = "col-sm-6">
		<blockquote>
			<p id = "quote">Beer makes you feel the way you ought to feel without beer.</p>
			<footer>Henry Lawson</footer>
		</blockquote>
		<blockquote class = "blockquote-reverse">
			<p id = "quote">Milk is for babies. When you grow up you have to drink beer.</p>
			<footer>Arnold Schwarzenegger</footer>
		</blockquote>
		<blockquote>
			<p id = "quote">An intelligent man is sometimes forced to be drunk to spend time with his fools.</p>
			<footer>Ernest Hemingway</footer>
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
<script>
$(document).ready(function() {
	$('[data-toggle = "popover"]').popover();
});
</script>
</div>


</body>
</html>
