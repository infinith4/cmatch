<?php

	$DBSERVER="localhost";
	$DBUSER="cmatch";
	$DBPASSWORD=""; #非公開
	$DBNAME="cmatch";


	$con=mysql_connect($DBSERVER,$DBUSER,$DBPASSWORD);

	
	mysql_query("set names utf8");
	
	
	$selectdb=mysql_select_db($DBNAME);
	

?>




