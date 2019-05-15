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
	
	<div class = "container-fluid" id = "SBUsection" style = "min-height: 600px;">
		<h3 style = "text-align: center">Search all the comments by user ID!</h3> 
		<br><br>
		
		<div class = "container-fluid">	

		<form role = "form" method = "post">
		<div class = "col-sm-6">
			<?php
				include 'connection.php';
			?>
			<p class = "text-danger"><strong>Updated list of users:</strong></p>
			<div class = "form-group">
				<label for = "SBUList">Select the user ID: </label><p></p>
					<?php
					$UserList = "SELECT DISTINCT UserName FROM records ORDER BY UserName";
					$Userresult = mysql_query($UserList);

					echo "<select class = 'form-control input-sm' id = 'SBUList' name = 'SBUList'>
					<option>User Card List</option>";
				
					while($Userrow = mysql_fetch_assoc($Userresult)) {
						echo
						"<option>{$Userrow['UserName']}</option>";
					}
					echo "</select>";
					mysql_free_result($Userresult);
					mysql_close($con);
					?>
				<p></p>
				<button type = "submit" id = "SBUButton" name = "SBUButton" class = "btn btn-success btn-sm btn-block" disabled>Search</button><br>
			</div>
		</div>
		</form>	

		<div class = "col-sm-6">
			<div class = "container-fluid">
				<div class = "well">
					<div>
						<p style = "text-align: right"><strong>User Card</strong></p>
						<hr>
					</div>
		<?php 
			if (isset($_POST['SBUButton'])) {
				include 'connection.php';

				$SBUName = $_POST['SBUList'];

				$SBULoginList = "SELECT COUNT(UserName) from loginlog where UserName = '$SBUName'";
			 	$SBULoginResult = mysql_query($SBULoginList);
			 	$SBULogin = mysql_result($SBULoginResult, 0);

			 	$SBUPostList = "SELECT COUNT(UserName) from records where UserName = '$SBUName'";
			 	$SBUPostResult = mysql_query($SBUPostList);
			 	$SBUPost = mysql_result($SBUPostResult, 0);
			 	
			 	$SBUPubList = "SELECT COUNT(DISTINCT PubName) from records where UserName = '$SBUName'";
			 	$SBUPubResult = mysql_query($SBUPubList);
			 	$SBUPub = mysql_result($SBUPubResult, 0);

			 	$SBUBeerList = "SELECT COUNT(DISTINCT Beer) from records where UserName = '$SBUName'";
			 	$SBUBeerResult = mysql_query($SBUBeerList);
			 	$SBUBeer = mysql_result($SBUBeerResult, 0);

				echo "<p class = 'lead' style = 'text-align: center'>"."<strong>".
				$SBUName."</strong>"."</p>";

				echo "Log in <span class = 'badge'>".$SBULogin."</span><br>";
				echo "Posts <span class = 'badge'>".$SBUPost."</span><br>";
				echo "Pub selection <span class = 'badge'>".$SBUPub."</span><br>";
				echo "Beer selection <span class = 'badge'>".$SBUBeer."</span>";

				mysql_close($con);

			}
		?>
		<p></p>
				</div>
			</div>
		</div>
	</div>
		<div class = "col-sm-12">
			<div class = "panel-group">
				<div class = "panel panel-default">
					<div class = "panel-heading" style = "text-align: center">
						<h3 class = "panel-title">
							<a data-toggle = "collapse" href = "#usercommenttablecollapse">
							<?php
								echo "<strong>Beer comments card</strong><hr>";
								if (isset($_POST['SBUButton'])) {
									echo "<span><strong>by "."<span style = 'color: red'>".$SBUName."</span>"."</strong></span>";
								}
							?>
							</a>
						</h3>
					</div>
					<div class = "panel-collapse collapse" id = "usercommenttablecollapse">
					<div class = "panel-body">
						<?php
						if (isset($_POST['SBUButton'])) {
							include 'connection.php';
					//connection completed
							$UserSearchList = "SELECT * FROM records WHERE UserName = '$SBUName'
				 						ORDER BY VisitingDate DESC, PostedTime DESC";

							$UserSearchresult = mysql_query($UserSearchList);
						}
						?>
						

						<div class = "table-responsive">
						<table class = "table-striped table-condensed" style = "text-align: center; width: 100%">
							<tr>
								<th>City</th>
								<th>Pub Name</th>
								<th>Visiting Date</th>
								<th>Beer Name</th>
								<th>Comments</th>
							</tr>
							<?php
								
								while($UserSearchrow = mysql_fetch_assoc($UserSearchresult)) {
									echo
									"<tr>
									<td>
									{$UserSearchrow['City']}</td>
									<td>
									{$UserSearchrow['PubName']}</td>
									<td>
									{$UserSearchrow['VisitingDate']}</td>
									<td>
									{$UserSearchrow['Beer']}</td>
									<td>
									{$UserSearchrow['Comments']}</td>
									</tr>";
								}
								
								
								mysql_free_result($UserSearchresult);
								mysql_close($con);
							?>
							</table>
						</div>
					</div>
					<div class = "panel-footer" style = "text-align: right">
						<em>Post your beer comment today!</em>
					</div>
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
<script>
document.getElementById("SBUsection").onload = SBUlistFunction();
function SBUlistFunction() {
	document.getElementById("SBUList").onchange = function() {
		if (document.getElementById("SBUList").value == "User Card List") {
		document.getElementById("SBUButton").disabled = true;
	} else {
		document.getElementById("SBUButton").disabled = false;
		}
	}
}
</script>
</body>
</html>
