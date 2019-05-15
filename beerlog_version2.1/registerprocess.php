<?php
	session_start();
	if(!isset($_SESSION['is_login'])) {
		header("location: index.php");
	} 
?>

<?php
	session_start();

	include 'connection.php';

	$register_username = $_POST['RegisterName'];
	$register_ID = $_POST['RegisterID'];
	$register_Email = $_POST['RegisterEmail'];
	$register_password = $_POST['RegisterPassword'];
	$register_password_repeat = $_POST['RegisterPasswordRepeat'];

	$register_username = mysql_real_escape_string($register_username);
	$register_ID = mysql_real_escape_string($register_ID);
	$register_Email = mysql_real_escape_string($register_Email);
	$register_password = mysql_real_escape_string($register_password);
	$register_password_repeat = mysql_real_escape_string($register_password_repeat);

	$checkinguserID = "SELECT UserName FROM user WHERE UserName = '$register_ID'";
	$checkinguserIDresult = mysql_query($checkinguserID);

	if(!isset($_POST['RegisterName'])) {
		$_SESSION['is_login'] = false;
		$_SESSION['is_confirmed'] = false;
		$_SESSION['is_not_confirmed'] = false;
		header("location: index.php");
	} elseif(mysql_num_rows($checkinguserIDresult) > 0) {
		$_SESSION['is_existing'] = true;
		header("location: register.php");

	} elseif($register_password == $register_password_repeat) {
		$registersql = "INSERT INTO user (Name, UserName, UserPassword, DateOfRegistration, Email) 
		VALUES ('$register_username','$register_ID','$register_password',now(), '$register_Email');";
		mysql_query($registersql);

		$_SESSION['is_login'] = false;
		$_SESSION['is_confirmed'] = true;
		header("location: index.php");
	} else {
		$_SESSION['is_login'] = false;
		$_SESSION['is_confirmed'] = false;
		$_SESSION['is_not_confirmed'] = true;
		header("location: register.php");
	} 
	
	mysql_close($con);
?>