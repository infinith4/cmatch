<?php
session_save_path("/home/cmatch/public_html/tmp");
$sessionvalue=$_COOKIE['SESSID'];
session_id($sessionvalue);
session_start();



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />

<title>ログイン</title>
<!-- 全ページ共通start-->
<link rel="shortcut icon" href="img/icon06.ico" type="image/vnd.microsoft.icon">
<!-- 全ページ共通end-->
<style type="text/css">
body {margin: 0px; padding: 0px; }
body { background: #ffffff url("img/background.jpg") fixed left top }
</style>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>


</head>

<?php


# エラーメッセージの変数を初期化します。
$error = '';

# 認証済みかどうかのセッション変数を初期化します。
if (!isset($_SESSION['auth'])) {
  $_SESSION['auth'] = FALSE;
}

if (isset($_POST['memberid']) && isset($_POST['password'])) {
	$email=$_POST['memberid']."@s.kochi-u.ac.jp";


	$sql=sprintf("SELECT * FROM members WHERE email='{$email}'");//membersで入力されたmemberid

	$record_members=mysql_query($sql) or die(mysql_error());

	$table_members=mysql_fetch_assoc($record_members);



	$sql_token=sprintf("SELECT * FROM tokens WHERE memberid='$table_members[memberid]'");//membersで入力されたmemberid

	$record_token=mysql_query($sql_token) or die(mysql_error());

	$table_token=mysql_fetch_assoc($record_token);

	$auth=$table_token[auth];
	
	
	//ログイン成功
	if (sha1(mysql_real_escape_string($_POST['password'])) === $table_members[password] && $auth === '1') {
        	// セッション固定化攻撃対策
        	$oldSid = session_id();
		session_regenerate_id(TRUE);
		
		if (version_compare(PHP_VERSION, '5.1.0', '<')) {
			# PHP5.1未満では古いセッションファイルを削除する必要がある。
			$path = session_save_path() != '' ? session_save_path() : '/tmp';
			$oldSessionFile = $path . '/sess_' . $oldSid;
			
			
			if (file_exists($oldSessionFile)) {
				unlink($oldSessionFile);
        		}
        		
			
			$_SESSION['auth'] = TRUE;
			$_SESSION['name'] = $table_members[name];
			break;
		}
		//header("Location: index.php"); exit();
		$_SESSION['auth'] = TRUE;
		$_SESSION['memberid'] = $table_members[memberid];
		$_SESSION['name'] = $table_members[name];
		//exit();
	}
	
	//ログイン失敗
	if ($_SESSION['auth'] === FALSE) {
		if($auth ==='0'){
			$error = 
      			'<font color="red">本登録ができていません。<br>メールを確認して下さい。</font><br />';
		}else{
    			$error = 
      			'<font color="red">IDかパスワードに誤りがあります。</font><br />';
      		}
  	}
}

if ($_SESSION['auth'] !== TRUE) {
?>

<body>

<br>
<div id="form-box" class="radius">
  <h1>ログイン</h1>

  <p><font size="2">* IDは、＠s.kochi-u.ac.jpの前の半角英数字</font></p>
  <?php echo $error;?>
  <form action="index.php" method="post">
    <dl>
      <dt><label for="memberid">ID：</label></dt>
      <dd><input type="text" name="memberid" id="memberid" value="" /></dd>
    </dl>
    <dl>
      <dt><label for="password">パスワード：</label></dt>
      <dd><input type="password" name="password" id="password" value="" /></dd>
    </dl>
    <input type="image" src="img/login.png" name="submit" onmouseover="this.src='img/onlogin.png'" onmouseout="this.src='img/login.png'" />
  </form>
</div>

<div align="left">
<div id="loginmes-box" class="border radius">

	<div id="statement-box">
	CourseMatchは、高知大学の学部生が受講している講義を登録し、登録した学生同士が観覧できます.　　　　　　　　　　　<br>
	<br>現在、
	<b><font color="FF0000">
	<?php
	$sql = "select * from members";
	$result = mysql_query($sql) or die ("failed");
	$count = mysql_num_rows($result);
	print $count;
	?>
	</b></font>

	人の学生が登録しています。<br>
	もし、あなたが登録していないのなら登録してみましょう。
	<a href="framejoin/index.php">
    	<img src="img/reg.png" onmouseout="this.src='img/reg.png'" onmouseover="this.src='img/onreg.png'">
    	</a>
	<font size="2" color="FF0000">登録には、それほど時間を要しません。</font>
	<br><br>
	</div>

</div>
	<div class="border radius" >
	<b>「CourseMatch」の目的：</b><br><br>
	<div id="statement-box">
	目的は、サイトに登録したユーザーが受講している講義を、他に登録している誰が同じ講義を受講しているか知ることです。<br>

	それによって、サイトに登録したユーザーは、関わりのなかった人と知り合ったり、連絡を取り合うことが可能になるでしょう。<br><br>
	</div>
	<b>「CourseMatch」の機能：</b><br><br>
	<div id="statement-box">
	1.他の登録している学生の講義を見ることができます。<br><br>
	
	2.ユーザーは、新規登録画面で「氏名、メールアドレス(s.kochi-u.ac.jp)、パスワード、ハンドルネーム、学部、学科、コース、年次」の情報を入力することで、サイトに登録できます。<br>
	(氏名、メールアドレス(s.kochi-u.ac.jp)、パスワードが公開されることはありません。)<br><br>

	3.新規登録時に入力された「ハンドルネーム、学部、学科、コース、年次」の情報は、ログイン後の画面の「メンバー一覧」に表示されます。<br><br>

	4.ログイン後、ユーザーは講義を登録することができます。もし、他ユーザーが、ログイン中のユーザーと同じ講義を登録していた場合、登録している他ユーザーのハンドルネームのリストが表示されます。<br><br>
	
	(「CourseMatch」は、facebook創設者Mark Elliot Zuckerbergが同じクラスを履修している他の学生のリストを参照できるようにした「Coursematch」のアイディアから得たものです。)<br><br>
	</div>
	<b>「CourseMatch」について：</b><br><br>
	<div id="statement-box">
	(i)大学ではなく個人が運営しています <br><br>
	(ii)CourseMatch内での講義情報はシラバスや履修案内をもとに独自に作成したものなので正規の情報はシラバスや履修案内で確認してください 
	</div><br><br>
	<div align="right" id="statement-box">
	CourseMatch製作者：田代 浩(Hiroshi Tashiro)<br>
	
	(更新日：2011年12月10日.製作開始:2011年11月8日～)<br><br>
	</div>
	</div>
	</div>
	<br><br>

</div>
<!-- 全ページ共通start-->
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
			<a href="mail/mailcmatch.php">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			メール
			</font></a>
			　｜　
			<a href="link.php" target="_blank">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			リンク
			</font></a>
			　｜　
			<a href="coursematch.php" target="_blank">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			CourseMatchについて
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
<?php
# スクリプトを終了し、認証が必要なページが表示しない。
exit();
}
/* ?>終了タグ省略 */
