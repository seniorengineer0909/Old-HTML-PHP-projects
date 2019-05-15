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
	<?php
		include 'header.php';
	?>
	
		<div class = "container-fluid" id = "postprocesssection" style = "min-height: 600px;">

			<?php
				session_start();

				include 'connection.php';

				$post_user = $_SESSION['nickname'];

				if($_POST['CityList'] === 'Not on the list? Please type') {
					$post_city = $_POST['CityNotOnList'];
					} else {
						$post_city = $_POST['CityList'];
					}
				if($_POST['PubList'] === 'Not on the list? Please type') {
					$post_pub = $_POST['PubNotOnList'];
					} else {
						$post_pub = $_POST['PubList'];
					}

				$post_vd = $_POST['vdate'];

				if($_POST['BeerList'] === 'Not on the list? Please type') {
					$post_beer = $_POST['BeerNotOnList'];
					} else {
						$post_beer = $_POST['BeerList'];
					}

				$post_comment = $_POST['Comments'];

				$post_city = mysql_real_escape_string($post_city);
				$post_pub = mysql_real_escape_string($post_pub);
				$post_vd = mysql_real_escape_string($post_vd);
				$post_beer = mysql_real_escape_string($post_beer);
				$post_comment = mysql_real_escape_string($post_comment);

				if(!isset($_POST['BeerList'])) {
					header("location: home.php");
				} else {

					$postprocessing = "INSERT INTO records  
					VALUES (null, '$post_user', '$post_city','$post_pub','$post_vd','$post_beer','$post_comment', now());";

					mysql_query($postprocessing);
					

					echo "<br>";
					echo "<h3 style = 'text-align: center'><span class = 'glyphicon glyphicon-ok'></span> Thank you "."<strong>".$post_user."!</strong>"."</h3>";
					echo "<h4 style = 'text-align: center'>Your post is successfully posted 
					<span class = 'glyphicon glyphicon-thumbs-up'></span></h4>";

					$TotalCommentCountList = "SELECT COUNT(UserName) from records";
				 	$TotalCommentCountResult = mysql_query($TotalCommentCountList);
				 	$TotalCommentCount = mysql_result($TotalCommentCountResult, 0);

					echo "<h4 style = 'text-align: center'><span class = 'bg-warning'>
					Total post at OurBeerLog.com</span> <span class = 'badge'>".
					$TotalCommentCount."</span></h4><br>";

					mysql_close($con);

				}
			?>
			<br><br>
			<div class = "container-fluid">
				<div class = "col-sm-6">
					<button type = "button" class = "btn btn-success btn-block btn-lg" 
					onclick = "window.location.href = 'post.php'">
						<span class = "glyphicon glyphicon-file"></span> Post one more!
					</button>		
				<br>
				</div>
				
				<div class = "col-sm-6">
					<button type = "button" class = "btn btn-warning btn-block btn-lg"
					onclick = "window.location.href = 'home.php'">
						<span class = "glyphicon glyphicon-home"></span> Back to Home
					</button>	
				</div>
				<div class = "col-sm-12">
					 <div class="alert alert-danger fade in">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Note: </strong> Duplicated comments are automatically rejected by the database.
				  	</div>
				</div>

				</div>
			</div>
		<div id = "webfoot">
			<?php
				include('footer.php');
			?>
		</div>
	</div>
	</div>
</body>
</html>
