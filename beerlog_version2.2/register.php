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
	<?php
		include 'header.php';
	?>

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
	<div id = "webfoot">
			<?php
				include('footer.php');
			?>
	</div>
</div>
	
</body>
</html>
