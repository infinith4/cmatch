<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>講義追加</title>
	<!-- 全ページ共通start-->
	<link rel="shortcut icon" href="../img/icon06.ico" type="image/vnd.microsoft.icon">
	<!-- 全ページ共通end-->
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<style type="text/css">
	body {margin: 0px; padding: 0px; }
	</style>

</head>
<body>
<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>


<?php
session_start();
//session_save_path("/var/lib/php/session");
require('../dbconnect.php');

if (!isset($_SESSION['auth'])) {//cookieに入っていなかったら。
	header('Location: ../index.php'); exit();
}


//$member_id='1';//ログインしているユーザーのid


//対象の講義を取得する

//print("曜日・時限:".$_POST[selecttime]."<br>");
//print($_POST['class']);

$selecttime=$_POST[selecttime];
$selclass=$_POST['selclass'];
$_SESSION[selclass]=$selclass;
//print("テーブル名:".$selclass);

$term='２学期';


$allclass = array('classcom', 'classculhumedu','classculhumspe', 'classculintedu','classculintspe','classculsocedu','classculsocspe','classsciedu','classscispe');

/*
if($_SESSION[selclass]===('classcom')){
print('共通教育<br>');

}elseif($_SESSION[selclass]===('classculhumedu')){
print('人文学部 人間科学科 教職<br>');
}elseif($_SESSION[selclass]===('classculhumspe')){
print('人文学部 人間科学科 専門<br>');
}elseif($_SESSION[selclass]===('classculintedu')){
print('国際社会コミュニケーション学科 教職');
}elseif($_SESSION[selclass]===('classculintspe')){
print('国際社会コミュニケーション学科 専門');
}elseif($_SESSION[selclass]===('classculsocedu')){
print('人文学部 社会経済学科 教職<br>');
}elseif($_SESSION[selclass]===('classculsocspe')){
print('人文学部 社会経済学科 専門<br>');
}elseif($_SESSION[selclass]===('classsciedu')){
print('理学部 理学科,応用理学科 教職<br>');
}elseif($_SESSION[selclass]===('classscispe')){
print('理学部 理学科,応用理学科 専門<br>');
}

*/
$i=0;

while($i<count($allclass)){
	$recordset[$i]=mysql_query("SELECT * FROM $allclass[$i] WHERE (time LIKE '%{$selecttime}%') AND (term LIKE '{$term}')");

	


?>
<br><br>
<div align="center">
<div id="in-box" align="">

<p>
<?php print($_SESSION['name']); ?>さん、
<?php print($_POST[selecttime]); ?>の講義を選択して、文末の「決定」ボタンを押してください
</p><!--選択された曜日・時限-->

もし、下記に登録したい講義が無いならば、
<a href="../classadd/classadd.php">
<font color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#FF0000'">講義の追加</font></a>
より追加して下さい。
<br><br>
<form action="submitsubjectlist.php" method="post">

<table border="1">
	<tr>
		<th>check</th>
		<th>No</th>
		<th>コード</th>
		<th>講義名</th>
		<th>担当教員</th>
		<th>学期</th>
		<th>曜日・時限</th>
		<th>年次</th>
		<!--<th>selclass</th>-->
	</tr>



<?php

while ($table =mysql_fetch_assoc($recordset[$i])){

?>

	<tr>
		
		<input type="hidden" name="selecttime" value="<?php echo htmlspecialchars($selecttime);?>"/>
		<input type="hidden" name="selclass" value="<?php print(htmlspecialchars($allclass[$i])); ?>"/>
		
		<td><input type="radio" name="code" value="<?php echo htmlspecialchars($table['code']); ?>"></td>
 		<td><?php print(htmlspecialchars($table['No'])); ?></td>
 		<td><?php print(htmlspecialchars($table['code'])); ?></td>
 		<td><?php print(htmlspecialchars($table['subject'])); ?></td>
 		<td><?php print(htmlspecialchars($table['teacher'])); ?></td>
 		<td><?php print(htmlspecialchars($table['term'])); ?></td>
 		<td><?php print(htmlspecialchars($table['time'])); ?></td>
 		<td><?php print(htmlspecialchars($table['yearly'])); ?></td>
 		<!--<td><?php print(htmlspecialchars($selclass)); ?></td>-->
 	</tr>
 	
<?php 
}
print("</table>");
print("<input type='submit' name='exereg' value='決定'></form>");

$i++;
print("</div>");
}
print("</div>");
?>



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