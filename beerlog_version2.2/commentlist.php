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
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  	<script language = "javascript" type = "text/javascript" src = "beerlogscript.js"></script>

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<link rel = "stylesheet" type = "text/css" href = "beerlogstyle.css">

	
</head>

<body>
<div id = "main" class = "container">
	<?php
		include 'header.php';
	?>	
	<div class = "container-fluid" id = "Listsection">
		<h2 style = "text-align: center">Entire list of beer comments</h2> 
		
			
		<?php
		include 'connection.php';
		?>
		
			
			<?php
				$EntireList = "SELECT * FROM records order by VisitingDate DESC, PostedTime DESC";

				$Entireresult = mysql_query($EntireList);
			?>
						
				<br><br>
				<div class = "table-responsive">
				<table class = "table-striped table-condensed" style = "text-align: center; width: 100%">
					<tr>
						<th>User ID</th>
						<th>City</th>
						<th>Pub</th>
						<th>Visiting Date</th>
						<th>Beer</th>
						<th>Comments</th>
						
					</tr>
					<?php
						while($Entirerow = mysql_fetch_assoc($Entireresult)) {
							echo
							"<tr>
							<td>
							{$Entirerow['UserName']}</td>
							<td>
							{$Entirerow['City']}</td>
							<td>
							{$Entirerow['PubName']}</td>
							<td>
							{$Entirerow['VisitingDate']}</td>
							<td>
							{$Entirerow['Beer']}</td>
							<td>
							{$Entirerow['Comments']}</td>
							</tr>";
						}
						
						mysql_free_result($Entireresult);
						mysql_close($con);
					?>
					</table>
				</div>

		
<br><br>
	</div>
		<div id = "webfoot">
			<?php
				include('footer.php');
			?>
		</div>
		
</div>


</body>
<script>
var TInt = setInterval(function(){changeFunction()}, 1000);
function changeFunction() {
	var x = document.getElementById("dt");
	x.innerHTML = new Date().toLocaleTimeString();
	x.style.color = "black";
}
</script>
</html>
