<?php
	session_start();
	if(isset($_SESSION['is_not_confirmed'])) {
		$notconfirmed = "Two passwords are not matching!";
		echo "<script>alert('$notconfirmed')</script>";
	} session_destroy();

	if(isset($_SESSION['is_existing'])) {
		echo "<script>alert('ID already existing: Please choose different ID')</script>";
	};
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

	<script>
	$(document).ready(function() {
		$("input").on({
			focus: function() {
				$(this).css("background-color", "#cccccc");
			},
			blur: function() {
				$(this).css("background-color", "#ffffff");
			}
		});
	});
	</script>
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

	<nav class = "navbar navbar-default ">
		<div class = "container-fluid">
			<div class = "navbar-header">
				<button type = "button" class = "navbar-toggle" data-toggle = "collapse" data-target = "#myNavbar">
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
				</button>
				<a class = "navbar-brand" href = "index.php" data-toggle = "tooltip" data-placement = "auto" 
						title = "Home">
					<img id = "homeicon" src = "images/icon/beerbottle.png" alt = "homticon">
				</a>
				<a class = "navbar-brand" href = "#">
					Post 
				</a>
			</div>

			<div class = "collapse navbar-collapse" id = "myNavbar">
				<ul class = "nav navbar-nav">
					<li class = "dropdown">
						<a class = "dropdown-toggle" data-toggle = "dropdown" href = "#">
							Comment Search<span class = "caret"></span>
						</a>
						<li class = "disabled"><a href = "#">Comment List</a></li>
							<ul class = "dropdown-menu">
								<li class = "disabled"><a href = "#">By Beer Name</a></li>
								<li class = "disabled"><a href = "#">By User Name</a></li>
								<li class = "disabled"><a href = "#">By Pub Name</a></li>
								<li class = "disabled"><a href = "#">By Date</a></li>
							</ul>
					</li>
					<li class = "disabled"><a href = "#">Beer Info</a></li>
				</ul>

				<ul class = "nav navbar-nav navbar-right">
					<li><a href = "index.php"></span>Login</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div id = "registersection" class = "container-fluid">
		<h2 style = "text-align: center">Create an account</h2>
		<br> 
		<div id = "middlebox">
		<form role = "form" method = "post" action = "registerprocess.php">
			<div class = "form-group">
				<label for = "RegisterName"><span style = "color: red">* </span>Name:</label>
				<input type = "text" class = "form-control" name = "RegisterName" id = "RegisterName" placeholder = "Enter Name" maxlength = "20" required>
			</div>
			<div class = "form-group">
				<label for = "RegisterEmail"><span style = "color: red">* </span>Email:</label>
				<input type = "email" class = "form-control" name = "RegisterEmail" id = "RegisterEmail" placeholder = "Enter Email" maxlength = "30" required>
			</div>
			<div class = "form-group">
				<label for = "RegisterID"><span style = "color: red">* </span>ID:</label>
				<input type = "text" class = "form-control" name = "RegisterID" id = "RegisterID" placeholder = "Enter ID" maxlength = "15" required>
				<span class = "help-block">Maximum 15 characters</span>
			</div>
			<div class = "form-group">
				<label for = "RegisterPassword"><span style = "color: red">* </span>Password:</label>
				<input type = "password" class = "form-control" name = "RegisterPassword" id = "RegisterPassword" placeholder = "Enter Password" maxlength = "8" required>
				<span class = "help-block">Maximum 8 characters</span>
			</div>
			<div class = "form-group">
				<label for = "RegisterPasswordRepeat"><span style = "color: red">* </span>Confirm Password:</label>
				<input type = "password" class = "form-control" name = "RegisterPasswordRepeat" id = "RegisterPasswordRepeat" placeholder = "Enter Password Again" required>
			</div>
			<br>
			<button type = "submit" class = "btn btn-default"><a style = "text-decoration: none" data-toggle = "tooltip" data-placement = "auto" title = "Yay!">Create</a></button>
			</form>
			<br><br><br>
		</div>
	</div>
</div>
	
</body>
</html>
