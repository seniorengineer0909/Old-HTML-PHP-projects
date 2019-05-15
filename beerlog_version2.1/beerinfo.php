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
	
	<div class = "container-fluid" id = "beerinfosection" style = "min-height: 600px;">
		<h3 style = "text-align: center">Browse your beer now!</h3> 
		<br><br>
		<div class = "container-fluid">
		
		<div class = "col-sm-6">
<!--Log in information-->		
		<?php
		include 'connection.php';
//connection completed
		?>
	<div class = "container-fluid">
		<p class = "text-danger"><strong>Updated list of beers:</strong></p>
		<div class = "container-fluid">	
		<form role = "form" method = "post">
			<div class = "form-group">
				<label for = "BeerBrowseList">Select the beer: </lable><p></p>
					<?php
						$BeerList = "SELECT DISTINCT NameOfBeer FROM beertypetable ORDER BY NameOfBeer";
						$Beerresult = mysql_query($BeerList);

						echo "<select class = 'form-control input-sm' id = 'BeerBrowseList' name = 'BeerBrowseList'>
						<option>Beer Card List</option>";
					
						while($Beerrow = mysql_fetch_assoc($Beerresult)) {
							echo
							"<option>{$Beerrow['NameOfBeer']}</option>";
						}
						echo "</select>";
						mysql_free_result($Beerresult);
						mysql_close($con);
					?>
		
			</div>
						
			<button type = "submit" id = "beersearchButton" name = "beersearchButton" 
			class = "btn btn-default btn-sm">Browse</button><br>
		</form>
		</div>
	</div>
		<br>
		</div>
		

		<div class = "col-sm-6">
			<div class = "container-fluid">
				<div class = "well">
					<div>
						<p style = "text-align: right"><strong>Beer Card</strong></p>
						<hr>
					</div>
		<?php 
			if (isset($_POST['beersearchButton'])) {
				include 'connection.php';

				$BeerName = $_POST['BeerBrowseList'];

				$BeerAlcoholList = "SELECT AlcoholOfBeer FROM beertypetable 
			 					WHERE NameOfBeer = '$BeerName'";
			 	$BeerAlcoholResult = mysql_query($BeerAlcoholList);
			 	$BeerAlcohol = mysql_result($BeerAlcoholResult, 0);

			 	$BeerOrginList = "SELECT OrginOfBeer FROM beertypetable 
			 					WHERE NameOfBeer = '$BeerName'";
			 	$BeerOrginResult = mysql_query($BeerOrginList);
			 	$BeerOrgin = mysql_result($BeerOrginResult, 0);
			 	
			 	$BeerLogoList = "SELECT Logo FROM beertypetable 
			 					WHERE NameOfBeer = '$BeerName'";
			 	$BeerLogoResult = mysql_query($BeerLogoList);
			 	$BeerLogo = mysql_result($BeerLogoResult, 0);

			 	$BeerIntroducedList = "SELECT Introduced FROM beertypetable 
			 					WHERE NameOfBeer = '$BeerName'";
			 	$BeerIntroducedResult = mysql_query($BeerIntroducedList);
			 	$BeerIntroduced = mysql_result($BeerIntroducedResult, 0);

				echo "<p class = 'lead' style = 'text-align: center'>"."<strong>".
				$BeerName."</strong>"."</p>";
				echo "Alcohol: "."<strong>".$BeerAlcohol."</strong>";
				echo "<br>";
				echo "Country of Orgin: "."<strong>".$BeerOrgin."</strong>";
				echo "<br>";
				echo "Introduced in: "."<strong>".$BeerIntroduced."</strong>";
				echo "<p></p>";
				echo "<div id = 'logoimage'>";
			 	echo "<img class = 'img-thumbnail' src =".$BeerLogo." 
			 	alt = ".$BeerName."></div>";

				mysql_close($con);

			}
		?>
		<p></p>
				</div>
			</div>
		</div>
	</div>
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
</div>

</body>
</html>
