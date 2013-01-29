<HTML>
<HEAD>
<TITLE>SELECT タグの連動 (最初にクライアントサイドに一括ダウンロード)</TITLE>

</HEAD>
<BODY>
<?php
$i=0;
while($i<count($_POST[daytime])){
	print($_POST[daytime][$i]."<br>");
	$times[$i]=$_POST[day].$_POST[daytime][$i];
	print("times[]:".$times[$i]."<br>");
	$i++;
}
//$daytime=$_POST[daytime]+1;

print("day:".$_POST[day]."<br>");
//print("daytime:".$daytime."<br>");

print("time[]:".$time."<br>");

$i=0;

while($i<count($_POST[daytime])){
	$time=$time.$times[$i];
	$i++;
}

print($time);

//print("time[]:".$time."<br>");


?>

</BODY>
</HTML>