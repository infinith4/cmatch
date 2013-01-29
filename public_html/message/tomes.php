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
	<title>送信BOX</title>
	<!-- jQuery -->
	<script src="http://www.google.com/jsapi"></script>
	<script>google.load("jquery", "1.6.1");</script>
	<!-- //jQuery -->
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
</style>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'ja'}
</script>
<!--

a {  text-decoration: none}



-->
<!--
body { background: #ffffff url("img/img04.jpg") fixed left top }
-->

<script type="text/javascript">
<!--

$(function () {
    $('div.boxLink').click(function () {
        var boxLink = $(this).find('a');
        if (boxLink.attr('target') == '_blank') {
            window.open(boxLink.attr("href"));
        }
        else window.location = boxLink.attr('href');
        return false;
    });
    $('div.boxLink').hover(function () {
        $(this).addClass('hover');
    }, function () {
        $(this).removeClass('hover');
    });
});

// -->
</script>
<style type="text/css" >

div.boxLink {
	border: 0px solid #CCC;
	padding:3px;
	margin:0 0 10px;
}

div.hover{
	border: 0px solid #666;
	cursor: pointer;
	background-color: #e3e3e3;
}
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




$tablename="messages".$_SESSION[memberid];



?>

<?php


// htmlspecialcharsのショートカット
function h($value) {
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// 本文内のURLにリンクを設定
function makeLink($value) {
	return mb_ereg_replace("(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)", '<a href="\1\2">\1\2</a>' , $value);
}

print("<br>　ID:".$_SESSION['memberid']);
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
      	<li><a href="../profiles/index.php">プロフィール更新</a></li>
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
	<div id="menumes-box" class="radius">
	<div class="boxLink">
	　　<a href="send.php">
	<font color="#000000">作成</font>
	</a>
	</div>
	<div class="boxLink">
	　　<a href="frommes.php"><font color="#000000">受信BOX</font></a>
	</div>
	<div class="boxLink">
	<font size='5' color="#FF0000">|　</font><a href="tomes.php"><font color="#FF0000"><b>送信BOX</b></font></a>
	</div>
	<div class="boxLink">
	　　<a href="#"><font color="#000000">下書き</font></a>
	</div>
	</div>
	</td>

	<td valign="top">
	<div align="center">
	<div id="frommes-box" align="left" class="radius">
	<?php
		$recordfrom=mysql_query("SELECT * FROM $tablename WHERE (frommemberid='{$_SESSION[memberid]}') ORDER BY created DESC");//自分の送信したメッセージ
		
	?>
		

	
	
	<?php

	while ($tablefrom =mysql_fetch_assoc($recordfrom)){

		$recordprofiles=mysql_query("SELECT * FROM profiles WHERE (memberid='{$tablefrom[tomemberid]}')");
		$tableprofiles =mysql_fetch_assoc($recordprofiles);
	?><hr>
	<div class="boxLink">
	<table >
		<tr>
			
			<td width="20"></td>
 			<td width="150"><font size='2'><b><?php print(htmlspecialchars($tableprofiles[handle])); ?></b></font></td>
 			<td width="200"><a href='message.php?id=<?php print($tablefrom[id]); print("&"); print("message=to");?>'><b><?php print(htmlspecialchars($tablefrom[title])); ?></b></a></td>
 			<td width="320"><font color='#707070'><b><?php print(mb_substr($tablefrom[message] ,0,14));?></b><?php print("　..."); ?></font></td>
 			<td width="100"><b><font size='2'><?php print(htmlspecialchars($tablefrom[created])); ?></font></b></td>
 			
 		</tr>
 		
 		
	</table	>
	</div>

	<?php

	}

	?>
	<hr>





	</div>
	</div>
	</td>
</tr>
</table>

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