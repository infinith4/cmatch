<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
session_start();
require('../dbconnect.php');

if (!isset($_SESSION[memberid])) {//cookieに入っていなかったら。
	header('Location: ../index.php');
	print("<a href='../'>ホーム</a>");
	exit();
}

?>

<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>講義一覧</title>
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
	
<link href="../table/blue/style.css" rel="stylesheet" type="text/css" />
<script src="../table/jquery.tablesorter.js" type="text/javascript"></script>
<!--
<script src="../table/jquery.tablesorter.pager.js" type="text/javascript"></script>
-->
<script type="text/javascript">
$(function() {
  $("table").tablesorter();
  //$("table").tablesorter({debug: true});
  //$("table").tablesorter({ headers: { 1: {sorter:false}} });
  //$("table").tablesorter({sortList:[[2,1]]});
});   
</script>

</head>
<body>
<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>
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


<?php


$allsubject = array('classcom', 'classculhumedu','classculhumspe', 'classculintedu','classculintspe','classculsocedu','classculsocspe','classsciedu','classscispe');
$allsubjectname = array('共通教育', '人文学部 人間科学科 教職','人文学部 人間科学科 専門', '国際社会コミュニケーション学科 教職','国際社会コミュニケーション学科 専門','人文学部 社会経済学科 教職','人文学部 社会経済学科 専門','理学部 理学科,応用理学科 教職','理学部 理学科,応用理学科 専門');

$i=0;


?>
<!--各講義一覧START-->
<table>
<tr>
	<td valign="top" width="300" align="center">
		<div align='left'>
		
		<?php
		while($i<count($allsubject)){
		?>
			
			<br><br>
			&nbsp;
			<a href="subjectlist.php?subject=<?php print($allsubject[$i]); ?>">
			<b><font size='2' color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc33ff'" >
			<?php print($allsubjectname[$i]); ?>
			</b></font></a>
		<?php
		$i++;
		}
		?>
		
		<?php
			if(!empty($_REQUEST['subject'])){
		?>
		<br><br><br>
		&nbsp;
		<a href="../classadd/classadd.php?subject=<?php print($_REQUEST[subject]); ?>">
		<b><font size='2' color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc33ff'" >
		講義を追加
		</b></font></a>
		
		
		
		<?php
			}
		?>
		</div>
		
	</td>
<?php
if(empty($_REQUEST['subject'])){
	print("</tr></table>");
}
?>


<!--各講義一覧END-->


<?php
if(!empty($_REQUEST['subject'])){//講義一覧

	$tbsubject=$_REQUEST['subject'];

	$recordsub=mysql_query("SELECT * FROM $tbsubject");

?>
	<td valign="top">
	<b><font size="3" color="#FF0000">
	<?php
	
	if($_REQUEST[subject]===('classcom')){
	print('共通教育<br>');
	}elseif($_REQUEST[subject]===('classculhumedu')){
	print('人文学部 人間科学科 教職<br>');
	}elseif($_REQUEST[subject]===('classculhumspe')){
	print('人文学部 人間科学科 専門<br>');
	}elseif($_REQUEST[subject]===('classculintedu')){
	print('国際社会コミュニケーション学科 教職');
	}elseif($_REQUEST[subject]===('classculintspe')){
	print('国際社会コミュニケーション学科 専門');
	}elseif($_REQUEST[subject]===('classculsocedu')){
	print('人文学部 社会経済学科 教職<br>');
	}elseif($_REQUEST[subject]===('classculsocspe')){
	print('人文学部 社会経済学科 専門<br>');
	}elseif($_REQUEST[subject]===('classsciedu')){
	print('理学部 理学科,応用理学科 教職<br>');
	}elseif($_REQUEST[subject]===('classscispe')){
	print('理学部 理学科,応用理学科 専門<br>');
	}
	?>
	</b></font>
	<b><font color="#ff9900">
	(追加したい講義にcheckし、右の講義追加のボタンを押すと講義が追加されます)
	</font></b>
	<div id="demo">
		<form method="POST" action="submitsubjectlist.php" >
		<input type="hidden" name="selclass" value="<?php echo htmlspecialchars($_REQUEST[subject]); ?>">
		
  		<table cellspacing="1" class="tablesorter">   
    		<thead>
    		<tr>
			<th width="45">check</th>
			<th width="30">No</th>
			<th width="50">コード</th>
			<th width="300">講義名</th>
			<th>担当教員</th>
			<th width="50">学期</th>
			<th width="65">曜日・時限</th>
			<th width="35">年次</th>
			<!--<th>selclass</th>-->
		</tr>
		</thead>
		<tbody>
		<?php

		while ($tablesub =mysql_fetch_assoc($recordsub)){

		?>
		
		<tr>
			<td><input type="checkbox" name="code[]" value="<?php echo htmlspecialchars($tablesub['code']); ?>"></td>
	 		<td><?php print(htmlspecialchars($tablesub['No'])); ?></td>
	 		<td><?php print(htmlspecialchars($tablesub['code'])); ?></td>
	 		<td><?php print(htmlspecialchars($tablesub['subject'])); ?></td>
	 		<td><?php print(htmlspecialchars($tablesub['teacher'])); ?></td>
	 		<td><?php print(htmlspecialchars($tablesub['term'])); ?></td>
	 		<td><?php print(htmlspecialchars($tablesub['time'])); ?></td>
	 		<td><?php print(htmlspecialchars($tablesub['yearly'])); ?></td>
	 	</tr>
	 	<?php
	 	}
	 	?>
	</tbody>
	
	</table>
	
	</td>
	<td valign="top">
	<input type="submit" name="exereg" value="講義追加">
	</form>
	</td>
</tr>
</table>
<?php
}
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
</body>
</html>