<!doctype html>
<html>
<head>
	<title>토여클 blog</title>

<!--css link-->
	<link rel = "stylesheet" type = "text/css" href = "ttcstyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--css link-->
<!--js link-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
	<script language = "javascript" type = "text/javascript" src = "ttcscript.js"></script>
<!--js link-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset = "utf-8">
</head>

<body>
	<?php include 'header.php' ?>

	<div class = "row">
		<div class = "container">
			<div class = "col s12 m4 center-align hoverable">
				<h4>Friends</h4>
				<i class="large material-icons">face</i>
			</div>
			<div class = "col s12 m4 center-align hoverable">
				<h4>Place</h4>
				<i class="large material-icons">place</i>
			</div>
			<div class = "col s12 m4 center-align hoverable">
				<h4>Transit</h4>
				<i class="large material-icons">directions_transit</i>
			</div>
			<div class = "col s12 center-align">
				<h3>THAT SIMPLE</h3>
			</div>
		</div>
	</div>

	<div class = "row">
		<div class = "container z-depth-2">
			<br>
			<div class = "container">
			<h5>Maybe,</h5>
			<h5>travelling is not that special</h5>
			<hr>
			<p>Let us just go out and see</p>
			<p>Does not have to be something big</p>
			<p><span style = "color: #c62828">New</span> mind, <span style = "color: #c62828">New</span> eyes, <span style = "color: #c62828">New</span> experience</p>
			<p class = "right-align">No more "next time"</p>
			<p class = "right-align">Tomorrow is too late</p>
			<p class = "right-align">Enrich your day</p>	
			</div>
			<br>
		</div>
	</div><br>
<!--slider-->
	<div class = "container">
		<div class = "container">
			<div class="slider">
			    <ul class="slides">
			      <li>
			        <img src="images/toronto1.jpg"> 
			        <div class="caption center-align">
			          <h3>It is out there!</h3>
			          <h5 class="light grey-text text-lighten-3">It is right where you are.</h5>
			        </div>
			      </li>
			      <li>
			        <img src="images/toronto2.jpg"> 
			        <div class="caption left-align">
			          <h3>Step out!</h3>
			          <h5 class="light grey-text text-lighten-3">Things are around you.</h5>
			        </div>
			      </li>
			      <li>
			        <img src="images/toronto3.jpg"> 
			        <div class="caption right-align">
			          <h3>Nothing is boring</h3>
			          <h5 class="light grey-text text-lighten-3">See it in a brand new way.</h5>
			        </div>
			      </li>
			      <li>
			        <img src="images/toronto4.jpg"> 
			        <div class="caption center-align">
			          <h3>This is our big playground!</h3>
			          <h5 class="light grey-text text-lighten-3">Still much to experience here.</h5>
			        </div>
			      </li>
			    </ul>
	  		</div>
  		</div>
	</div>
	<?php include 'footer.php' ?>

<!--action button-->
	<?php include 'actionbtn.php' ?>


</body>
</html>