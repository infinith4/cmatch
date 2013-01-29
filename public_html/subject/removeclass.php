<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
session_start();

//直接アクセスした場合
if (!isset($_SESSION['memberid'])) {
	header('Location: ../index.php'); exit();
}


require('../dbconnect.php');


print($_POST[disp]."<br>");




	$sql = "DELETE FROM `submitsubject` WHERE (memberid='{$_SESSION[memberid]}') AND (time='{$_POST[disp]}')";
	mysql_query($sql) or die(mysql_error());
	
	print("講義を削除しました。<br><br>");


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<title></title>
<!-- 5秒後に移動する場合 -->
<META http-equiv="refresh" content="5; url=../index.php">
<SCRIPT Language="JavaScript">
function init(){
thisForm.disp.value = window.dialogArguments;
}
</SCRIPT>
</head>
<body>
移動しない場合は
<a href="../index.php">こちら</a>をクリックしてください。<br><br>

</body>
</html>