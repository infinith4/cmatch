<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php

require('../dbconnect.php');
//print("<br>dbconnect success.<br>");


session_start();

if (!empty($_POST)) {
	// 登録処理をする
	$sql = sprintf("INSERT INTO profiles SET memberid='%s',handle='%s', department='%s', concentration='%s', course='%s',yearly='%s',message='%s',sex='%s',companyfriendship='%s',place='%s',interact='%s',sns='%s',created='%s',modified='%s'",
		mysql_real_escape_string($_SESSION[memberid]),
		mysql_real_escape_string($_SESSION['join']['handle']),
		mysql_real_escape_string($_SESSION['join']['department']),
		mysql_real_escape_string($_SESSION['join']['concentration']),
		mysql_real_escape_string($_SESSION['join']['course']),
		mysql_real_escape_string($_SESSION['join']['yearly']),
		mysql_real_escape_string($_SESSION['join']['message']),
		mysql_real_escape_string($_SESSION['join']['sex']),
		mysql_real_escape_string($_SESSION['join']['companyfriendship']),
		mysql_real_escape_string($_SESSION['join']['place']),
		mysql_real_escape_string($_SESSION['join']['interact']),
		mysql_real_escape_string($_SESSION['join']['sns']),
		date('Y-m-d H:i:s'),
		date('Y-m-d H:i:s')
	);
	mysql_query($sql) or die(mysql_error());
	unset($_SESSION['join']);
	header('Location: thanks.php'); exit();
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="../style.css" />
<title>会員登録</title>
</head>


<body>
<form action="" method="post" >
	
		ハンドルネーム：<?php print(htmlspecialchars($_SESSION['join']['handle'])); ?> 
		<input type="hidden" name="handle" value="<?php echo htmlspecialchars($_SESSION['join']['handle']); ?>" />
		<br>
		学部：<?php print(htmlspecialchars($_SESSION['join']['department'])); ?> 
		<input type="hidden" name="department" value="<?php echo htmlspecialchars($_SESSION['join']['department']); ?>" />
		<br>
		学科：<?php print(htmlspecialchars($_SESSION['join']['concentration'])); ?> 
		<input type="hidden" name="concentration" value="<?php echo htmlspecialchars($_SESSION['join']['concentration']); ?>" />
		<br>
		コース：<?php print(htmlspecialchars($_SESSION['join']['course'])); ?> 
		<input type="hidden" name="course" value="<?php echo htmlspecialchars($_SESSION['join']['course']); ?>" />
		<br>
		回生：<?php print(htmlspecialchars($_SESSION['join']['yearly'])); ?> 
		<input type="hidden" name="yearly" value="<?php echo htmlspecialchars($_SESSION['join']['yearly']); ?>" />
		<br>
		紹介文：<?php print(htmlspecialchars($_SESSION['join']['message'])); ?> 
		<input type="hidden" name="message" value="<?php echo htmlspecialchars($_SESSION['join']['message']); ?>" />
		<br>
		性別：<?php print(htmlspecialchars($_SESSION['join']['sex'])); ?> 
		<input type="hidden" name="sex" value="<?php echo htmlspecialchars($_SESSION['join']['sex']); ?>" />
		<br>
		交際ステータス：<?php print(htmlspecialchars($_SESSION['join']['companyfriendship'])); ?> 
		<input type="hidden" name="companyfriendship" value="<?php echo htmlspecialchars($_SESSION['join']['companyfriendship']); ?>" />
		<br>
		よく出没する場所：<?php print(htmlspecialchars($_SESSION['join']['place'])); ?> 
		<input type="hidden" name="place" value="<?php echo htmlspecialchars($_SESSION['join']['place']); ?>" />
		<br>
		知り合いたい対象：<?php print(htmlspecialchars($_SESSION['join']['interact'])); ?> 
		<input type="hidden" name="interact" value="<?php echo htmlspecialchars($_SESSION['join']['interact']); ?>" />
		<br>
		登録しているSNS(Social Networking Service)：<?php print(htmlspecialchars($_SESSION['join']['sns'])); ?> 
		<input type="hidden" name="sns" value="<?php echo htmlspecialchars($_SESSION['join']['sns']); ?>" />
		<br>
		
		
	<div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a>|<input type="submit" value="登録する" name="exereg" /></div>
</form>
<br><br>
<div id="bottom-box" align="center">
			<font size="2">
			<a href="agreement.html" target="_blank">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			利用規約
			</font></a>
			　｜　
			<a href="privacy.html" target="_blank">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			プライバシーポリシー
			</font></a>
			　｜　
			<a href="index.php">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			ホーム
			</font></a>
   	 		<h5>
   	 		
   	 		(C)Copyright
   	 		
   	 		<a href="http://d.hatena.ne.jp/infinity_th4/" target="_blank">
   	 		<font color="#DCDCDC" onmouseout="this.color='#DCDCDC'" onmouseover="this.color='#FF0000'">
   	 		Hiroshi Tashiro</font></a>.  All Rights Reserved.</font>
   	 		</h5>
</div>
</body>
</html>
