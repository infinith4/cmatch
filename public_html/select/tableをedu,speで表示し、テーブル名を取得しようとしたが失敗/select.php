<?php
session_start();

require('../dbconnect.php');

if (!isset($_SESSION['auth'])) {//cookieに入っていなかったら。
	header('Location: ../index.php'); exit();
}


//$member_id='1';//ログインしているユーザーのid


//対象の講義を取得する

print($_POST[selecttime]);
//print($_POST['class']);

$selecttime=$_POST[selecttime];
$selclass=$_POST['class'];
$term='２学期';

if($selclass==='class_cul_hum'){
print('人文学部 人間科学科 人間基礎論コース<br>');
print('人文学部 人間科学科 地域変動論コース<br>');
print('人文学部 人間科学科 言語表象論コース<br>');

}
if($selclass==='class_cul_int'){
$priclass='国際社会コミュニケーション学科';
}
if($selclass==='class_cul_soc'){
print('人文学部 社会経済学科 総合地域政策コース<br>');
print('人文学部 社会経済学科 経済企業情報コース<br>');

}
if($class==='class_sci_sci_mat'){
print('理学部 理学科 数学コース<br>');
print('理学部 理学科 物理科学コース<br>');
print('理学部 理学科 化学コース<br>');
print('理学部 理学科 生物科学コース<br>');
print('理学部 理学科 地球科学コース<br>');
print('理学部 応用理学科 情報科学コース<br>');
print('理学部 応用理学科 応用化学コース<br>');
print('理学部 応用理学科 海洋生命・分子工学コース<br>');
print('理学部 応用理学科 災害科学コース<br>');

}


if($selclass==='class_com'){
	$recordset=mysql_query("SELECT * FROM $selclass WHERE (time LIKE '%{$selecttime}%') AND (term LIKE '{$term}')");
}else{
	$selclass_edu=$selclass.'_edu';
	$selclass_spe=$selclass.'_spe';
	//$recordset=mysql_query("SELECT * FROM {$selclass_edu} edu,{$selclass_spe} spe WHERE (spe.time LKE '%{$selecttime}%')");
	//$recordset=mysql_query("SELECT * FROM $selclass_edu WHERE (time LIKE '%{$selecttime}%') UNION SELECT * FROM $selclass_spe WHERE (time LIKE '%{$selecttime}%')");
	$recordset=mysql_query("
	 SELECT * FROM $selclass_spe WHERE (time LIKE '%{$selecttime}%') AND (term LIKE '{$term}')
	 UNION 
	 SELECT * FROM $selclass_edu WHERE (time LIKE '%{$selecttime}%') AND (term LIKE '{$term}')");

	
	//$recordset_spe=mysql_query("SELECT * FROM $selclass_spe WHERE (time LIKE '%{$selecttime}%') AND (term LIKE '{$term}')");
	//$recordset=$recordset_spe.$recordset_edu;
	//print($selclass_spe);
}


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>講義選択</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<style type="text/css">

<!--

a {  text-decoration: none}



-->
<!--
body { background: #ffffff url("img/img04.jpg") fixed left top }
-->
</style>
</head>

<body>
<p>
<?php print($_SESSION['name']); ?>さん、
<?php print($_POST[selecttime]); ?>の講義を選択して、文末の「決定」ボタンを押してください
</p><!--選択された曜日・時限-->


<form action="submitsubject.php" method="post">

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
		<th>tablename</th>
	</tr>



<?php

while ($table =mysql_fetch_assoc($recordset)){

?>




	<tr>
		
		<input type="hidden" name="selecttime" value="<?php echo htmlspecialchars($selecttime);?>"/>
		<input type="hidden" name="selclass" value="
		<?php
			echo htmlspecialchars(mysql_tablename($table));
		?>"/>
		
		<td><input type="radio" name="code" value="<?php echo htmlspecialchars($table['code']); ?>"></td>
 		<td><?php print(htmlspecialchars($table['No'])); ?></td>
 		<td><?php print(htmlspecialchars($table['code'])); ?></td>
 		<td><?php print(htmlspecialchars($table['subject'])); ?></td>
 		<td><?php print(htmlspecialchars($table['teacher'])); ?></td>
 		<td><?php print(htmlspecialchars($table['term'])); ?></td>
 		<td><?php print(htmlspecialchars($table['time'])); ?></td>
 		<td><?php print(htmlspecialchars($table['yearly'])); ?></td>
 		<td><?php print(htmlspecialchars(mysql_tablename($table,1))); ?></td>
 	</tr>
 	
<?php 
}

?>


</table>

<input type="submit" name="exereg" value="決定">

</body>
</html>