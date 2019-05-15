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
	<?php
		include 'header.php';
	?>
	
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
						<p style = "text-align: right"><strong><span class = 'glyphicon glyphicon-user'></span> User Card</strong></p>
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
	<?php
		if (isset($_POST['SBUButton'])) {
			include 'connection.php';
	//connection completed
			$UserSearchList = "SELECT * FROM records WHERE UserName = '$SBUName'
							ORDER BY VisitingDate DESC, PostedTime DESC";

			$UserSearchresult = mysql_query($UserSearchList);
		
		echo
		'<div class = "table-responsive">
		<table class = "table-striped table-condensed" style = "text-align: center; width: 100%">
			<tr>
				<th>City</th>
				<th>Pub Name</th>
				<th>Visiting Date</th>
				<th>Beer Name</th>
				<th>Comments</th>
			</tr>';
			
		
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
			echo '</table><br></div>';
		}
	?>
			
	</div>
			<div id = "webfoot">
				<?php
					include('footer.php');
				?>
			</div>
			
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
