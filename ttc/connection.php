<?php
	$mysqlservername = "localhost";//mysql3.000webhost.com";//localhost
	$mysqlusername = "root";//a1634686_root";//root
	$mysqlpassword = "choi0206";
	$mysqldbname = "ttc";//a1634686_beerlog";//beerlog

	$con = mysql_connect($mysqlservername, $mysqlusername, $mysqlpassword);

	if(!con) {
		die ("could not connect: ".mysql_error());
	}
	mysql_select_db($mysqldbname, $con);
?>