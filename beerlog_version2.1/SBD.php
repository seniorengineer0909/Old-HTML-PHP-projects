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
	
	<div class = "container-fluid" id = "SBDsection" style = "min-height: 600px;">
		<h3 style = "text-align: center">Search all the comments by date!</h3> 
			<br><br>

		<div class = "container-fluid">
		<form role = "form" method = "post">
		<div class = "col-sm-6">
			<div class = "form-group">
				<label for = "DateFrom">From:</label>
				<input type = 'date' class = 'form-control input-sm' id = 'DateFrom' name = 'DateFrom' required>
			</div>
		</div>
		<div class = "col-sm-6">
			<div class = "form-group">
				<label for = "DateTo">To:</label>
				<input type = 'date' class = 'form-control input-sm' id = 'DateTo' name = 'DateTo' required>
			</div>
		</div>
		<div class = "col-sm-12">
			<button type = "submit" id = "SBDButton" name = "SBDButton" class = "btn btn-success btn-sm btn-block">Search</button><br>
		</div>
		</form>
	</div>
		<div class = "col-sm-12">
			<div class = "panel-group">
				<div class = "panel panel-default">
					<div class = "panel-heading" style = "text-align: center">
						<h3 class = "panel-title">
							<a data-toggle = "collapse" href = "#datecommenttablecollapse">
								<?php
								echo "<strong>Beer comments card</strong><hr>";
								if (isset($_POST['SBDButton'])) {
									$SBDFrom = $_POST['DateFrom'];
									$SBDTo = $_POST['DateTo'];
								
								if ($SBDFrom > $SBDTo) {
									echo "<script>alert('To date must be the same or later than From date')</script>";
								} elseif ($SBDFrom == $SBDTo) {
									echo "on <span style = 'color: red'><strong>".$SBDFrom."</strong>";
								} else {
									echo "<span style = 'color: red'><strong>".$SBDFrom."</strong></span>"." to "."<span style = 'color: red'><strong>".$SBDTo."</strong></span>";
								}
								}

								?>
							</a>
						</h3>
					</div>
					<div class = "panel-collapse collapse" id = "datecommenttablecollapse">
					<div class = "panel-body">
						<?php
						if (isset($_POST['SBDButton'])) {
							include 'connection.php';
					//connection completed
							if ($SBDFrom > $SBDTo) {
								echo "null";
							} elseif ($SBDFrom == $SBDTo) {
								$DateSearchList = "SELECT * FROM records WHERE VisitingDate = '$SBDFrom'
					 						ORDER BY VisitingDate DESC, PostedTime DESC";
								$DateSearchresult = mysql_query($DateSearchList);
							} else {
								$DateSearchList = "SELECT * FROM records WHERE cast(VisitingDate AS DATE) BETWEEN '$SBDFrom' and '$SBDTo' ORDER BY VisitingDate DESC, PostedTime DESC";
								$DateSearchresult = mysql_query($DateSearchList);
							}
						}	
						?>
						

						<div class = "table-responsive">
						<table class = "table-striped table-condensed" style = "text-align: center; width: 100%">
							<tr>
								<th>User ID</th>
								<th>City</th>
								<th>Visiting Date</th>
								<th>Beer Name</th>
								<th>Comments</th>
							</tr>
							<?php
								
								while($DateSearchrow = mysql_fetch_assoc($DateSearchresult)) {
									echo
									"<tr>
									<td>
									{$DateSearchrow['UserName']}</td>
									<td>
									{$DateSearchrow['City']}</td>
									<td>
									{$DateSearchrow['VisitingDate']}</td>
									<td>
									{$DateSearchrow['Beer']}</td>
									<td>
									{$DateSearchrow['Comments']}</td>
									</tr>";
								}
								
								
								mysql_free_result($DateSearchresult);
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


</div><!--for main-->

</body>
</html>