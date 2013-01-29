<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	</style>

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
    		onClick="window.open('favoritemembers.php','win','width=500,height=400,menubar=no,status=no,scrollbars=yes,location=no') ; return false ;">
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
        <li><a href="classadd.php">講義追加</a></li>
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
<div id="in-box" align="" class="radius">
<font size="5" color="#000000"><b>講義追加</b></font><br><br>

<a href="http://www-kulas.jimu.kochi-u.ac.jp/public/syllabus/SyllabusAll.aspx" target="_blank">
<font color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#FF0000'">シラバス検索</font></a>
より情報を取得し、下記の全てに入力して下さい。<br>
<br>

<?php
session_start();
//print("selclass:".$_SESSION[selclass]); 
print("<b><font color='#FF0000'>");

if(!empty($_REQUEST[subject])){

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
	
}
print("</font></b>");

?>

<br>
<form method="POST" action="submitclassadd.php" >
<table border="0">
<tbody>

<?php

if(!empty($_REQUEST[subject])){
?>


<input type="hidden" name="selclass" value="<?php print($_REQUEST[subject]); ?>">

<?php
}else{
?>

	<tr>
	<td>学科・学部</td>
	<td>
	<SELECT name="selclass" size="9">
		<OPTION value="classcom">共通教育</OPTION>
		<OPTION value="classculhumspe">人文学部 人間科学科 専門</OPTION>
		<OPTION value="classculhumedu">人文学部 人間科学科 教職</OPTION>
		<OPTION value="classculintspe">国際社会コミュニケーション学科 専門</OPTION>
		<OPTION value="classculintedu">国際社会コミュニケーション学科 教職</OPTION>
		<OPTION value="classculsocspe">人文学部 社会経済学科 専門</OPTION>
		<OPTION value="classculsocedu">人文学部 社会経済学科 教職</OPTION>
		<OPTION value="classscispe">理学部 理学科,応用理学科 専門</OPTION>
		<OPTION value="classsciedu">理学部 理学科,応用理学科 教職</OPTION>
	</SELECT>
	</td>
	</tr>
<?php
}
?>
	
	<tr>
		<td>時間割コード<br><font size="1" color="#FF0000">半角で入力して下さい</font></td>
		<td><input size="35" type="text" name="code"></td>
	</tr>
	<tr>
		<td>科目名</td>
		<td><input size="35" type="text" name="subject"></td>
	</tr>
	<tr>
		<td>担当教員</td>
		<td><input size="35" type="text" name="teacher"></td>
	</tr>
	<tr>
		<td>開講期</td>
		<td>
			<input type="radio" name="term" value="１学期">1学期
			<input type="radio" name="term" value="２学期">2学期
		</td>
	</tr>
	<tr>
		<td>曜日・時限<br><font size="1" color='#FF0000'>※複数時限にわたる場合は、<br>
		Shiftまたは、Ctrlキーを<br>
		押しながらクリックして下さい。<br><br>
		また、1つの曜日に渡る場合は、<br>
		上の方の曜日・時限を指定して下さい。<br><br>
		3つ以上に渡る曜日の場合は、<br>
		<a href='../mail/mailcmatch.php' target='_blank'>メール</a>
		で、お知らせ下さい。
		</font></td>
		
		<td>
		<SELECT NAME="day1" size="6">
		<OPTION VALUE="" SELECTED>(曜日を選択してください)
		<OPTION VALUE="月">月曜日
		<OPTION VALUE="火">火曜日
		<OPTION VALUE="水">水曜日
		<OPTION VALUE="木">木曜日
		<OPTION VALUE="金">金曜日
		</SELECT>
		<SELECT NAME="daytime1[]" size="7" multiple>
		<OPTION VALUE="" SELECTED>(時限を選択してください)
		<OPTION VALUE="1">1
		<OPTION VALUE="2">2
		<OPTION VALUE="3">3
		<OPTION VALUE="4">4
		<OPTION VALUE="5">5
		<OPTION VALUE="6">6
		</SELECT>
		<br>
		<SELECT NAME="day2" size="6">
		<OPTION VALUE="" SELECTED>(曜日を選択してください)
		<OPTION VALUE="月">月曜日
		<OPTION VALUE="火">火曜日
		<OPTION VALUE="水">水曜日
		<OPTION VALUE="木">木曜日
		<OPTION VALUE="金">金曜日
		</SELECT>
		<SELECT NAME="daytime2[]" size="7" multiple>
		<OPTION VALUE="" SELECTED>(時限を選択してください)
		<OPTION VALUE="1">1
		<OPTION VALUE="2">2
		<OPTION VALUE="3">3
		<OPTION VALUE="4">4
		<OPTION VALUE="5">5
		<OPTION VALUE="6">6
		</SELECT>
		</td>
	</tr>
	<tr>
		<td>対象年次：</td>
		<td><SELECT name="yearly">
			<OPTION value="1">1</OPTION>
			<OPTION value="2">2</OPTION>
			<OPTION value="3">3</OPTION>
			<OPTION value="4">4</OPTION>
			<OPTION value="5">5</OPTION>
			<OPTION value="6">6</OPTION>
		</SELECT>
		<br><br>
		</td>
		
	</tr>
	<tr>
		<td>
		<input type="checkbox" name="type" value='attend' checked><br>
		<font size="2" color="#FF0000">
		受講していない場合は、<br>
		checkを外して下さい</font>
		</td>
		<td></td>
	</tr>
	<!--
	<tr>
		<td>内容</td>
		<td>
			<textarea name="text" cols="80" rows="25"></textarea>
		</td>
	</tr>
	-->
	<tr>
	
		<td colspan="2" align="center"><br>
		<input type="submit" name="exereg" value="送信">
			<!-- <input type="submit" name="cancelreg" value="キャンセル"> -->
			<br>
			<font size="4" color="#FF0000">送信ボタンを押す前に、送信する内容をご確認ください。</font>
			<br><br><br>
			</td>
	</tr>
	
	</tbody>
</table>
</form>
</div></div>

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
<br>
</body>
</html>