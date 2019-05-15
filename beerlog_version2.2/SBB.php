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
	
	<div class = "container-fluid" id = "SBBsection" style = "min-height: 600px;">
		<h3 style = "text-align: center">Search all the comments by  your beer name!</h3> 
		<br><br>
		
		<div class = "container-fluid">	

		<form role = "form" method = "post">
		<div class = "col-sm-6">
			<?php
				include 'connection.php';
			?>
			<p class = "text-danger"><strong>Updated list of beers:</strong></p>
			<div class = "form-group">
				<label for = "SBBList">Select the Beer name: </label><p></p>
					<?php
						$BeerList = "SELECT DISTINCT Beer FROM records ORDER BY Beer";
						$Beerresult = mysql_query($BeerList);

						echo "<select class = 'form-control input-sm' id = 'SBBList' name = 'SBBList'>
						<option>Beer Card List</option>";
					
						while($Beerrow = mysql_fetch_assoc($Beerresult)) {
							echo
							"<option>{$Beerrow['Beer']}</option>";
						}
						echo "</select>";
						mysql_free_result($Beerresult);
						mysql_close($con);
					?>
				<p></p>
				<button type = "submit" id = "SBBButton" name = "SBBButton" 
			class = "btn btn-success btn-sm btn-block" disabled>Search</button><br>
			</div>
		</div>
		</form>	

		<div class = "col-sm-6">
			<div class = "container-fluid">
				<div class = "well">
					<div>
						<p style = "text-align: right"><strong><span class = 'glyphicon glyphicon-heart'></span> Beer Card</strong></p>
						<hr>
					</div>
		<?php 
			if (isset($_POST['SBBButton'])) {
				include 'connection.php';
				$SBBName = $_POST['SBBList'];

				$checkingBeerCard = "SELECT NameOfBeer FROM beertypetable WHERE NameOfBeer = '$SBBName'";
				$checkingBeerCardresult = mysql_query($checkingBeerCard);

				if(mysql_num_rows($checkingBeerCardresult) > 0) {
					$SBBAlcoholList = "SELECT AlcoholOfBeer FROM beertypetable 
			 					WHERE NameOfBeer = '$SBBName'";
				 	$SBBAlcoholResult = mysql_query($SBBAlcoholList);
				 	$SBBAlcohol = mysql_result($SBBAlcoholResult, 0);

				 	$SBBOrginList = "SELECT OrginOfBeer FROM beertypetable 
				 					WHERE NameOfBeer = '$SBBName'";
				 	$SBBOrginResult = mysql_query($SBBOrginList);
				 	$SBBOrgin = mysql_result($SBBOrginResult, 0);
				 	
				 	$SBBLogoList = "SELECT Logo FROM beertypetable 
				 					WHERE NameOfBeer = '$SBBName'";
				 	$SBBLogoResult = mysql_query($SBBLogoList);
				 	$SBBLogo = mysql_result($SBBLogoResult, 0);

				 	$SBBIntroducedList = "SELECT Introduced FROM beertypetable 
				 					WHERE NameOfBeer = '$SBBName'";
				 	$SBBIntroducedResult = mysql_query($SBBIntroducedList);
				 	$SBBIntroduced = mysql_result($SBBIntroducedResult, 0);

				} else {
					$SBBAlcohol = "not available";
					$SBBOrgin = "not available";
					$SBBLogo = "images/beerlogo/NotAvailable.jpg";
					$SBBIntroduced = "not available";
				}


				echo "<p class = 'lead' style = 'text-align: center'>"."<strong>".
				$SBBName."</strong>"."</p>";
				echo "Alcohol: "."<strong>".$SBBAlcohol."</strong>";
				echo "<br>";
				echo "Country of Orgin: "."<strong>".$SBBOrgin."</strong>";
				echo "<br>";
				echo "Introduced in: "."<strong>".$SBBIntroduced."</strong>";
				echo "<p></p>";
				echo "<div id = 'logoimage'>";
			 	echo "<img class = 'img-thumbnail' src =".$SBBLogo." 
			 	alt = ".$SBBName."></div>";

				mysql_close($con);

			}
		?>
		<p></p>
				</div>
			</div>
		</div>
	</div>
	<?php
		if (isset($_POST['SBBButton'])) {
			include 'connection.php';
			//connection completed
					$BeerSearchList = "SELECT * FROM records WHERE Beer = '$SBBName'
		 						ORDER BY VisitingDate DESC, PostedTime DESC";

					$BeerSearchresult = mysql_query($BeerSearchList);

			echo
			'<div class = "table-responsive">
				<table class = "table-striped table-condensed" style = "text-align: center; width: 100%">
					<tr>
						<th>User ID</th>
						<th>City</th>
						<th>Pub Name</th>
						<th>Visiting Date</th>
						<th>Comments</th>
					</tr>';

			while($BeerSearchrow = mysql_fetch_assoc($BeerSearchresult)) {
							echo
							"<tr>
							<td>
							{$BeerSearchrow['UserName']}</td>
							<td>
							{$BeerSearchrow['City']}</td>
							<td>
							{$BeerSearchrow['PubName']}</td>
							<td>
							{$BeerSearchrow['VisitingDate']}</td>
							<td>
							{$BeerSearchrow['Comments']}</td>
							</tr>";
						}
						
						
						mysql_free_result($BeerSearchresult);
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
document.getElementById("SBBsection").onload = SBBlistFunction();
function SBBlistFunction() {
	document.getElementById("SBBList").onchange = function() {
		if (document.getElementById("SBBList").value == "Beer Card List") {
		document.getElementById("SBBButton").disabled = true;
	} else {
		document.getElementById("SBBButton").disabled = false;
		}
	}
}
</script>
</body>
</html>
