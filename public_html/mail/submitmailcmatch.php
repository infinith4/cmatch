<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CourseMatch</title>
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
      	<li><a href="../profiles/index.php">プロフィール更新</a></li>
        <li><a href="#">講義変更</a></li>
      </ul>   
    </li>
    <li><a href="../logout.php">ログアウト</a></li>
  </ul>   
</div>   
</p>
<?php

if(!empty($_POST[name])&&!empty($_POST[email])&&!empty($_POST[title])&&!empty($_POST[message])){
	mb_language("Ja") ;
	mb_internal_encoding("utf-8");
	$mailto="infinith4@gmail.com";
	$subject="$_POST[title]";
	$content="$_POST[message]";
	$mailfrom="From:" .mb_encode_mimeheader("$_POST[name]") ."<$_POST[email]>";
	mb_send_mail($mailto,$subject,$content,$mailfrom);
	print("<p>　送信が完了しました。</p>");
}else{
	print("<p>　入力されていない項目があります。</p>");
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
<br>
</body>
</html>