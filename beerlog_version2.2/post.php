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
	
	<div class = "container-fluid" id = "postsection" style = "min-height: 600px;">
		<h3 style = "text-align: center"><span class = "text-warning">Post</span> and
		 <span class = "text-danger">share</span> your beer experience</h3> 
			<br><br>
		<div class = "container-fluid">
		<form role = "form" method = "post" action = "postprocess.php">
		<div class = "col-sm-6">
			<div class = "form-group">
				<label for = "CityList">City:</label>
				<?php
					$PostCityList = "SELECT CityName FROM city ORDER BY CityName";
					$PostCityresult = mysql_query($PostCityList);

					if(mysql_num_rows($PostCityresult) == 0) {
						echo "no data found";
						exit;
					}
				
					echo "<select class = 'form-control input-sm' id = 'CityList' name = 'CityList' required>
					<option>Not on the list? Please type</option>";
				
					while($PostCityrow = mysql_fetch_assoc($PostCityresult)) {
						echo
						"<option>{$PostCityrow['CityName']}</option>";
					}
					echo "</select>";
					mysql_free_result($PostCityresult);
				?><p></p>
				<input type = "text" class = "form-control input-sm" name = "CityNotOnList" id = "CityNotOnList" 
				placeholder = "Type City not on the list" maxlength = "30" required>
			</div>
			<div class = "form-group">
				<label for = "PubList">Pub:</label>
				<?php
					$PostPubList = "SELECT PubName FROM pub ORDER BY PubName";
					$PostPubresult = mysql_query($PostPubList);

					if(mysql_num_rows($PostPubresult) == 0) {
						echo "no data found";
						exit;
					}
				
					echo "<select class = 'form-control input-sm' id = 'PubList' name = 'PubList' required>
					<option>Not on the list? Please type</option>";
				
					while($PostPubrow = mysql_fetch_assoc($PostPubresult)) {
						echo
						"<option>{$PostPubrow['PubName']}</option>";
					}
					echo "</select>";
					mysql_free_result($PostPubresult);
				?><p></p>
				<input type = "text" class = "form-control input-sm" name = "PubNotOnList" id = "PubNotOnList" 
				placeholder = "Type Pub not on the list" maxlength = "30" required>
			</div>
			<div class = "form-group">
				<label for = "vdate">Visiting date:</label>
				<input type = "date" class = "form-control" id = "vdate" name = "vdate" value = "<?php echo date('Y-m-d'); ?>" required>
			</div>
			<div class = "form-group">
				<label for = "BeerList">Beer:</label>
				<?php
					$PostBeerList = "SELECT NameOfBeer FROM beertypetable ORDER BY NameOfBeer";
					$PostBeerresult = mysql_query($PostBeerList);

					if(mysql_num_rows($PostBeerresult) == 0) {
						echo "no data found";
						exit;
					}
				
					echo "<select class = 'form-control input-sm' id = 'BeerList' name = 'BeerList' required>
					<option>Not on the list? Please type</option>";
				
					while($PostBeerrow = mysql_fetch_assoc($PostBeerresult)) {
						echo
						"<option>{$PostBeerrow['NameOfBeer']}</option>";
					}
					echo "</select>";
					mysql_free_result($PostBeerresult);
				?><p></p>
				<input type = "text" class = "form-control input-sm" name = "BeerNotOnList" id = "BeerNotOnList" 
				placeholder = "Type Beer name not on the list" maxlength = "30" required>
			</div>
			
		</div>		

		<div class = "col-sm-6">
			<form role = "form" method = "post" action = "postprocess.php">
			<div class = "form-group">
				<label for = "Comments">Comments:</label>
				<textarea class = "form-control input-sm" name = "Comments" id = "Comments" 
				rows = "10" maxlength = "255" required></textarea>
			</div>
			 <div class="alert alert-danger fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Note: </strong> Duplicated comments are automatically rejected by the database.
		  	</div>
			<div class = "text-right">
				<button type = "submit" class = "btn btn-default">
					<span class = "glyphicon glyphicon-pencil"></span>
					<a style = "text-decoration: none" data-toggle = "tooltip" data-placement = "auto" title = "Press me!"> 
						Post
					</a>
				</button>
			</div>
			</form>
<br><br>

		</div>
		</form>
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
<script>
document.getElementById("postsection").onload = citylistFunction(), publistFunction(), beerlistFunction();
function citylistFunction() {
	document.getElementById("CityList").onchange = function() {
		if (document.getElementById("CityList").value !== "Not on the list? Please type") {
		document.getElementById("CityNotOnList").disabled = true;
	} else {
		document.getElementById("CityNotOnList").disabled = false;
		}
	}
}
function publistFunction() {
	document.getElementById("PubList").onchange = function() {
		if (document.getElementById("PubList").value !== "Not on the list? Please type") {
		document.getElementById("PubNotOnList").disabled = true;
	} else {
		document.getElementById("PubNotOnList").disabled = false;
		}
	}
}
function beerlistFunction() {
	document.getElementById("BeerList").onchange = function() {
		if (document.getElementById("BeerList").value !== "Not on the list? Please type") {
		document.getElementById("BeerNotOnList").disabled = true;
	} else {
		document.getElementById("BeerNotOnList").disabled = false;
		}
	}
}


</script>
</html>
