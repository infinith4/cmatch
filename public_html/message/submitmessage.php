<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
session_start();
if(empty($_SESSION[memberid])){
	header("Location:../");
	print("<a href='../'>ホーム</a>");
	exit();
}
?>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>受信BOX</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<!-- 全ページ共通start-->
	<link rel="shortcut icon" href="../img/icon06.ico" type="image/vnd.microsoft.icon">
	<!-- 全ページ共通end-->
	<link href="../menu/jquery.jdMenu.css" rel="stylesheet" type="text/css" />
	<script src="../scripts/jquery-1.3.1.js" type="text/javascript"></script>
	<script src="../menu/jquery.dimensions.js" type="text/javascript"></script>
	<script src="../menu/jquery.positionBy.js" type="text/javascript"></script>  
	<script src="../menu/jquery.bgiframe.js" type="text/javascript"></script>
	<script src="../menu/jquery.jdMenu.js" type="text/javascript"></script>

	<script type="text/javascript">


$(function() {
  $("ul.jd_menu").jdMenu();
  //$("ul.jd_menu").jdMenu({ showDelay: 200, hideDelay: 500 });
  //$("ul.jd_menu").jdMenu({ showDelay: 1000, hideDelay: 1000 });
  //$("ul.jd_menu").jdMenu({disableLinks: true});
});  

</script>



	<style type="text/css">
	body {margin: 0px; padding: 0px; }
	body { background: #ffffff url("../img/background.jpg") fixed left top }

<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'ja'}
</script>
<!--

a {  text-decoration: none}



-->
<!--
body { background: #ffffff url("img/img04.jpg") fixed left top }
-->
</style>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</head>

<body>

<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>

<?php
require('../dbconnect.php');

$tablenamefrom="messages".$_SESSION[memberid];
/*
			print "テーブル名：" . $tablenamefrom ."<BR>";
			print "From：" . $_SESSION[memberid] ."<BR>";
			print "To：" . $_POST[to] ."<BR>";
			print "タイトル：" . $_POST[title] ."<BR>";
			print "内容：" . $_POST[message] ."<BR>";
			
*/

$recordprofiles=mysql_query("SELECT * FROM profiles WHERE (memberid='{$_POST[to]}')");

$tableprofiles =mysql_fetch_assoc($recordprofiles);



$tablenameto="messages".$_POST[to];

$sql = "show tables from cmatch like '{$tablenameto}'";
$result = mysql_query($sql);
if (mysql_num_rows($result)) {
    //echo 'toテーブルは存在している。<br>';
} else {
    
mysql_query("CREATE TABLE $tablenameto (
 `id` varchar(29) NOT NULL,
 `memberid` varchar(20) NOT NULL,
 `title` varchar(255) NOT NULL,
 `message` text NOT NULL, 
 `frommemberid` varchar(29) NOT NULL, 
 `tomemberid` varchar(29) NOT NULL, 
 `type` varchar(20) NOT NULL, 
 `created` datetime NOT NULL, 
 PRIMARY KEY (`id`))") or die(mysql_error());

//print("toのテーブルを作成しました。");
}

	//$date=date("ymdHis");
	//print $date . "に送信されました<br>";
	//print date("Y年m月d日,H時i分s秒") . "に送信されました<br>";
	
	if (!empty($_POST[title]) && !empty($_POST[message]) && !empty($_POST[to])){
		/*
		$sql = sprintf("INSERT INTO {$tablename} SET memberid='%s', title='%s', message='%s', from='%s', to='%s', created='%s' ",
				mysql_real_escape_string($_SESSION[memberid]),
				mysql_real_escape_string($_POST[title]),
				mysql_real_escape_string($_POST[message]),
				mysql_real_escape_string($_SESSION[memberid]),
				mysql_real_escape_string($_POST[to]),
				date('Y-m-d H:i:s')
				);
		*/
		$message=str_replace("\r\n","<br>",$_POST['message']);
		//$message=nl2br($_POST[memssage]);
		
		$idmes=uniqid(rand(100000,999999),TRUE);//一意なメッセージのIDを生成
		
		
		if($_POST[type]==='new'){
		$sqlfrom = sprintf("INSERT INTO $tablenamefrom SET id='%s',memberid='%s',title='%s',message='%s', frommemberid='%s', tomemberid='%s',type='%s', created='%s'",
			$idmes,
			mysql_real_escape_string($_SESSION[memberid]),
			mysql_real_escape_string($_POST[title]),
			mysql_real_escape_string($message),
			mysql_real_escape_string($_SESSION[memberid]),
			mysql_real_escape_string($_POST[to]),
			mysql_real_escape_string($_POST[type]),
			date('Y-m-d H:i:s')
		);
		
		$retfrom=mysql_query($sqlfrom);
		
		$sqlto = sprintf("INSERT INTO $tablenameto SET id='%s',memberid='%s',title='%s',message='%s', frommemberid='%s', tomemberid='%s',type='%s', created='%s'",
			$idmes,
			mysql_real_escape_string($_POST[to]),
			mysql_real_escape_string($_POST[title]),
			mysql_real_escape_string($message),
			mysql_real_escape_string($_SESSION[memberid]),
			mysql_real_escape_string($_POST[to]),
			mysql_real_escape_string($_POST[type]),
			date('Y-m-d H:i:s')
		);
		
		$retto=mysql_query($sqlto);
		}elseif($_POST[type]==='reply'){
		
		$sqlrep = sprintf("UPDATE $tablenamefrom SET type='%s' WHERE id='{$_POST[id]}'",
		mysql_real_escape_string($_POST[type])
		);
		
		mysql_query($sqlrep) or die(mysql_error());
		
		$type='new';
		
		$sqlfrom = sprintf("INSERT INTO $tablenamefrom SET id='%s',memberid='%s',title='%s',message='%s', frommemberid='%s', tomemberid='%s',type='%s', created='%s'",
			$idmes,
			mysql_real_escape_string($_SESSION[memberid]),
			mysql_real_escape_string($_POST[title]),
			mysql_real_escape_string($message),
			mysql_real_escape_string($_SESSION[memberid]),
			mysql_real_escape_string($_POST[to]),
			mysql_real_escape_string($type),
			date('Y-m-d H:i:s')
		);
		
		$retfrom=mysql_query($sqlfrom);
		
		$sqlto = sprintf("INSERT INTO $tablenameto SET id='%s',memberid='%s',title='%s',message='%s', frommemberid='%s', tomemberid='%s',type='%s', created='%s'",
			$idmes,
			mysql_real_escape_string($_POST[to]),
			mysql_real_escape_string($_POST[title]),
			mysql_real_escape_string($message),
			mysql_real_escape_string($_SESSION[memberid]),
			mysql_real_escape_string($_POST[to]),
			mysql_real_escape_string($type),
			date('Y-m-d H:i:s')
		);
		$retto=mysql_query($sqlto);
		
		}
		
		//print "決定ボタンがクリックされました<br>";
		?>
<p class="boder">

<div id="jdmenuwrap">
  <ul class="jd_menu">   
    <li><a href="../index.php">ホーム</a></li>
    <li><a href="../members.php">メンバー &raquo;</a>   
      <ul>   
        <li><a href="../members.php">登録メンバー</a></li>   
        <li>
        <a href="../favoritemembers.php"
    		onClick="window.open('../favoritemembers.php','win','width=500,height=400,menubar=no,status=no,scrollbars=yes,location=no') ; return false ;">
    		お気に入り</a>
    	</li>
      </ul>
    </li>
    <li><a href="#">講義 &raquo;</a>   
      <ul>   
        <li><a href="subjectlist.php">講義一覧 &raquo;</a>   
          <ul>
          <?php
          	$allsubject = array('classcom', 'classculhumedu','classculhumspe', 'classculintedu','classculintspe','classculsocedu','classculsocspe','classsciedu','classscispe');
		$allsubjectname = array('共通教育', '人文学部 人間科学科 教職','人文学部 人間科学科 専門', '国際社会コミュニケーション学科 教職','国際社会コミュニケーション学科 専門','人文学部 社会経済学科 教職','人文学部 社会経済学科 専門','理学部 理学科,応用理学科 教職','理学部 理学科,応用理学科 専門');
          $i=0;
          while($i<count($allsubject)){
          ?>
          
            <li>
            <a href="subjectlist.php?subject=<?php print($allsubject[$i])?>">
            <?php print($allsubjectname[$i]); ?></a>
            </li>
          <?php
          $i++;
          }
          ?>
          </ul>
        </li>
        <li><a href="../classadd/classadd.php">講義追加</a></li>
      </ul>
    </li>
    <!--<li><a href="../project/project.php">企画</a></li>-->
    <li><a href="frommes.php">メッセージ &raquo;</a>
      <ul>   
        <li><a href="frommes.php">受信BOX</a></li>   
        <li><a href="tomes.php">送信BOX</a></li>   
        <li><a href="send.php">作成</a></li>   
      </ul>
    </li>
    <li><a href="#">設定変更 &raquo;</a>   
      <ul>
      	<li><a href="index.php">プロフィール更新</a></li>
        <li><a href="#">講義変更</a></li>
      </ul>   
    </li>
    <li><a href="../logout.php">ログアウト</a></li>
  </ul>   
</div>   
</p>
	<table>
	<tr>
		<td valign="top">
		<div id="menumes-box">
		<font size='5' color="#FF0000">|　</font><a href="send.php"><font color="#FF0000" onmouseout="this.color='#FF0000'" onmouseover="this.color='#B9B9B9'">作成</font></a>
		<br><br>
		　　<a href="frommes.php">受信BOX</a>
		<br><br>
		　　<a href="tomes.php">送信BOX</a>
		<br><br>
		　　<a href="#">下書き</a>
		</div>
		</td>

		<td valign="top">
		<?php
		
		if($retfrom){
			
			print "<div align='center'>送信に成功しました<br><br>";
				
			print "<div id='message-box' align='left'>";
			
			print "To：<b>" .$tableprofiles[handle] ."</b><hr><BR>";
			print "<b>" . $_POST[title] ."</b><hr><BR>";
			print "<br><br><div id='mes-box'>" . $message ."</div><hr><BR><BR></div>";
			
	
		}else{
			print "<br><br>失敗しました。再度、お試しください。<br><br><a href='frommes.php'>送信BOX</a>";
	
		}
		?>
			</td>
</tr>
</table>
<?php
	
	
	}


//header("Location:frommes.php");

?>


<br><br>
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
<br>
</body>
</html>