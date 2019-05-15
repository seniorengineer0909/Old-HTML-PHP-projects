<?php
	session_start();
	if(!isset($_SESSION['is_login'])) {
		header("location: login.php");
	} 
?>

<!doctype html>

<html lang = "en-US">

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
	</script>
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
	<title>WHAT BEER ARE YOU DRINKING?</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	*{
		box-sizing: border-box;
	}
	html {
	    font-family: "Lucida Sans", sans-serif;
	}
	[class*="col-"] {
	    float: left;
	    padding: 15px;
	}
	.row:after {
	    content: "";
	    clear: both;
	    display: block;
	}
	body {
		background-color: dimgrey;
		max-width: 900px;
		margin: 0px auto;
	}
	div#main {
		background-color: white;
	}
	th {
		background-color: #FFAC30;
		color: white;
	}
	tr:nth-child(odd) {
		background-color: #FFEEA9;
		color: black;
	}
	tr:nth-child(even) {
		background-color: #F4F4F1;
		color: black;
	}
	td {
		font-size: 13px;
	}
	footer {
    border: 1px solid black;
    color: black;
    text-align: center;
    font-size: 12px;
    padding: 5px;
    }
	/* For mobile phones: */
	[class*="col-"] {
	    width: 100%;
	}
	@media only screen and (min-width: 800px) {
	    /* For desktop: */
	    .col-1 {width: 8.33%;}
	    .col-2 {width: 16.66%;}
	    .col-3 {width: 25%;}
	    .col-4 {width: 33.33%;}
	    .col-5 {width: 41.66%;}
	    .col-6 {width: 50%;}
	    .col-7 {width: 58.33%;}
	    .col-8 {width: 66.66%;}
	    .col-9 {width: 75%;}
	    .col-10 {width: 83.33%;}
	    .col-11 {width: 91.66%;}
	    .col-12 {width: 100%;}
	}
	</style>
</head>

<body>
	<div id = "main">
	<header>
  		<h1 id = "Firstpagebutton" style = "text-align:center; border-bottom: 3px solid #cc9900; margin: 20px; padding: 20px"><strong>The BeerLog.beta</strong></h1>
	</header>

	<div class = "row">
		<div class = "col-12 content" id = "contents" style = "min-height: 570px">
			 <?php
			 	$mysqlservername = "localhost";
				$mysqlusername = "root";
				$mysqlpassword = "choi0206";
				$mysqldbname = "beerlog";

				$con = mysql_connect($mysqlservername, $mysqlusername, $mysqlpassword);

				if(!con) {
					die ("could not connect: ".mysql_error());
				}

				mysql_select_db($mysqldbname, $con);
			 	$UserBrowse = $_POST['SBUList'];
			 	echo "comments by "."<strong style = 'color: red'>".$UserBrowse."</strong>";
			 	echo "<br><br>";
			 	
			 	$UserBrowseList = "SELECT * FROM records WHERE UserName = '$UserBrowse'
			 						ORDER BY VisitingDate";

				$UserBrowseresult = mysql_query($UserBrowseList);

				if(mysql_num_rows($UserBrowseresult) == 0) {
					echo "no data found";
					;
				}
			?>
			<form action = "main.php">
				<button id = "backtologinbutton">Back to Home page</button>
			</form>
			<br>
	<table style = "width: 100%; border: 2px solid black; border-collapse: collapse; text-align: center">
		<tr style = 'border-bottom: 3px solid black'>
			<th style = 'border: 1px solid black'>City</th>
			<th style = 'border: 1px solid black'>Pub Name</th>
			<th style = 'border: 1px solid black'>Visiting Date</th>
			<th style = 'border: 1px solid black'>Beer Name</th>
			<th style = 'border: 1px solid black'>Comments</th>
		</tr>
			<?php
				while($UserBrowserow = mysql_fetch_assoc($UserBrowseresult)) {
					echo
					"<tr>
					<td style = 'border: 1px solid black; padding: 10px'>
					{$UserBrowserow['City']}</td>
					<td style = 'border: 1px solid black; padding: 10px'>
					{$UserBrowserow['PubName']}</td>
					<td style = 'border: 1px solid black; padding: 10px'>
					{$UserBrowserow['VisitingDate']}</td>
					<td style = 'border: 1px solid black; padding: 10px'>
					{$UserBrowserow['Beer']}</td>
					<td style = 'border: 1px solid black; padding: 10px'>
					{$UserBrowserow['Comments']}</td>
					</tr>";
				}
				echo "</table>";
				
				mysql_free_result($UserBrowseresult);
				mysql_close($con);

			?>		
		<br>	
		<form method = "post" action = "main.php">
			<button id = "backtologinbutton">Back to Home page</button>
		</form>	
		</div>
	</div>
<footer>
	<p>compatible in both desktop and mobile phones || some images were obtained from google.ca <span class = "copyright"></span></p>
</footer>
<script>
	$(document).ready(function() {
		$(".copyright").html("<p>&copy;  " + new Date().getFullYear() + " The BeerLog. All rights reserved.</p>");
	});
</script>
</body>
</html>