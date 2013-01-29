<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CourseMatch</title>
	<link rel="stylesheet" type="text/css" href="../style.css" />
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


	<style type="text/css">
	body {margin: 0px; padding: 0px; }

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


<body style="margin: 0px;">
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
    <li><a href="../project/project.php">企画</a></li>
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
        <li><a href="../subject/index.php">講義変更</a></li>
      </ul>   
    </li>
    <li><a href="../logout.php">ログアウト</a></li>
  </ul>   
</div>   
</p>


<div align="center">
<div id="project-box">

<?php


?>

<table border="1"  cellspacing=0 cellpadding=0>
	<tr align="center">
		<td>
			<div id="project-left">
			<img src="../img/projectsample.png" alt="" width=120 height=120 border='1'>
			</div>

		</td>
		<td width=700>
			<h1>講義名</h1>
			<h3>講義名</h3>
			<div id="promes" align="left">
			<font color="#FF0000" size="2">news</font>
			
			</div>
		
		</td>
		<td width=210>
			<a href="ranking.php">ランキング</a>
			<br>
			評価する
		
		</td>
	</tr>
	<tr align="center">
		<td>
			<div >
			</div>

		</td>
		<td width=700>
			<div id="promes" align="left">
			
			<font size="2">
			<b>内容：</b>
			</div>
			<div id="promes" align="left">
			<font size="2">
			<b>教科書：</b><br><br>
			　<a href="http://opac.iic.kochi-u.ac.jp/webopac/catsre.do" target="_blank" alt="高知大学図書館" title="高知大学図書館">OPACで検索</a>　|　<a href="amazon">Amazonで検索</a><br><br>
			<b>試験：</b><br><br>
			<b>出席：</b><br><br>
			</font>
			</div>
			<div align="left">
			　　　コメント
			</div>
			<div id="procom"  align="left">
			<div id="procomnew">
			<font size="2">
			新規<br>
			</div>
			<div align="right">
				<div id="procomrep" align="left">
				<font size="2">
				返信<br>
				</div>
			</div>
			
			</font>
			</div>
		
		</td>
		<td width=210 valign="top"><br>
			<a href="#">知り合いたい同士</a><br><br>
			<a href="#">図書売りたい同士</a>
			<br>
		
		</td>
	</tr>
</table>
<br><br>
</div>

</body>

</html>