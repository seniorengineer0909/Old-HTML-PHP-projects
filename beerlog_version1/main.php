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
	?>
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
	    padding: 10px;
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
	
	nav {
	    background-color: transparent;
	    height: auto;
	    width: 100%;
	    float: left;
	    padding: 0px;
	    margin: 0;
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
	.menu ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}
	.menu li {
	    padding: 20px;
	    height: 100px;
	    line-height: 50px;
	    text-align: center;
	    margin-bottom: 10px;
	    background-color: transparent;
	    color: black;
	    font-weight: bold;
	    /*box-shadow: 0 10px 10px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);*/
	}
	.menu li:hover {
    	background-color: #FFFFDB;
	}
	.menu span {
		vertical-align: middle;
	}
	li#Homebutton {
		background-image: url("images/sidebar/beerbottle.png");
		background-size: 80px 80px;
		background-repeat: no-repeat;
		background-position: -5px 10px;
	}
	li#Postbutton {
		background-image: url("images/sidebar/disk.png");
		background-size: 70px 70px;
		background-repeat: no-repeat;
		background-position: 0px 15px;
	}
	li#SBBbutton {
		background-image: url("images/sidebar/beerglass.png");
		background-size: 80px 80px;
		background-repeat: no-repeat;
		background-position: -10px 10px;
	}
	li#SBUbutton {
		background-image: url("images/sidebar/search.png");
		background-size: 60px 60px;
		background-repeat: no-repeat;
		background-position: 0px 20px;
	}
	li#Listbutton {
		background-image: url("images/sidebar/list.png");
		background-size: 60px 60px;
		background-repeat: no-repeat;
		background-position: 5px 20px;
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
  		<h1 id = "Firstpagebutton" style = "text-align: center; border-bottom: 3px solid #cc9900; margin: 20px; padding: 20px"><strong>The BeerLog.beta</strong></h1>
	</header>

	<div class = "row">
		<div class = "col-3 menu">
			<nav>
<!--menu bar-->
				<ul>
					<li id = "Homebutton"><span>Home</span></li>
					<li id = "Postbutton"><span>Post</span></li>
					<li id = "SBBbutton"><span>Search by beer</span></li>
					<li id = "SBUbutton"><span>search by user</span></li>
					<li id = "Listbutton"><span>List</span></li>
				</ul>
			</nav>
		</div>

		<div class = "col-9 content" id = "contents">
<!--firstpage section-->			
			<div id = "firstpagesection" style = "display: none">
				<p>version: 1.0</p>
				<p>publish date: 2015-09-03</p>
				<p>publisher: Sean Choi</p>
				<p>contact: <i>ss.choi@mail.utoronto.ca</i></p>
				<p class = "copyright"></p>
			</div>
<!--home section-->			
			<div id = "homesection" style = "display: block">
				<?php
				echo "Hey "."<b style = 'color: red'>".$_SESSION['nickname']."</b>";
				?>
				
				<h2>Welcome to The BeerLog.beta</h2> 
				<p>Post and get the beer comments from your friends</p>
				<br><br>
				<form method = "post" action = "logoutprocess.php">
					Please do not forget to
					<button>Log out</button>
				</form>
			</div>
<!--post section-->
			<div id = "postsection" style = "display: none">
				<form method = "post" action = "postprocess.php">
<!--city type selection-->
				<p>City:</p>
				<select id = "cityselectlist" name = "cityselectlist" required>
					<option>*if not here: Please type*</option>
					<option>Toronto</option>
					<option>Mississauga</option>
					<option>North York</option>
					<option>Brampton</option>
					<option>Vancouver</option>
				</select> <br><br>
				<input id = "cityNotOnList" name = "cityNotOnList" required type = "text" size = "25" placeholder = "type unknown city name">

	<!--pub type selection-->
				<p>Pub name:</p> 
				<input type = "text" id = "pubname" name = "pubname" size = "25" placeholder = "Pub name" maxlength = "25" required>

	<!--visiting date selection-->
				<p>Visiting date:</p>
				<input type = "date" id = "vdate" name = "vdate" required>

	<!--beer selection list-->
				<p>Updated list of beers:</p>

				<?php
					$BeerPostList = "SELECT NameOfBeer FROM beertypetable ORDER BY NameOfBeer";
					$BeerPostresult = mysql_query($BeerPostList);

					if(mysql_num_rows($BeerPostresult) == 0) {
						echo "no data found";
						exit;
					}
				
					echo "<select id = 'BeerPostSelect' name = 'BeerPostSelect' required>";
				
					while($BeerPostrow = mysql_fetch_assoc($BeerPostresult)) {
						echo
						"<option>{$BeerPostrow['NameOfBeer']}</option>";
					}
					echo "</select>";
					mysql_free_result($BeerPostresult);
				?>
				<br><br>
				<input id = "beerNotOnList" name = "beerNotOnList" type = "text" size = "25" placeholder = "type unknown beer name" required> 

	<!--textarea-->
				<p>Comments</p>			
				<textarea id = "comments" name = "comments" rows = "10" cols = "35" required></textarea>
				<br><br>
	<!--submit-->			
				<input id = "submitbutton" type = "submit" value = "Post">

				</form>
			</div>
<!--SBB section-->
			<div id = "SBBsection" style = "display: none">
	<!--beer selection list-->
				<p>Updated list of beers:</p>
				
				<form method = "post" action = "SBBprocess.php">
				<?php
					$BeerList = "SELECT DISTINCT Beer FROM records ORDER BY Beer";
					$Beerresult = mysql_query($BeerList);

					echo "<select id = 'SBBList' name = 'SBBList'>";
				
					while($Beerrow = mysql_fetch_assoc($Beerresult)) {
						echo
						"<option>{$Beerrow['Beer']}</option>";
					}
					echo "</select>";
					mysql_free_result($Beerresult);
				?>
				<br><br>
				
				<input type = "submit" id = "beersearchButton" value = "Browse"><br>
				</form>
			</div>
<!--SBU section-->
			<div id = "SBUsection" style = "display: none">
				<p>Updated list of users:</p>

				<form method = "post" action = "SBUprocess.php">
				<?php
					$UserList = "SELECT DISTINCT UserName FROM records ORDER BY UserName";
					$Userresult = mysql_query($UserList);

					echo "<select id = 'SBUList' name = 'SBUList'>";
				
					while($Userrow = mysql_fetch_assoc($Userresult)) {
						echo
						"<option>{$Userrow['UserName']}</option>";
					}
					echo "</select>";
					mysql_free_result($Userresult);
				?>
				<br><br>
				
				<input type = "submit" id = "usersearchButton" value = "Browse"><br>
				</form>

					 
			</div>
<!--List section-->
			<div id = "Listsection" style = "display: none">
				<div id = "database">

				<?php

					$List = "SELECT * FROM records order by VisitingDate DESC";

					$Listresult = mysql_query($List);

					if(mysql_num_rows($Listresult) == 0) {
						echo "no data found";
						exit;
					}
				?>
				
					<table style = "width: 100%; border: 1px solid black; border-collapse: collapse; text-align: center">
						<tr style = 'border-bottom: 3px solid black'>
							<th>User ID</th>
							<th>City</th>
							<th>Pub Name</th>
							<th>Visiting Date</th>
							<th>Beer Type</th>
							<th>Comments</th>
						</tr>
				<?php
					while($Listrow = mysql_fetch_assoc($Listresult)) {
						echo
						"<tr>
						<td style = 'padding: 10px'>{$Listrow['UserName']}</td>
						<td style = 'padding: 10px'>{$Listrow['City']}</td>
						<td style = 'padding: 10px'>{$Listrow['PubName']}</td>
						<td style = 'padding: 10px'>{$Listrow['VisitingDate']}</td>
						<td style = 'padding: 10px'>{$Listrow['Beer']}</td>
						<td style = 'padding: 10px'>{$Listrow['Comments']}</td>
						</tr>";
					}
					echo "</table>";
					
					mysql_free_result($Listresult);
				?>

				</div>
			</div>
		</div>
	</div>

	<footer>
	<p>compatible in both desktop and mobile phones || some images were obtained from google.ca <span class = "copyright"></span></p>
	</footer>

</div>
<!--script-->
	<script>
	$(document).ready(function() {
		$(".copyright").html("<p>&copy;  " + new Date().getFullYear() + " The BeerLog. All rights reserved.</p>");
	});

	function citylistFunction() {
		document.getElementById("cityselectlist").onchange = function() {
			if (document.getElementById("cityselectlist").value !== "*if not here: Please type*") {
			document.getElementById("cityNotOnList").disabled = true;
		} else {
			document.getElementById("cityNotOnList").disabled = false;
			}
		}
	}

	function beerlistFunction() {
		document.getElementById("BeerPostSelect").onchange = function() {
			if (document.getElementById("BeerPostSelect").value !== "*if not here: Please type*") {
			document.getElementById("beerNotOnList").disabled = true;
		} else {
			document.getElementById("beerNotOnList").disabled = false;
			}
		}
	}
	
	document.getElementById("Firstpagebutton").onclick = function() {
		document.getElementById("firstpagesection").style.display = "block";
		document.getElementById("homesection").style.display = "none";
		document.getElementById("postsection").style.display = "none";
		document.getElementById("SBBsection").style.display = "none";
		document.getElementById("SBUsection").style.display = "none";
		document.getElementById("Listsection").style.display = "none";

		document.getElementById("Homebutton").style.backgroundColor = "transparent";
		document.getElementById("Postbutton").style.backgroundColor = "transparent";
		document.getElementById("SBBbutton").style.backgroundColor = "transparent";
		document.getElementById("SBUbutton").style.backgroundColor = "transparent";
		document.getElementById("Listbutton").style.backgroundColor = "transparent";
	}

	document.getElementById("Homebutton").onclick = function() {
		document.getElementById("firstpagesection").style.display = "none";
		document.getElementById("homesection").style.display = "block";
		document.getElementById("postsection").style.display = "none";
		document.getElementById("SBBsection").style.display = "none";
		document.getElementById("SBUsection").style.display = "none";
		document.getElementById("Listsection").style.display = "none";

		document.getElementById("Homebutton").style.backgroundColor = "#FFFFDB";
		document.getElementById("Postbutton").style.backgroundColor = "transparent";
		document.getElementById("SBBbutton").style.backgroundColor = "transparent";
		document.getElementById("SBUbutton").style.backgroundColor = "transparent";
		document.getElementById("Listbutton").style.backgroundColor = "transparent";
	}

	document.getElementById("Postbutton").onclick = function() {
		document.getElementById("firstpagesection").style.display = "none";
		document.getElementById("homesection").style.display = "none";
		document.getElementById("postsection").style.display = "block";
		document.getElementById("SBBsection").style.display = "none";
		document.getElementById("SBUsection").style.display = "none";
		document.getElementById("Listsection").style.display = "none";

		document.getElementById("Homebutton").style.backgroundColor = "transparent";
		document.getElementById("Postbutton").style.backgroundColor = "#FFFFDB";
		document.getElementById("SBBbutton").style.backgroundColor = "transparent";
		document.getElementById("SBUbutton").style.backgroundColor = "transparent";
		document.getElementById("Listbutton").style.backgroundColor = "transparent";

		document.getElementById("postsection").onload = citylistFunction();
		document.getElementById("postsection").onload = beerlistFunction();
	}

	document.getElementById("SBBbutton").onclick = function() {
		document.getElementById("firstpagesection").style.display = "none";
		document.getElementById("homesection").style.display = "none";
		document.getElementById("postsection").style.display = "none";
		document.getElementById("SBBsection").style.display = "block";
		document.getElementById("SBUsection").style.display = "none";
		document.getElementById("Listsection").style.display = "none";

		document.getElementById("Homebutton").style.backgroundColor = "transparent";
		document.getElementById("Postbutton").style.backgroundColor = "transparent";
		document.getElementById("SBBbutton").style.backgroundColor = "#FFFFDB";
		document.getElementById("SBUbutton").style.backgroundColor = "transparent";
		document.getElementById("Listbutton").style.backgroundColor = "transparent";

	}

	document.getElementById("SBUbutton").onclick = function() {
		document.getElementById("firstpagesection").style.display = "none";
		document.getElementById("homesection").style.display = "none";
		document.getElementById("postsection").style.display = "none";
		document.getElementById("SBBsection").style.display = "none";
		document.getElementById("SBUsection").style.display = "block";
		document.getElementById("Listsection").style.display = "none";

		document.getElementById("Homebutton").style.backgroundColor = "transparent";
		document.getElementById("Postbutton").style.backgroundColor = "transparent";
		document.getElementById("SBBbutton").style.backgroundColor = "transparent";
		document.getElementById("SBUbutton").style.backgroundColor = "#FFFFDB";
		document.getElementById("Listbutton").style.backgroundColor = "transparent";
	}

	document.getElementById("Listbutton").onclick = function() {
		document.getElementById("firstpagesection").style.display = "none";
		document.getElementById("homesection").style.display = "none";
		document.getElementById("postsection").style.display = "none";
		document.getElementById("SBBsection").style.display = "none";
		document.getElementById("SBUsection").style.display = "none";
		document.getElementById("Listsection").style.display = "block";

		document.getElementById("Homebutton").style.backgroundColor = "transparent";
		document.getElementById("Postbutton").style.backgroundColor = "transparent";
		document.getElementById("SBBbutton").style.backgroundColor = "transparent";
		document.getElementById("SBUbutton").style.backgroundColor = "transparent";
		document.getElementById("Listbutton").style.backgroundColor = "#FFFFDB";
	}
	
	</script>


		

	
</body>
</html>
