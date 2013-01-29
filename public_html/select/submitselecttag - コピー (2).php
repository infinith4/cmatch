<HTML>
<HEAD>
<TITLE>SELECT タグの連動 (最初にクライアントサイドに一括ダウンロード)</TITLE>

</HEAD>
<BODY>
<?php
$i=0;
while(i<count($_POST[daytime])){
	print($_POST[daytime][i]."<br>");
}
$daytime=$_POST[daytime]+1;

print("day:".$_POST[day]."<br>");
print("daytime:".$daytime."<br>");

$time=$_POST[day].$daytime;


print("time:".$time."<br>");


?>

</BODY>
</HTML>