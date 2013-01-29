<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
session_start();
/*
//直接アクセスした場合
if (!isset($_SESSION['join'])) {
	header('Location: class.php'); exit();
}

*/
require('../dbconnect.php');


$memberid=$_SESSION['memberid'];//ログインしているユーザーのid
print($_POST[selecttime]."<br>");
print($_POST[code]."<br>");
print($_POST[time]."<br>");
print($_POST[selclass]."<br>");
$selclass=$_POST[selclass];
print("selclass:".$selclass."<br>");

	//$date=date("ymdHis");
	//print $date . "に送信されました<br>";
	//print date("Y年m月d日,H時i分s秒") . "に送信されました<br>";
	
	if (!empty($_POST)) {
		
		
		// 重複アカウントのチェック
		// エラー項目の確認
		if ($_POST[code] == '') {
			$error['code'] = 'blank';
			print("<br>エラーです。" . $_POST['selecttime']."の講義を選択して下さい。<br>");
		}
		if (empty($error)) {
			$sql = "SELECT COUNT(*) AS cnt FROM submitsubject WHERE (time LIKE '%{$_POST[selecttime]}%') AND (memberid='{$_SESSION['memberid']}')";
			$record = mysql_query($sql) or die(mysql_error());
			$table = mysql_fetch_assoc($record);
			if ($table['cnt'] > 0) {
				$error['email'] = 'duplicate';
				print("<br>エラーです。" . $_POST['selecttime']."にすでに、講義が存在します。<br>");
			}
		}
		//選択されたテーブルから、codeに一致する、timeを取得(POST[selecttime]では、
		//選択されたtime(例えば、火2火3など複数時限にわたる場合をindexにひょうじするため)が表示できないから)
		if (empty($error)) {
			$sql = "SELECT * FROM  $_POST[selclass] WHERE (code='{$_POST[code]}')";
			$record = mysql_query($sql) or die(mysql_error());
			$table = mysql_fetch_assoc($record);
			print("---table[time]".$table[time]."<br>");
		}
		if (empty($error)) {
			
			$sql="insert into submitsubject
			 (memberid,code,selclass,time) 
			 values 
			 (\"$memberid\",\"$_POST[code]\",\"$_POST[selclass]\",\"$table[time]\")";
			
			/*
			$sql = sprintf("INSERT INTO submitsubject SET memberid='%s', code='%s', table='%s'",
			mysql_real_escape_string($memberid),
			mysql_real_escape_string($_POST[code]),
			mysql_real_escape_string($selclass)
			);
			*/
			/*
			print("<br>selclass::".$selclass);
			$sql = sprintf("INSERT INTO submitsubject SET memberid='%s', code='%s', selclass='%s',time='%s'",
			mysql_real_escape_string($memberid),
			mysql_real_escape_string($_POST[code]),
			mysql_real_escape_string(htmlspecialchars($_POST[selclass])),
			mysql_real_escape_string($_POST[time])
			);
			*/
			
			//*/
			$ret=mysql_query($sql);
	
			if(isset($_POST[exereg])){
				print "決定ボタンがクリックされました<br>";
		
				if($ret){
	
					print "下記のレコードの追加に成功しました<br><br>";
					
					print "テーブル名：" . $_POST[selclass] ."<BR>";
					print "ID：" . $memberid ."<BR>";
					print "講義コード：" . $_POST[code] ."<BR>";
					print "time曜日・時限：" . $table[time] ."<BR>";
					print "曜日・時限：" . $_POST[selecttime] ."<BR>";
	
					//print mysql_affected_rows($con) . "件を追加しました<br><br>";
					print mysql_insert_id($con) . "が自動採番されました<br><br>";
	
				}else{
				print "失敗しました。再度、お試しください。";
	
				}
	
	
			}elseif(isset($_POST[cancelreg])){
				print "キャンセルボタンがクリックされました";
			}
	


			$con=mysql_close($con);
	
			
		}
		
	}
	
	
	
	//tbcontact
	




?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<title></title>
<!-- 5秒後に移動する場合 -->
<META http-equiv="refresh" content="50; url=../index.php">
</head>
<body>
5秒後に移動します。
5秒たっても移動しない場合は
<a href="../index.php">こちら</a>をクリックしてください。<br><br>
</body>
</html>