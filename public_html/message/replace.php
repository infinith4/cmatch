<html>
<head>
</head>
<body>
<TEXTAREA cols="70" rows="17" name="message">
<?php

require('../dbconnect.php');

$tablename="messages38441084ed583b80295d";

$replyid="7192974ed6e40ae68248.36976664";

	$recordrep=mysql_query("SELECT * FROM $tablename WHERE (id='{$replyid}')");

	$tablerep=mysql_fetch_assoc($recordrep);
	
	
	//$message="test<br>test<br><br>test";		    	
	$mes="> ".str_replace("<br>", "\n> ", $tablerep[message]);
	//$mes = preg_replace('/\s\s+/', ' ', $mes);
	//$mes=preg_replace("/<br>/", "\n>", $tablerep[message]);
	//$mes = preg_replace('/\s\s+/', ' ', $mes);
	
	print($mes);
?>

</TEXTAREA>
<br><br>
<?php
	print("mes:<br><br>".$mes);
?>
</body>
</html>
