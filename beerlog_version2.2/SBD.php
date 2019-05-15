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
	
	<div class = "container-fluid" id = "SBDsection" style = "min-height: 600px;">
		<h3 style = "text-align: center">Search all the comments by date! <span class = 'glyphicon glyphicon-calendar'></span></h3> 
			<br><br>

		<div class = "container-fluid">
		<form role = "form" method = "post">
		<div class = "col-sm-6">
			<div class = "form-group">
				<label for = "DateFrom">From:</label>
				<input type = 'date' class = 'form-control input-sm' id = 'DateFrom' name = 'DateFrom' value = "<?php echo date('Y-m-d'); ?>" required>
			</div>
		</div>
		<div class = "col-sm-6">
			<div class = "form-group">
				<label for = "DateTo">To:</label>
				<input type = 'date' class = 'form-control input-sm' id = 'DateTo' name = 'DateTo' value = "<?php echo date('Y-m-d'); ?>" required>
			</div>
		</div>
		<div class = "col-sm-12">
			<button type = "submit" id = "SBDButton" name = "SBDButton" class = "btn btn-success btn-sm btn-block">Search</button><br>
		</div>
		</form>
	</div>


	<?php
		if (isset($_POST['SBDButton'])) {
		$SBDFrom = $_POST['DateFrom'];
		$SBDTo = $_POST['DateTo'];
	
		if ($SBDFrom > $SBDTo) {
			echo "<script>alert('To date must be the same or later than From date')</script>";
		} elseif ($SBDFrom == $SBDTo) {
			echo "on <span class = 'text-danger'><strong>".$SBDFrom."</strong></span>";
		} else {
			echo "<strong>".$SBDFrom."</strong>"." to "."<strong>".$SBDTo."</strong>";
		}
	}
	?>
	
	<?php
		if (isset($_POST['SBDButton'])) {
			include 'connection.php';
	//connection completed
			if ($SBDFrom > $SBDTo) {
				echo "<strong>no data available</strong><br><br>";
			} elseif ($SBDFrom == $SBDTo) {
				$DateSearchList = "SELECT * FROM records WHERE VisitingDate = '$SBDFrom'
	 						ORDER BY VisitingDate DESC, PostedTime DESC";
				$DateSearchresult = mysql_query($DateSearchList);
			} else {
				$DateSearchList = "SELECT * FROM records WHERE cast(VisitingDate AS DATE) BETWEEN '$SBDFrom' and '$SBDTo' ORDER BY VisitingDate DESC, PostedTime DESC";
				$DateSearchresult = mysql_query($DateSearchList);
			}
			
			echo
			'<br><br><div class = "table-responsive">
			<table class = "table-striped table-condensed" style = "text-align: center; width: 100%">
				<tr>
					<th>User ID</th>
					<th>City</th>
					<th>Visiting Date</th>
					<th>Beer Name</th>
					<th>Comments</th>
				</tr>';
				
					
					while($DateSearchrow = mysql_fetch_assoc($DateSearchresult)) {
						echo
						"<tr>
						<td>
						{$DateSearchrow['UserName']}</td>
						<td>
						{$DateSearchrow['City']}</td>
						<td>
						{$DateSearchrow['VisitingDate']}</td>
						<td>
						{$DateSearchrow['Beer']}</td>
						<td>
						{$DateSearchrow['Comments']}</td>
						</tr>";
					}
					
					
					mysql_free_result($DateSearchresult);
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


</div><!--for main-->

</body>
</html>