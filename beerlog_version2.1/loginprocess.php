<?php
	session_start();
	if(!isset($_SESSION['is_login'])) {
		header("location: index.php");
	} 
	session_destroy();
?>

<?php
	session_start();

	include 'connection.php';

	$GLOBALS['Gusername'] = $_POST['LoginID'];
	$login_username = $_POST['LoginID'];
	$login_password = $_POST['LoginPassword'];

	$login_username = mysql_real_escape_string($login_username);
	$login_password = mysql_real_escape_string($login_password);

	$loginsql = "SELECT UserName, UserPassword FROM user 
	WHERE UserName = '$login_username' and UserPassword = '$login_password'";

	$loginresult = mysql_query($loginsql);

	if(!isset($_POST['LoginID']) || !isset($_POST['LoginPassword'])) {
		$_SESSION['is_login'] = false;
		$_SESSION['is_failed'] = false;
		header("location: index.php");
	} elseif (mysql_num_rows($loginresult) == 1) {
		$loginLogsql = "INSERT INTO loginlog (UserName, LoginTime)
		VALUES ('$login_username', now());";
		mysql_query($loginLogsql);

		$_SESSION['is_login'] = true;
		$_SESSION['nickname'] = $login_username;
		header("location: home.php");

		//NOW HERE*************************************************
	} else {
		$_SESSION['is_login'] = false;
		$_SESSION['is_failed'] = true;
		header("location: index.php");
	}


	
	mysql_close($con);
?>