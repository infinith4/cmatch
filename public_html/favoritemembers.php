<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />

<title>お気に入り</title>
<!-- 全ページ共通start-->
<link rel="shortcut icon" href="img/icon06.ico" type="image/vnd.microsoft.icon">
<!-- 全ページ共通end-->

</head>

<body>
<?php
session_start();
//session_regenerate_id(TRUE);

require('dbconnect.php');
?>
<?php

$tablename="favorite".$_SESSION[memberid];

    	

?>

<div align="center">
    	<?php
    	$n=0;
    	$recordfav=mysql_query("SELECT * FROM $tablename");
    	
		while($tablefav=mysql_fetch_assoc($recordfav)){
			
			$recordpro=mysql_query("SELECT * FROM profiles WHERE (memberid='{$tablefav[favmemberid]}')");
			$tablepro=mysql_fetch_assoc($recordpro);
			
			
			//print("<td>".$tablepro[handle]."</td>");
			$membersid[]=$tablefav[favmemberid];
			$membershan[]=$tablepro[handle];
			//print_r($membersid);
			$n++;
			
			
		}
		print("<b>お気に入りと友人</b><br><br>");
		print($n."人<br><br>");
		$row=$n%5;
		//print($row."行<br>");
		//print("<table border='1'><tr>");
		$i=0;
		
		while($i<$n){
			
			
			//print("i:".$i);
			if($i %5===0){
			?>
			
			<a href="membersclass.php?membersid=<?php print($membersid[$i]); ?>" target='_blank'><?php print($membershan[$i])?></a>
			
			<?php	
			}elseif($i %5===4){
			?>	
			<a href="membersclass.php?membersid=<?php print($membersid[$i]); ?>" target='_blank'><?php print($membershan[$i])?></a>
			<br>
				
			<?php	
				
			}else{
			?>	
			<a href="membersclass.php?membersid=<?php print($membersid[$i]); ?>" target='_blank'><?php print($membershan[$i])?></a>
			
			<?php	
				
			}
			$i++;
		}
	
    		
    	?>

</body>

</html>