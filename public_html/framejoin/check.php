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
session_start();
require('../dbconnect.php');


//print("<br>dbconnect success.<br>");


//直接check.phpにアクセスした場合にindex.phpに返す

if ($_SESSION['joinpage']!==1) {
	//session_unset();
	print("<a href='index.php'>直接アクセスできません</a>");
	//header('Location:index.php');
	exit();
}

function is_alnum($text) {
    if (preg_match("/^[a-z0-9]+$/",$text)) {
        return TRUE;
    } else {
        return FALSE;
    }
}


if (!empty($_POST)) {
	// エラー項目の確認
	if ($_POST['lastname'] == '') {
		$error['lastname'] = 'blank';
	}
	if ($_POST['firstname'] == '') {
		$error['firstname'] = 'blank';
	}
	if ($_POST['handle'] == '') {
		$error['handle'] = 'blank';
	}
	
	if ($_POST['email'] == '') {//
		$error['email'] = 'blank';
	}
	
	//＠より前が8文字でなかったり、＠s.kochi-u.ac.jpでない場合
	//hati
	//print(substr($_POST['email'],0,8)."<br>");
	//print(strlen(substr($_POST['email'],0,8))."<br>");
	
	if (strlen(substr($_POST['email'],0,8))!== 8){
		$error['email'] = 'hati';
	}
	
	//nokochi
	//print(substr($_POST['email'] ,-16));
	if(substr($_POST['email'] ,-16)!='@s.kochi-u.ac.jp'){
		$error['email'] = 'nokochi';
	}
	
	//前3文字
	
	//print("前3文字：".substr($_POST['email'],0,3));
	/*
	if (substr($_POST['email'],0,3)!== 'b08'){
		$error['email'] = 'mae';
	}
	*/
	
	if ((substr($_POST['email'],0,3)!== 'b04') && (substr($_POST['email'],0,3)!== 'b05')
	 && (substr($_POST['email'],0,3)!== 'b06') && (substr($_POST['email'],0,3)!== 'b07')
	 && (substr($_POST['email'],0,3)!== 'b08') && (substr($_POST['email'],0,3)!== 'b09')
	 && (substr($_POST['email'],0,3)!== 'b10') && (substr($_POST['email'],0,3)!== 'b11')) {
		$error['email'] = 'mae';
	}
	
	
	//半角でない
	if (is_alnum(substr($_POST['email'],0,8))===FALSE) {
		$error['email'] = 'hankaku';
	}
	
	/*
	$new_str = mb_ereg_replace('[^0-9]','',$_POST[email]);
	print("new_str". $new_str);
	if (substr($_POST['email'],5,7) > 300) {
		$error['email'] = 'impossibility';
	}
	*/
	
	if (strlen($_POST['password']) < 5) {
		$error['password'] = 'length';
	}
	if ($_POST['password'] == '') {
		$error['password'] = 'blank';
	}
	if ($_POST['course'] == '') {
		$error['course'] = 'blank';
	}
	if ($_POST['yearly'] == '') {
		$error['yearly'] = 'blank';
	}
	// 重複アカウントのチェック
	if (empty($error)) {
		$sql = sprintf("SELECT COUNT(*) AS cnt FROM members WHERE email='%s'",
			mysql_real_escape_string($_POST['email'])
		);
		$record = mysql_query($sql) or die(mysql_error());
		$table = mysql_fetch_assoc($record);
		if ($table['cnt'] > 0) {
			$error['email'] = 'duplicate';
		}
	}
	if (empty($error)) {
		
	$_SESSION['join'] = $_POST;
	//header('Location: check.php'); exit();
	}
		
}




$lastname=$_POST['lastname'];
$firstname=$_POST['firstname'];
$name=$lastname." ".$firstname;
$email=$_POST['email'];
$password=$_POST['password'];
$course=$_POST['course'];



?>


<body>
<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>
<div id="joinmes-box" class="radius">　CourseMatchは、高知大学の学部生が受講している講義を登録し、登録した学生同士が観覧できます。</div>
<br>
<form action="submitmembers.php" method="post" >

<input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>" />
<!--
<input type="hidden" name="action" value="submit" />
-->
<div align="center">

	<div id="in-box" align="center" class="radius">
	<h3>登録情報確認</h3>

	<a href="index.php?action=rewrite">
	<font color="#000000" onmouseout="this.color='#000000'" onmouseover="this.color='#3399cc'">
	&lt;&lt;書き直す
	</font>
	</a>
	　　|　　
	<?php
	if (empty($error)) {
	print("<input type='submit' value='登録する' name='exereg' />");
	}
	?>　　|　　<a href="../index.php"><font color="#000000" onmouseout="this.color='#000000'" onmouseover="this.color='#3399cc'">ホーム</font></a>
	<br><br>
	<div align="left">
	<div id="topic-box"><b>姓：</b></div><br>
		<div id="statement-box">
			<?php print(htmlspecialchars($lastname)); ?>
			<input type="hidden" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" />
			<?php if ($error['lastname'] == 'blank'): ?>
			<p class="error"><font color="#ff0000" size="2">* 姓を入力してください</font></p>
			<?php endif; ?>
			<br><br>
		</div>

	<div id="topic-box"><b>名：</b></div><br>
		<div id="statement-box">
			<?php print(htmlspecialchars($firstname)); ?>
			<input type="hidden" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" />
			<?php if ($error['firstname'] == 'blank'): ?>
			<p class="error"><font color="#ff0000" size="2">* 名を入力してください</font></p>
			<?php endif; ?>
			<br><br>
		</div>

	<div id="topic-box"><b>メールアドレス(s.kochi-u.ac.jpのみ)：</b></div><br>
		<div id="statement-box">
			<input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
			<?php print($email); ?>
			<?php if ($error['email'] == 'blank'): ?>
    			<p class="error"><font color="#ff0000" size="2">* メールアドレスを入力してください</font></p>
    			<?php endif; ?>
    	
    			<?php if ($error['email'] == 'duplicate'): ?>
			<p class="error"><font color="#ff0000" size="2">* 指定されたメールアドレスはすでに登録されています</font></p>
			<?php endif; ?>
	
			<?php if ($error['email'] == 'impossibility'): ?>
			<p class="error"><font color="#ff0000" size="2">* 登録できません</font></p>
			<?php endif; ?>
	
			<?php if ($error['email'] == 'hati'): ?>
			<p class="error"><font color="#ff0000" size="2">* 8文字でない</font></p>
			<?php endif; ?>
	
			<?php if ($error['email'] == 'nokochi'): ?>
			<p class="error"><font color="#ff0000" size="2">* 高知大学のメールアドレスでない</font></p>
			<?php endif; ?>
		
			<?php if ($error['email'] == 'mae'): ?>
			<p class="error"><font color="#ff0000" size="2">* 前3文字が一致しない</font></p>
			<?php endif; ?>
	
			<?php if ($error['email'] == 'hankaku'): ?>
			<p class="error"><font color="#ff0000" size="2">* 半角でない</font></p>
			<?php endif; ?>
			<br><br>
		</div>



	<div id="topic-box"><b>パスワード:</b></div><br>
	<div id="statement-box">
		[表示されません]
		<input type="hidden" name="password" value="<?php echo htmlspecialchars($password); ?>" />
		<?php if ($error['password'] == 'blank'): ?>
		<p class="error"><font color="#ff0000" size="2">* パスワードを入力してください</font></p>
		<?php endif; ?>
    	
    		<?php if ($error['password'] == 'length'): ?>
		<p class="error"><font color="#ff0000" size="2">* パスワードを5文字以上にしてください</font></p>
		<?php endif; ?>
		<br><br>
	</div>


	<div id="topic-box"><b>ハンドルネーム:</b></div><br>
	<div id="statement-box">
		<?php print(htmlspecialchars($_POST[handle])); ?>
		<input type="hidden" name="handle" value="<?php echo htmlspecialchars($_POST[handle]); ?>" />
		<?php if ($error['handle'] == 'blank'): ?>
		<p class="error"><font color="#ff0000" size="2">* ハンドルネームを入力してください</font></p>
		<?php endif; ?>
		<br><br>
	</div>

<?php
if($course==='course_cul_hum_hum'){
$pricourse='人文学部 人間科学科 人間基礎論コース';
}
if($course==='course_cul_hum_loc'){
$pricourse='人文学部 人間科学科 地域変動論コース';
}
if($course==='course_cul_hum_lan'){
$pricourse='人文学部 人間科学科 言語表象論コース';
}
if($course==='course_cul_int'){
$pricourse='国際社会コミュニケーション学科';
}
if($course==='course_cul_soc_syn'){
$pricourse='人文学部 社会経済学科 総合地域政策コース';
}
if($course==='course_cul_soc_eco'){
$pricourse='人文学部 社会経済学科 経済企業情報コース';
}
if($course==='course_sci_sci_mat'){
$pricourse='理学部 理学科 数学コース';
}
if($course==='course_sci_sci_phy'){
$pricourse='理学部 理学科 物理科学コース';
}
if($course==='course_sci_sci_che'){
$pricourse='理学部 理学科 化学コース';
}
if($course==='course_sci_sci_bio'){
$pricourse='理学部 理学科 生物科学コース';
}
if($course==='course_sci_sci_geo'){
$pricourse='理学部 理学科 地球科学コース';
}
if($course==='course_sci_app_inf'){
$pricourse='理学部 応用理学科 情報科学コース';
}
if($course==='course_sci_app_che'){
$pricourse='理学部 応用理学科 応用化学コース';
}
if($course==='course_sci_app_oce'){
$pricourse='理学部 応用理学科 海洋生命・分子工学コース';
}
if($course==='course_sci_app_dis'){
$pricourse='理学部 応用理学科 災害科学コース';
}

?>

	<div id="topic-box"><b>学部、学科、コース：</b></div><br>
	<div id="statement-box">
		<input type="hidden" name="course" value="<?php echo htmlspecialchars($course); ?>" /><br>
		<?php print($pricourse); ?>
		<?php if ($error['course'] == 'blank'): ?>
	    	<p class="error"><font color="#ff0000" size="2">* 学部、学科、コースを選択して下さい</font></p>
	    	<?php endif; ?>
		<br><br>
	</div>

	<div id="topic-box"><b>年次:</b></div><br>
	<div id="statement-box">
		<input type="hidden" name="yearly" value="<?php echo htmlspecialchars($_POST[yearly]); ?>" /><br>
		<?php print($_POST[yearly]); ?>
		<?php
		if(!empty($_POST[yearly])){
			print('回生');
		}
		?>
		<?php if ($error['yearly'] == 'blank'): ?>
	    	<p class="error"><font color="#ff0000" size="2">* 年次を選択して下さい</font></p>
	    	<?php endif; ?>
		<br><br>
	</div>
	</div>


	<a href="index.php?action=rewrite">
	<font color="#000000" onmouseout="this.color='#000000'" onmouseover="this.color='#3399cc'">
	&lt;&lt;書き直す
	</font>
	</a>
	　　|　　
	<?php
	if (empty($error)) {
	print("<input type='submit' value='登録する' name='exereg' />");
	}
	?>　　|　　<a href="../index.php"><font color="#000000" onmouseout="this.color='#000000'" onmouseover="this.color='#3399cc'">ホーム</font></a>
	<br><br>
</form>
</div>
</div>
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

