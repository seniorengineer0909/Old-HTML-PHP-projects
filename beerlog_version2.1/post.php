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
	
	<div class = "container-fluid" id = "postsection" style = "min-height: 600px;">
		<h3 style = "text-align: center"><span class = "text-warning">Post</span> and
		 <span class = "text-danger">share</span> your beer experience</h3> 
			<br><br>
		<div class = "container-fluid">
		<form role = "form" method = "post" action = "postprocess.php">
		<div class = "col-sm-6">
			<div class = "form-group">
				<label for = "CityList">City:</label>
				<?php
					$PostCityList = "SELECT CityName FROM city ORDER BY CityName";
					$PostCityresult = mysql_query($PostCityList);

					if(mysql_num_rows($PostCityresult) == 0) {
						echo "no data found";
						exit;
					}
				
					echo "<select class = 'form-control input-sm' id = 'CityList' name = 'CityList' required>
					<option>Not on the list? Please type</option>";
				
					while($PostCityrow = mysql_fetch_assoc($PostCityresult)) {
						echo
						"<option>{$PostCityrow['CityName']}</option>";
					}
					echo "</select>";
					mysql_free_result($PostCityresult);
				?><p></p>
				<input type = "text" class = "form-control input-sm" name = "CityNotOnList" id = "CityNotOnList" 
				placeholder = "Type City not on the list" maxlength = "30" required>
			</div>
			<div class = "form-group">
				<label for = "PubList">Pub:</label>
				<?php
					$PostPubList = "SELECT PubName FROM pub ORDER BY PubName";
					$PostPubresult = mysql_query($PostPubList);

					if(mysql_num_rows($PostPubresult) == 0) {
						echo "no data found";
						exit;
					}
				
					echo "<select class = 'form-control input-sm' id = 'PubList' name = 'PubList' required>
					<option>Not on the list? Please type</option>";
				
					while($PostPubrow = mysql_fetch_assoc($PostPubresult)) {
						echo
						"<option>{$PostPubrow['PubName']}</option>";
					}
					echo "</select>";
					mysql_free_result($PostPubresult);
				?><p></p>
				<input type = "text" class = "form-control input-sm" name = "PubNotOnList" id = "PubNotOnList" 
				placeholder = "Type Pub not on the list" maxlength = "30" required>
			</div>
			<div class = "form-group">
				<label for = "vdate">Visiting date:</label>
				<input type = "date" class = "form-control" id = "vdate" name = "vdate" required>
			</div>
			<div class = "form-group">
				<label for = "BeerList">Beer:</label>
				<?php
					$PostBeerList = "SELECT NameOfBeer FROM beertypetable ORDER BY NameOfBeer";
					$PostBeerresult = mysql_query($PostBeerList);

					if(mysql_num_rows($PostBeerresult) == 0) {
						echo "no data found";
						exit;
					}
				
					echo "<select class = 'form-control input-sm' id = 'BeerList' name = 'BeerList' required>
					<option>Not on the list? Please type</option>";
				
					while($PostBeerrow = mysql_fetch_assoc($PostBeerresult)) {
						echo
						"<option>{$PostBeerrow['NameOfBeer']}</option>";
					}
					echo "</select>";
					mysql_free_result($PostBeerresult);
				?><p></p>
				<input type = "text" class = "form-control input-sm" name = "BeerNotOnList" id = "BeerNotOnList" 
				placeholder = "Type Beer name not on the list" maxlength = "30" required>
			</div>
			
		</div>		

		<div class = "col-sm-6">
			<form role = "form" method = "post" action = "postprocess.php">
			<div class = "form-group">
				<label for = "Comments">Comments:</label>
				<textarea class = "form-control input-sm" name = "Comments" id = "Comments" 
				rows = "10" maxlength = "255" required></textarea>
			</div>
			 <div class="alert alert-danger fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Note: </strong> Duplicated comments are automatically rejected by the database.
		  	</div>
			<div class = "text-right">
				<button type = "submit" class = "btn btn-default"><a style = "text-decoration: none" data-toggle = "tooltip" data-placement = "auto" title = "Press me!">Post</a></button>
			</div>
			</form>
<br><br>

		</div>
		</form>
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
<script>
document.getElementById("postsection").onload = citylistFunction(), publistFunction(), beerlistFunction();
function citylistFunction() {
	document.getElementById("CityList").onchange = function() {
		if (document.getElementById("CityList").value !== "Not on the list? Please type") {
		document.getElementById("CityNotOnList").disabled = true;
	} else {
		document.getElementById("CityNotOnList").disabled = false;
		}
	}
}
function publistFunction() {
	document.getElementById("PubList").onchange = function() {
		if (document.getElementById("PubList").value !== "Not on the list? Please type") {
		document.getElementById("PubNotOnList").disabled = true;
	} else {
		document.getElementById("PubNotOnList").disabled = false;
		}
	}
}
function beerlistFunction() {
	document.getElementById("BeerList").onchange = function() {
		if (document.getElementById("BeerList").value !== "Not on the list? Please type") {
		document.getElementById("BeerNotOnList").disabled = true;
	} else {
		document.getElementById("BeerNotOnList").disabled = false;
		}
	}
}


</script>
</html>
