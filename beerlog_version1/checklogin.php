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
<!--login check-->
		<div class = "col-9 content" id = "contents">
		<?php
			session_start();

			$mysqlservername = "localhost";
			$mysqlusername = "root";
			$mysqlpassword = "choi0206";
			$mysqldbname = "beerlog";

			$con = mysql_connect($mysqlservername, $mysqlusername, $mysqlpassword);

			if(!con) {
				die ("could not connect: ".mysql_error());
			}

			mysql_select_db($mysqldbname, $con);

			$login_username = $_POST['loginusername'];
			$login_password = $_POST['loginpassword'];

			$login_username = mysql_real_escape_string($login_username);
			$login_password = mysql_real_escape_string($login_password);

			$loginsql = "SELECT UserName, UserPassword FROM user 
			WHERE UserName = '$login_username' and UserPassword = '$login_password'";

			$loginresult = mysql_query($loginsql);

			if(mysql_num_rows($loginresult) == 1) {
				$loginLogsql = "INSERT INTO loginlog (UserName, LoginTime)
				VALUES ('$login_username', now());";
				mysql_query($loginLogsql);

				$_SESSION['is_login'] = true;
				$_SESSION['nickname'] = $login_username;
				header("location: main.php");
			} else {
				$_SESSION['is_login'] = false;
				echo "You typed in Wrong ID or Password.";
				echo "<br><br>";
				echo "Please go back to the Login page and try again!";
			}

			mysql_close($con);

		

		?>
		<br><br>
			<button onClick = "window.location.href = 'login.php'">
				Back to Login page</button>
		


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
