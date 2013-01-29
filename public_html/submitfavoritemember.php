<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
session_start();

require('dbconnect.php');

$tablename="favorite".$_SESSION[memberid];
$favmemberid=$_POST[favmemberid];
$memberid=$_SESSION[memberid];

//print($tablename."<br>");
//print($favmemberid."<br>");
//print($friend."<br>");


$sql = "show tables from cmatch like '{$tablename}'";
$result = mysql_query($sql);

if (mysql_num_rows($result)) {
    //echo 'toテーブルは存在している。<br>';
} else {
   
$sql="CREATE TABLE $tablename (`memberid` varchar(20) NOT NULL, `favmemberid` varchar(20) NOT NULL, `favorite` int(10) NOT NULL, `friend` int(10) NOT NULL, `auth` int(10) NOT NULL, `created` datetime NOT NULL, `modified` datetime NOT NULL)";
mysql_query($sql) or die(mysql_error());

//print("toのテーブルを作成しました。");
}

$record=mysql_query("SELECT * FROM $tablename WHERE favmemberid='{$favmemberid}'");
$table =mysql_fetch_assoc($record);

if(!empty($_POST[favorite])){
	$favorite=$_POST[favorite];
}else{
	$favorite='0';
}
if(!empty($_POST[friend])){
	$friend=$_POST[friend];
}else{
	$friend='0';
}

if(!empty($table)){
	
	if(($favorite==='1')||($friend==='1')){
		$sqlupdate = sprintf("UPDATE  `$tablename` SET favorite='%s',friend='%s' ,modified='%s' WHERE  `favmemberid` ='{$favmemberid}'",
			mysql_real_escape_string($favorite),
			mysql_real_escape_string($friend),
			date('Y-m-d H:i:s')
		);
		
		mysql_query($sqlupdate) or die(mysql_error());
	
	}elseif(($favorite==='0')&&($friend==='0')){
		$sql="DELETE FROM $tablename WHERE favmemberid='{$favmemberid}'";
		mysql_query($sql) or die(mysql_error());
		
	}

}elseif((empty($table))&&(!empty($_POST[favorite])||!empty($_POST[friend]))){

	$sql = sprintf("INSERT INTO $tablename SET memberid='%s', favmemberid='%s', favorite='%s',friend='%s',created='%s',modified='%s'",
		mysql_real_escape_string($_SESSION[memberid]),
		mysql_real_escape_string($favmemberid),
		mysql_real_escape_string($favorite),
		mysql_real_escape_string($friend),
		date('Y-m-d H:i:s'),
		date('Y-m-d H:i:s')
	);
	//print("new");
	mysql_query($sql) or die(mysql_error());


}

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />

<title>お気に入り登録</title>
<!-- 全ページ共通start-->
<link rel="shortcut icon" href="img/icon06.ico" type="image/vnd.microsoft.icon">
<!-- 全ページ共通end-->


<META http-equiv="refresh" content="0; url=classmembers.php?code=<?php print($_SESSION[code]."&selclass=".$_SESSION[selclass]); ?>">


</head>



<body>
</body>

</html>