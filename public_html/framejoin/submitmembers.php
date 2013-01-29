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
<?php
//session_save_path("/var/lib/php/session");
session_start();
require('../dbconnect.php');

// htmlspecialcharsのショートカット
function h($value) {
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
$memberid=uniqid(rand(1000000,9999999));

$course=$_POST[course];


if($course==='course_cul_hum_hum'){
$dep='人文学部';
$con='人間科学科';
$cou='人間基礎論';
}
if($course==='course_cul_hum_loc'){
$dep='人文学部';
$con='人間科学科';
$cou='地域変動論';
}
if($course==='course_cul_hum_lan'){
$dep='人文学部';
$con='人間科学科';
$cou='言語表象論';
}
if($course==='course_cul_int'){
$dep='人文学部';
$con='国際社会コミュニケーション学科';
$cou=' ';
}
if($course==='course_cul_soc_syn'){
$dep='人文学部';
$con='社会経済学科';
$cou='総合地域政策';
}
if($course==='course_cul_soc_eco'){
$dep='人文学部';
$con='社会経済学科';
$cou='経済企業情報';
}
if($course==='course_sci_sci_mat'){
$dep='理学部';
$con='理学科';
$cou='数学';
}
if($course==='course_sci_sci_phy'){
$dep='理学部';
$con='理学科';
$cou='物理科学';
}
if($course==='course_sci_sci_che'){
$dep='理学部';
$con='理学科';
$cou='化学';
}
if($course==='course_sci_sci_bio'){
$dep='理学部';
$con='理学科';
$cou='生物科学';
}
if($course==='course_sci_sci_geo'){
$dep='理学部';
$con='理学科';
$cou='地球科学';
}
if($course==='course_sci_app_inf'){
$dep='理学部';
$con='応用理学科';
$cou='情報科学';
}
if($course==='course_sci_app_che'){
$dep='理学部';
$con='応用理学科';
$cou='応用化学';
}
if($course==='course_sci_app_oce'){
$dep='理学部';
$con='応用理学科';
$cou='海洋生命・分子工学';
}
if($course==='course_sci_app_dis'){
$dep='理学部';
$con='応用理学科';
$cou='災害科学';
}

/*
print(uniqid()."<br>");
print(uniqid('token_')."<br>");
print(uniqid('',TRUE)."<br>");
print(uniqid(rand(),TRUE)."<br>");
*/
$token=uniqid(rand(),TRUE);
$auth=0;
if(!empty($memberid)&&!empty($_POST[handle])&&!empty($dep)&&!empty($con)&&!empty($cou)&&!empty($_POST[yearly])&&!empty($_POST[name])&&!empty($_POST[email])&&!empty($_POST[password])){
	//mailの確認
	$sqlmail = sprintf("INSERT INTO tokens SET memberid='%s',token='%s',auth='%s'",
		mysql_real_escape_string(h($memberid)),
		mysql_real_escape_string(h($token)),
		mysql_real_escape_string(h($auth))
	);
	
	mysql_query($sqlmail) or die(mysql_error());

	$sql = sprintf("INSERT INTO profiles SET memberid='%s',handle='%s',department='%s', concentration='%s', course='%s', yearly='%s',created='%s',modified='%s'",
		mysql_real_escape_string(h($memberid)),
		mysql_real_escape_string(h($_POST[handle])),
		mysql_real_escape_string(h($dep)),
		mysql_real_escape_string(h($con)),
		mysql_real_escape_string(h($cou)),
		mysql_real_escape_string(h($_POST[yearly])),
		date('Y-m-d H:i:s'),
		date('Y-m-d H:i:s')
	);
	
	mysql_query($sql) or die(mysql_error());

	
	mysql_query("INSERT INTO privacyprofiles SET memberid='{$memberid}',privdep='1', privcon='0', privcou='0', privyea='0',privmes='1',privsex='0',privcom='0',privpla='0',privint='0',privsns='0'");

	$sql = sprintf("INSERT INTO members SET name='%s',lastname='%s',firstname='%s', memberid='%s', email='%s', password='%s',created='%s'",
		mysql_real_escape_string(h($_POST[name])),
		mysql_real_escape_string(h($_POST[lastname])),
		mysql_real_escape_string(h($_POST[firstname])),
		mysql_real_escape_string(h($memberid)),
		mysql_real_escape_string(h($_POST[email])),
		sha1(mysql_real_escape_string(h($_POST[password]))),
		date('Y-m-d H:i:s')
	);
	
	mysql_query($sql) or die(mysql_error());
	//*/
	//header('Location: thanks.php');
	//exit();
	
	//print("<a href='thanks.php'>クリックしてください</a>")
	
//mail送信
//$_POST[email]='infinity.th4@gmail.com';
mb_language("Ja") ;
mb_internal_encoding("utf-8");
$mailto="$_POST[email]";
$subject="CourseMatch - 新規登録のお知らせ";
$content="
Welcome to CourseMatch.\n
 $_POST[name] さん。\n
 あなたのIDは、$memberid です。\n

CourseMatchへの登録を完了するために、以下のURLにアクセスして下さい。\n
http://w9.oroti.net/~cmatch/framejoin/auth.php?token=$token&memberid=$memberid \n
＊もし、このメールに心当たりのない場合は、他人がメールアドレスを誤って入力したと思われます。\n

お問い合せフォームから、CourseMatchにご報告して下さい。\n
お問い合せフォーム: http://w9.oroti.net/~cmatch/mail/mailcmatch.php
\n

----------------------------------\n

CourseMatch製作者：田代 浩(Hiroshi Tashiro)\n
infinity.th4@gmail.com
";
$mailfrom="From:" .mb_encode_mimeheader("CourseMatch") ."<infinity.th4@gmail.com>";
mb_send_mail($mailto,$subject,$content,$mailfrom);


//mail送信(CourseMatchに確認のメールを送る)

mb_language("Ja") ;
mb_internal_encoding("utf-8");
$mailto="infinity.th4@gmail.com";
$subject="(確認用)CourseMatch - 新規登録のお知らせ";
$content="
Welcome to CourseMatch.\n
 $_POST[name] さん。\n
 あなたのIDは、$memberid です。\n

CourseMatchへの登録を完了するために、以下のURLにアクセスして下さい。\n
http://w9.oroti.net/~cmatch/framejoin/auth.php?token=$token&memberid=$memberid \n
＊もし、このメールに心当たりのない場合は、他人がメールアドレスを誤って入力したと思われます。\n

お問い合せフォームから、CourseMatchにご報告して下さい。\n
お問い合せフォーム: http://w9.oroti.net/~cmatch/mail/mailcmatch.php
\n

----------------------------------\n

CourseMatch製作者：田代 浩(Hiroshi Tashiro)\n
infinity.th4@gmail.com
";
$mailfrom="From:" .mb_encode_mimeheader("CourseMatch") ."<infinity.th4@gmail.com>";
mb_send_mail($mailto,$subject,$content,$mailfrom);
}else{
	print("エラーです。<br><a href='../index.php'>ホーム</a>");
	exit();
}
session_unset();
?>
<body>
<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>
<div align="center">
<div id="in-box" align="left" class="radius">
	<p><b>仮登録完了</b></p><br><br>
	<div id="statement-box">
		<p>登録されたメールに確認のためにCourseMatchよりメールをお送りしました。</p>
		<p>メールを確認し、登録を完了して下さい。</p><br>
		<p><a href='https://webmail.s.kochi-u.ac.jp/am_bin/ammain/' target='_blank'>
		<font color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc00ff'">
		<b>学生用Webmail</b>
		</font></a>よりメールが確認できます。</p>
	</div><br><br>
</div>

</div>

<!-- 全ページ共通start-->

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
