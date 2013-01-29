<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>更新完了</title>
	<!-- 全ページ共通start-->
	<link rel="shortcut icon" href="../img/icon06.ico" type="image/vnd.microsoft.icon">
	<!-- 全ページ共通end-->
	<link rel="stylesheet" type="text/css" href="../style.css" />
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
	</style>

</head>
<body>
<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>
<?php
session_start();

require('../dbconnect.php');
/*
if ($_SESSION['auth']===FALSE) {
	header('Location: ../index.php'); exit();
}
*/




	// 登録処理をする
	/*
	$sql = "INSERT INTO testmembers 
	(name, email, password, created)
	values(\"$_POST[name]\",\"$_POST[email]\",sha1(mysql_real_escape_string(\"$_POST[password]\"),\"date('Y-m-d H:i:s')\")";
	mysql_query($sql) or die(mysql_error());
	*/
	///*
	

$deparray=array("01" =>"人文学部","02" =>"理学部");
$conarray=array("0101" =>"人間科学科","0102" =>"国際社会コミュニケーション学科","0103"=>"社会経済学科",
		"0201"=>"理学科","0202"=>"応用理学科");

$couarray=array("010101" =>"人間基礎論","010102" =>"地域変動論","010103"=>"言語表象論","010201"=>" ",
		"010301"=>"総合地域政策","010302"=>"経済企業情報","020101"=>"数学","020102"=>"物理科学",
		"020103"=>"化学","020104"=>"生物科学","020105"=>"地球科学",
		"020201"=>"情報科学","020202"=>"応用化学","020203"=>"海洋生命・分子工学","020204"=>"災害化学");

while(list($key,$value)=each($deparray)){

	if($_POST[dep]===$key){
	
		$dep=$value;
	}
}
//print($dep."<br>");

while(list($key,$value)=each($conarray)){

	if($_POST[con]===$key){
	
		$con=$value;
	}
}
//print($con."<br>");

while(list($key,$value)=each($couarray)){

	if($_POST[cou]===$key){
	
		$cou=$value;
	}
}

//print($cou."<br>");
	
	
	$memberssql = sprintf("UPDATE  `members` SET lastname='%s',firstname='%s' WHERE  `memberid` ='{$_SESSION[memberid]}'",
		mysql_real_escape_string($_POST[lastname]),
		mysql_real_escape_string($_POST[firstname])
	);
	
	mysql_query($memberssql) or die(mysql_error());
	
	
	$privacysql = sprintf("UPDATE  `privacyprofiles` SET memberid='%s', privdep='%s',privcon='%s',privcou='%s',privyea='%s',privmes='%s',privsex='%s',privcom='%s',privpla='%s',privint='%s',privsns='%s' WHERE  `memberid` ='{$_SESSION[memberid]}'",
		mysql_real_escape_string($_SESSION[memberid]),
		mysql_real_escape_string($_POST[privdep]),
		mysql_real_escape_string($_POST[privcon]),
		mysql_real_escape_string($_POST[privcou]),
		mysql_real_escape_string($_POST[privyea]),
		mysql_real_escape_string($_POST[privmes]),
		mysql_real_escape_string($_POST[privsex]),
		mysql_real_escape_string($_POST[privcom]),
		mysql_real_escape_string($_POST[privpla]),
		mysql_real_escape_string($_POST[privint]),
		mysql_real_escape_string($_POST[privsns])
	);
	
	mysql_query($privacysql) or die(mysql_error());
	
	
	$sql = sprintf("UPDATE  `profiles` SET memberid='%s', handle='%s', department='%s',concentration='%s',course='%s',yearly='%s',messageline='%s',message='%s',sex='%s',companyfriendship='%s',place='%s',interact='%s',sns='%s',modified='%s' WHERE  `memberid` ='{$_SESSION[memberid]}'",
		mysql_real_escape_string($_SESSION[memberid]),
		mysql_real_escape_string($_POST[handle]),
		mysql_real_escape_string($dep),
		mysql_real_escape_string($con),
		mysql_real_escape_string($cou),
		mysql_real_escape_string($_POST[yearly]),
		mysql_real_escape_string($_POST[messageline]),
		mysql_real_escape_string($_POST[message]),
		mysql_real_escape_string($_POST[sex]),
		mysql_real_escape_string($_POST[companyfriendship]),
		mysql_real_escape_string($_POST[place]),
		mysql_real_escape_string($_POST[interact]),
		mysql_real_escape_string($_POST[sns]),
		date('Y-m-d H:i:s')
	);
	
	mysql_query($sql) or die(mysql_error());
	//*/
	//header('Location: thanks.php');
	//exit();
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
        <li><a href="../select/subjectlist.php">講義一覧 &raquo;</a>   
          <ul>
          <?php
          	$allsubject = array('classcom', 'classculhumedu','classculhumspe', 'classculintedu','classculintspe','classculsocedu','classculsocspe','classsciedu','classscispe');
		$allsubjectname = array('共通教育', '人文学部 人間科学科 教職','人文学部 人間科学科 専門', '国際社会コミュニケーション学科 教職','国際社会コミュニケーション学科 専門','人文学部 社会経済学科 教職','人文学部 社会経済学科 専門','理学部 理学科,応用理学科 教職','理学部 理学科,応用理学科 専門');
          $i=0;
          while($i<count($allsubject)){
          ?>
          
            <li>
            <a href="../select/subjectlist.php?subject=<?php print($allsubject[$i])?>">
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
    <li><a href="../message/frommes.php">メッセージ &raquo;</a>
      <ul>   
        <li><a href="../message/frommes.php">受信BOX</a></li>   
        <li><a href="../message/tomes.php">送信BOX</a></li>   
        <li><a href="../message/send.php">作成</a></li>   
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
<div align="center">
<div id="in-box" align="left" class="radius">
<div align="center">
<h2>更新が完了しました</h2>

<a href="index.php">戻る</a>
　|　
<a href="../index.php">ホーム</a>

</div>


	<br><div id="topic-box">ID：</div><br>
	<div id="statement-box">
	<?php print($_SESSION[memberid]);?>
	</div>
	<br>
	<br><div id="topic-box">氏名：</div><br>
	<div id="statement-box">
	<?php print($_POST[lastname]." ".$_POST[firstname]);?>
	</div>
	<br>
	<br><div id="topic-box">ハンドルネーム：</div><br>
	<div id="statement-box">
	<?php print($_POST[handle]);?>
	</div>
	<br>
	<br><div id="topic-box">学部：
	(<?php
		if($_POST[privdep]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($dep);?>
	</div>
	<br>
	<br><div id="topic-box">学科：
	(<?php
		if($_POST[privcon]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($con);?>
	</div>
	<br>
	<br><div id="topic-box">コース：
	(<?php
		if($_POST[privcou]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($cou); ?>
	<?php if(empty($cou)){ print("<font size='2' color='#ff0000' >* コースを選択して下さい</font>"); } ?>
	</div>
	<br>
	<br><div id="topic-box">年次：
	(<?php
		if($_POST[privyea]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($_POST[yearly]);?>
	</div>
	<br>
	<br><div id="topic-box">一行紹介：</div><br>
	<div id="statement-box">
	<?php print($_POST[messageline]);?>
	</div>
	<br>
	<br><div id="topic-box">自己紹介文：
	(<?php
		if($_POST[privmes]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($_POST[message]);?>
	</div>
	<br>
	<br><div id="topic-box">性別：
	(<?php
		if($_POST[privsex]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($_POST[sex]);?>
	</div>
	<br>
	<br><div id="topic-box">交際ステータス：
	(<?php
		if($_POST[privcom]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($_POST[companyfriendship]);?>
	</div>
	<br>
	<br><div id="topic-box">よく出没する場所：
	(<?php
		if($_POST[privpla]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($_POST[place]);?>
	</div>
	<br>
	<br><div id="topic-box">知り合いたい対象：
	(<?php
		if($_POST[privint]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($_POST[interact]);?>
	</div>
	<br>
	<br><div id="topic-box">参加中のSNS：
	(<?php
		if($_POST[privsns]==='1'){
			print("公開");
		}else{
			print("非公開");
		}
	?>
	)</div>
	<br><br>
	<div id="statement-box">
	<?php print($_POST[sns]);?>
	</div>
	<br><br>
	<div align="center">
	<hr>
	<a href="index.php">戻る</a>
　|　
<a href="../index.php">ホーム</a>
</div>
<br><br>

</div>

<br>


<br><br>
</div>

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
