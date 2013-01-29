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
	#joinmes-box {
          width : 650ox;
          border: 2px solid #989898;
          background-color: #EFEFEF;
	}
</style>
<script src="../scripts/jquery-1.3.1.js" type="text/javascript"></script>
<script src="../js/jquery.watermarkinput.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
  $("#lastname").Watermark("姓を入力");
  $("#firstname").Watermark("名を入力");
  $("#email").Watermark("学籍番号@s.kochi-u.ac.jp");
  $("#password").Watermark("新パスワードを入力");
  $("#handle").Watermark("ハンドルネームを入力");
  $("#clearAll").click(function() {
    $.Watermark.HideAll();
  });
  $("#showAll").click(function() {
    $.Watermark.ShowAll();
  });

  //$("#last").Watermark("姓","red");
  //$("#first").Watermark("名","#ffdddd");    
});   
</script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/jquery.validate.messages_jp.js" type="text/javascript"></script>
<!--<script src="../js/cmxforms.js" type="text/javascript"></script>-->
<script type="text/javascript">
  $(function() {
    $("#commentForm").validate();
  });   
</script>    
</head>
<?php
session_start();
require('../dbconnect.php');
//session_unset();
$_SESSION['joinpage'] = 1;
/*
if (!empty($_POST)) {
	// エラー項目の確認
	if ($_POST['name'] == '') {
		$error['name'] = 'blank';
	}
	if ($_POST['email'] == '') {
		$error['email'] = 'blank';
	}
	if (strlen($_POST['password']) < 4) {
		$error['password'] = 'length';
	}
	if ($_POST['password'] == '') {
		$error['password'] = 'blank';
	}
	
	if (empty($error)) {
		
	$_SESSION['join'] = $_POST;
	header('Location: check.php'); exit();
	}
		
}
*/

// 書き直し
if ($_REQUEST['action'] == 'rewrite') {
	$_POST = $_SESSION['join'];
	$error['rewite'] = true;
}
?>

<body>
<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>
<table>
<tr>
<td width='65%'>
<div id='joinmes-box' class='radius'>
　CourseMatchは、高知大学の学部生が受講している講義を登録し、登録した学生同士が観覧できます.<br><br>
　現在、
<b><font color="FF0000">
<?php
$sql = "select * from members";
$result = mysql_query($sql) or die ("failed");
$count = mysql_num_rows($result);
print $count;
?>
</font></b>
人の学生が登録しています。<br>
　もし、あなたが登録していないのなら登録してみましょう.
</div>
</td>
</tr>
</td>
<tr>
<td>
<div id="join-in-box" class="radius">
	<b>新規登録の際の注意</b><br><br>
	<div id="statement-box">
	・登録には、「氏名」「高知大学のメールアドレス(s.kochi-u.ac.jp)」「パスワード」「ハンドルネーム」「学部、学科、コース」「年次」が必要です。<br>
	<b><font color="#FF0000">絶対にパスワードは、高知大学のメールアドレスに利用しているパスワードを、
	<b>入力しない</b>で、新しくパスワードを作って入力してください。<br></b></font>
	<br>
	・氏名、メールアドレス、パスワードが公開されることはありません。<br>

	<br><br>
	</div>
<!--
checkは公開、no checkは非公開
-->

CourseMatch製作者：田代 浩(Hiroshi Tashiro)<br>
(更新日：2011年11月15日.製作開始:2011年11月8日～)<br><br>
</div>
</td>
<td>
<div id="join-form-box" class="radius">
<h1>新規登録</h1>

<form action="check.php" method="post" enctype="multipart/form-data" >
<table>
  <tr>
    <td>姓：</td>
    <td><input type="text" name="lastname" size="20" maxlength="25"/></td>
  </tr>
  <tr>
    <td>名：</td>
    <td><input type="text" name="firstname" size="20" maxlength="25"/></td>   
  </tr>
  <tr>
    <td>メールアドレス：</td>
    <td><input type="text" name="email" size="40" maxlength="255"/></td>
  </tr>
  <tr>
    <td>パスワード：</td>
    <td><input type="password" name="password" size="20" maxlength="255"/></td>
  </tr>
  <tr>
    <td>ハンドルネーム：</td>
    <td><input type="text" name="handle" size="20" maxlength="255" /></td>
  </tr>
  <tr>
    <td>学部、学科、コース：</td>
	<td>  
	<SELECT name="course" >
	<OPTION value="">学部、学科、コースを選択</OPTION>
	<OPTGROUP label="人文学部">
	<OPTION value="course_cul_hum_hum">人間科学科 人間基礎論コース</OPTION>
	<OPTION value="course_cul_hum_loc">人間科学科 地域変動論コース</OPTION>
	<OPTION value="course_cul_hum_lan">人間科学科 言語表象論コース</OPTION>
	<OPTION value="course_cul_int">国際社会コミュニケーション学科</OPTION>
	<OPTION value="course_cul_soc_syn">社会経済学科 総合地域政策コース</OPTION>
	<OPTION value="course_cul_soc_eco">社会経済学科 経済企業情報コース</OPTION>
	</OPTGROUP>
	<OPTGROUP label="理学部">
	<OPTION value="course_sci_sci_mat">理学科 数学コース</OPTION>
	<OPTION value="course_sci_sci_phy">理学科 物理科学コース</OPTION>
	<OPTION value="course_sci_sci_che">理学科 化学コース</OPTION>
	<OPTION value="course_sci_sci_bio">理学科 生物科学コース</OPTION>
	<OPTION value="course_sci_sci_geo">理学科 地球科学コース</OPTION>
	<OPTION value="course_sci_app_inf">応用理学科 情報科学コース</OPTION>
	<OPTION value="course_sci_app_che">応用理学科 応用化学コース</OPTION>
	<OPTION value="course_sci_app_oce">応用理学科 海洋生命・分子工学コース</OPTION>
	<OPTION value="course_sci_app_dis">応用理学科 災害科学コース</OPTION>
	</OPTGROUP>
	</SELECT>
	</td>
   </tr>
  <tr>
    <td>年次：</td>
	<td>  
	<SELECT name="yearly" >
	<OPTION value="">年次を選択</OPTION>
	<OPTION value="1">1</OPTION>
	<OPTION value="2">2</OPTION>
	<OPTION value="3">3</OPTION>
	<OPTION value="4">4</OPTION>
	<OPTION value="5">5</OPTION>
	<OPTION value="6">6</OPTION>
	</SELECT>
	</td>
   </tr>
  <!--
  <tr>
    <td>公開設定：</td>
    <td><input type="checkbox" name="public" value="1" checked></td>
  </tr>
  -->
   
</table>
<hr>
<input  class="submit" type="submit" value="登録" />　　　　|　　　<a href="../index.php">ホーム</a>
</form>
</div>

</td>
</tr>
</table>


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
