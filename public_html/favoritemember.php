<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />

<title>お気に入り登録</title>
<!-- 全ページ共通start-->
<link rel="shortcut icon" href="img/icon06.ico" type="image/vnd.microsoft.icon">
<!-- 全ページ共通end-->

</head>

<body>
<?php
session_start();

require('dbconnect.php');


$membersid=$_REQUEST[membersid];
$tablename="favorite".$_SESSION[memberid];
$recordpro=mysql_query("SELECT * FROM profiles WHERE (memberid='{$membersid}')");
$tablepro=mysql_fetch_assoc($recordpro);
?>

<div align="center">
      <?php
      	$tablename="favorite".$_SESSION[memberid];
      	
	$recordfav=mysql_query("SELECT * FROM $tablename WHERE favmemberid='{$membersid}'");
	$tablefav =mysql_fetch_assoc($recordfav);

	print("<h4>".$tablepro[handle]."さんをお気に入りに加える</h4>");
	
    	?>
    	
	<form method="POST" action="submitfavoritemember.php">
	
	<input type="hidden" name="favmemberid" value="<?php print($membersid); ?>">
	<?php
	if(!empty($table)){
		if($tablefav[favorite]==='1'){
			print("<input type='checkbox' name='favorite' value='1' checked>");
		
		}else{
			
			print("<input type='checkbox' name='favorite' value='1'>");
		}
	}else{
		print("<input type='checkbox' name='favorite' value='1' checked>");
	
	}
	?>
	お気に入りに加える<br>
	
	
	<?php
	if($tablefav[friend]==='1'){
		print("<input type='checkbox' name='friend' value='1' checked>");
	
	}else{
		
		print("<input type='checkbox' name='friend' value='1'>");
	}
	?>
	友人として加える<br>
	(リクエストメッセージが<?php print($tablepro[handle]."さん<br>");?>に送信されます)<br><br>
	<a href="classmembers.php?code=<?php print($_SESSION[code]."&selclass=".$_SESSION[selclass]);?>">
	戻る</a>
	
	<?php
	if(!empty($tablefav)){
		print("<input type='submit' name='subjectreg' value='修正'>");
	
	}else{
		
		print("<input type='submit' name='subjectreg' value='追加'>");
	}
	?>
	
	
	</form>

</body>

</html>