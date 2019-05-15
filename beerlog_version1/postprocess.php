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
	
	nav {
	    background-color: transparent;
	    height: auto;
	    width: 100%;
	    float: left;
	    padding: 0px;
	    margin: 0;
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
  		<h1 id = "Firstpagebutton" style = "text-align:center; border-bottom: 3px solid #cc9900; margin: 20px; padding: 20px"><strong>The BeerLog.beta</strong></h1>
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
			<?php
			session_start();

			if($_POST) {
				$mysqlservername = "localhost";
				$mysqlusername = "root";
				$mysqlpassword = "choi0206";
				$mysqldbname = "beerlog";

				$con = mysql_connect($mysqlservername, $mysqlusername, $mysqlpassword);

				if(!con) {
					die ("could not connect: ".mysql_error());
				}

				mysql_select_db($mysqldbname, $con);

					if($_POST['cityselectlist'] === '*if not here: Please type*') {
						$post_city = $_POST['cityNotOnList'];
						} else {
							$post_city = $_POST['cityselectlist'];
						}

					$post_pub = $_POST['pubname'];
					$post_vd = $_POST['vdate'];
					$post_user = $_SESSION['nickname'];

					if($_POST['BeerPostSelect'] === '*if not here: Please type*') {
						$post_beer = $_POST['beerNotOnList'];
						} else {
							$post_beer = $_POST['BeerPostSelect'];
						}

					$post_comment = $_POST['comments'];

					$post_city = mysql_real_escape_string($post_city);
					$post_pub = mysql_real_escape_string($post_pub);
					$post_vd = mysql_real_escape_string($post_vd);
					$post_beer = mysql_real_escape_string($post_beer);
					$post_comment = mysql_real_escape_string($post_comment);

				
				$postprocessing = "INSERT INTO records  
					VALUES (null, '$post_user', '$post_city','$post_pub','$post_vd','$post_beer','$post_comment');";

				mysql_query($postprocessing);
				mysql_close($con);

				echo "<h2> Posting was successful!</h2>";
			}
			?>
			<button onClick = "window.location.href = 'main.php'">Back to Homepage</button>

		</div>
	</div>
	

<footer>
	<p>compatible in both desktop and mobile phones || some images were obtained from google.ca <span class = "copyright"></span></p>
</footer>
	</div>
<script>
	$(document).ready(function() {
		$(".copyright").html("<p>&copy;  " + new Date().getFullYear() + " The BeerLog. All rights reserved.</p>");
	});
</script>
</body>
</html>
