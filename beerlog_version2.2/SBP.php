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
	
	<div class = "container-fluid" id = "SBPsection" style = "min-height: 600px;">
		<h3 style = "text-align: center">Search all the comments by pub name! <span class = 'glyphicon glyphicon-cutlery'></span></h3> 
			<br><br>

		<div class = "container-fluid">
		<form role = "form" method = "post">
		<div class = "col-sm-12">
			<?php
				include 'connection.php';
			?>
			<p class = "text-danger"><strong>Updated list of pubs:</strong></p>
			<div class = "form-group">
				<label for = "SBPList">Select the pub: </label><p></p>
					<?php
						if (isset($_POST['SBPButton'])) {
							$SBPName = $_POST['SBPList'];
						}
							$PubList = "SELECT DISTINCT PubName FROM records ORDER BY PubName";
							$Pubresult = mysql_query($PubList);

							echo "<select class = 'form-control input-sm' id = 'SBPList' name = 'SBPList'>
							<option>Pub List</option>";
						
							while($Pubrow = mysql_fetch_assoc($Pubresult)) {
								echo
								"<option>{$Pubrow['PubName']}</option>";
							}
							echo "</select>";
							mysql_free_result($Pubresult);
							mysql_close($con);
					?>
				<p></p>
				<button type = "submit" id = "SBPButton" name = "SBPButton" class = "btn btn-success btn-sm btn-block" disabled>Search</button><br>
			</div>
		</div>
		</form>
		</div>
			
	<?php
		if (isset($_POST['SBPButton'])) {
			include 'connection.php';
	//connection completed
			
			$PubSearchList = "SELECT * FROM records WHERE PubName = '$SBPName'
							ORDER BY VisitingDate DESC, PostedTime DESC";

			$PubSearchresult = mysql_query($PubSearchList);

		echo
		'<div class = "table-responsive">
			<table class = "table-striped table-condensed" style = "text-align: center; width: 100%">
				<tr>
					<th>User ID</th>
					<th>City</th>
					<th>Visiting Date</th>
					<th>Beer Name</th>
					<th>Comments</th>
				</tr>';

			while($PubSearchrow = mysql_fetch_assoc($PubSearchresult)) {
							echo
							"<tr>
							<td>
							{$PubSearchrow['UserName']}</td>
							<td>
							{$PubSearchrow['City']}</td>
							<td>
							{$PubSearchrow['VisitingDate']}</td>
							<td>
							{$PubSearchrow['Beer']}</td>
							<td>
							{$PubSearchrow['Comments']}</td>
							</tr>";
						}
						
						
						mysql_free_result($PubSearchresult);
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
document.getElementById("SBPsection").onload = SBPlistFunction();
function SBPlistFunction() {
	document.getElementById("SBPList").onchange = function() {
		if (document.getElementById("SBPList").value == "Pub List") {
		document.getElementById("SBPButton").disabled = true;
	} else {
		document.getElementById("SBPButton").disabled = false;
		}
	}
}
</script>	
</body>
</html>
