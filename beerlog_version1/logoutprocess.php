<?php
	session_start();
	if(!isset($_SESSION['is_login'])) {
		header("location: login.php");
	} 
?>

<html>
<?php
ini_set("display_errors", "1");
session_start();
session_destroy();
header("location: login.php");
?>
</html>