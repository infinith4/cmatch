<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
session_start();

//直接アクセスした場合
if (!isset($_SESSION['memberid'])) {
	header('Location: ../index.php'); exit();
}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<title>講義追加</title>
	<!--MENU START-->
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
<!--MENU END-->
	<!-- 全ページ共通start-->
	<link rel="shortcut icon" href="../img/icon06.ico" type="image/vnd.microsoft.icon">
	<!-- 全ページ共通end-->
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<style type="text/css">
	body {margin: 0px; padding: 0px; }
	TD{
	font-size:12px;
	}
	</style>
<!-- 5秒後に移動する場合 -->
<META http-equiv="refresh" content="10; url=subjectlist.php?subject=<?php print($_POST[selclass]); ?>">
</head>
<body>

<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>

<?php

require('../dbconnect.php');


$memberid=$_SESSION['memberid'];//ログインしているユーザーのid
if(empty($_POST[code])){
?>
	講義を選択して下さい<br><br>
	<a href="subjectlist.php?subject=<?php print($_POST[selclass]); ?>">戻る</a>
<?php
exit();
}


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
    <li><a href="../message/frommes.php">メッセージ &raquo;</a>
      <ul>   
        <li><a href="../message/frommes.php">受信BOX</a></li>   
        <li><a href="../message/tomes.php">送信BOX</a></li>   
        <li><a href="../message/send.php">作成</a></li>   
      </ul>
    </li>
    <li><a href="#">設定変更 &raquo;</a>   
      <ul>
      	<li><a href="../profiles/index.php">プロフィール更新</a></li>
        <li><a href="#">講義変更</a></li>
      </ul>   
    </li>
    <li><a href="../logout.php">ログアウト</a></li>
  </ul>   
</div>   
</p>


<div align="center">
10秒後に移動します。
10秒たっても移動しない場合は
<a href="subjectlist.php?subject=<?php print($_POST[selclass]); ?>">こちら</a>をクリックしてください。<br><br>

<div id="in-box">


<?php


//print("code:");
//print_r($_POST[code]);
//print("<br>");

$selclass=$_POST[selclass];
//print("count:".count($_POST[code])."<br>");

$i=0;

while($i<count($_POST[code])){

	//POSTされたcodeのtimeを取得
	$sqlclass = "SELECT * FROM  $selclass WHERE (code='{$_POST[code][$i]}')";
	$recordclass = mysql_query($sqlclass) or die(mysql_error());
	$tableclass = mysql_fetch_assoc($recordclass);
	
	print("<b>コード：　<font color='#0066cc'>".$_POST[code][$i]."</font><br>");
	print("科目名：　<font color='#0066cc'>".$tableclass[subject]."</font><br>");
	print("教員名：　<font color='#0066cc'>".$tableclass[teacher]."</font><br>");
	print("曜日・時限：　<font color='#0066cc'>".$tableclass[time]."</font><br>");
	
	//print("codeのtimeの文字数:".mb_strlen($tableclass[time], "UTF-8"));//codeのtimeの文字数
	//print("<br>");
	
	
	$char=$tableclass[time];//分割文字列
	
	$j=0;
	while($j<mb_strlen($tableclass[time])/2){
		//print("subchar:");
		//print(mb_substr( $char, $j, 2 , "UTF-8"));
		$subchar[]=mb_substr( $char, $j, 2 , "UTF-8");
		//print("<br>");
		
		$j=$j+2;
	}
	
	
	$j=0;
	
	while($j<count($subchar)){
	
		$sqlsub = "SELECT * FROM  submitsubject WHERE (memberid='{$_SESSION[memberid]}') AND (time LIKE '%{$subchar[$j]}%')";
		$recordsub = mysql_query($sqlsub) or die(mysql_error());
		$tablesub = mysql_fetch_assoc($recordsub);//登録している講義のtime
		
		if(empty($tablesub)){
			$sql = sprintf("INSERT INTO submitsubject SET memberid='%s', code='%s', selclass='%s',time='%s'",
					mysql_real_escape_string($memberid),
					mysql_real_escape_string($_POST[code][$i]),
					mysql_real_escape_string(htmlspecialchars($_POST[selclass])),
					mysql_real_escape_string($tableclass[time])
					);
			print("<br><font color='#0066cc'>上記の科目は、追加されました</font><br></b>");
			mysql_query($sql) or die(mysql_error());
			$j=count($subchar);//追加は一度だけ
		}else{
			print("<br><font color='#0066cc'>上記の科目は、重複しているため追加できませんでした</font><br></b>");
			$j=count($subchar);//追加は一度だけ
		}
		
	
	$j++;

	}	
		
		
		
		
print("<br>");
$subchar=array();
$tablesub='';
$i++;

}
?>
</div>
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

</body>
</html>