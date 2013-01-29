<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../style.css" />
<title>新規登録</title>
<!-- 全ページ共通start-->
<link rel="shortcut icon" href="../img/icon06.ico" type="image/vnd.microsoft.icon">
<!-- 全ページ共通end-->
<style type="text/css">
	body {margin: 0px; padding: 0px; }
	body { background: #ffffff url("../img/background.jpg") fixed left top }
</style>
</head>
<body>
<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>
<div align="center">
	<div id="in-box" align="center" class="radius" height="80%">
<?php
//session_start();
//session_regenerate_id(TRUE);

require('../dbconnect.php');

//print($_POST[memberid]."<br>");

$sql = "SELECT * FROM  tokens WHERE (memberid='{$_POST[memberid]}')";
$record = mysql_query($sql) or die(mysql_error());
$table = mysql_fetch_assoc($record);

$token=$table[token];
$auth=$table[auth];

//print($token."<br>");
if (($_POST['token'] === $token)&&($auth==='0')) {
	$sql="UPDATE  `tokens` SET  `auth` =  '1' WHERE  `memberid` ='{$_POST[memberid]}'";
	mysql_query($sql) or die ("failed");


?>


		<div align="center">
		<h2>登録が完了しました</h2>
		<h2>Welcome to CourseMatch.<h2><br><br>
		<a href="../">ログインする</a><br><br>
		</div>
	</div>
</div>
	
<?php
}else{
	//print("<br>失敗しました。すでに、登録されているか、間違いがあります。<br>
	//");
	//print("<br><a href='../contact/index.php'>お問い合せフォーム</a>");

?>
	<b>失敗しました。</b><br><br>
		<div id="statement-box">
		既に登録されているか、間違いがあります。<br><br>	
		仮登録したのにもかかわらず登録が完了できない場合、CourseMatchに、ご報告下さい。<br><br>
		<a href='../mail/mailcmatch.php'>お問い合せフォーム</a><br><br>
		</div>
	</div>
</div>

<?php
}
?>
<br><br>
<!-- 全ページ共通start-->

<div id="bottom-box" align="center">
			<font size="2">
			<a href="../agreement.html" target="_blank">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			利用規約
			</font></a>
			　｜　
			<a href="../privacy.html" target="_blank">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			プライバシーポリシー
			</font></a>
			　｜　
			<a href="../mail/mailcmatch.php">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			メール
			</font></a>
			　｜　
			<a href="../index.php">
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
<!-- 全ページ共通end-->

<br>
<div style="margin:auto; text-align:center; width:100%;">
<script type="text/javascript"><!--
google_ad_client = "pub-7759470714947522";
/* 08/05/24 */
google_ad_slot = "8071608975";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<noscript>
<a href="http://w1.oroti.net/~rent/" target="_blank">server</a>
</noscript>
</div>
</body>
</html>

