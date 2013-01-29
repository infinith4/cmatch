<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />

<title>お気に入り</title>
<!-- 全ページ共通start-->
	<link rel="shortcut icon" href="../img/icon06.ico" type="image/vnd.microsoft.icon">

	
	<link href="../menu/jquery.jdMenu.css" rel="stylesheet" type="text/css" />
	<script src="../scripts/jquery-1.3.1.js" type="text/javascript"></script>
	<script src="../menu/jquery.dimensions.js" type="text/javascript"></script>
	<script src="../menu/jquery.positionBy.js" type="text/javascript"></script>  
	<script src="../menu/jquery.bgiframe.js" type="text/javascript"></script>
	<script src="../menu/jquery.jdMenu.js" type="text/javascript"></script>

	<script type="text/javascript">
	body { background: #ffffff url("img/background.jpg") fixed left top }

$(function() {
  $("ul.jd_menu").jdMenu();
  //$("ul.jd_menu").jdMenu({ showDelay: 200, hideDelay: 500 });
  //$("ul.jd_menu").jdMenu({ showDelay: 1000, hideDelay: 1000 });
  //$("ul.jd_menu").jdMenu({disableLinks: true});
});  

</script>

</head>

<body>
<?php
session_start();
//session_regenerate_id(TRUE);

require('../dbconnect.php');
?>
<?php

	$tablename="favorite".$_SESSION[memberid];

    	

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
<div align="center">
    	<?php
    	$n=0;
    	$recordfav=mysql_query("SELECT * FROM $tablename");
    	
		while($tablefav=mysql_fetch_assoc($recordfav)){
			
			$recordpro=mysql_query("SELECT * FROM profiles WHERE (memberid='{$tablefav[favmemberid]}')");
			$tablepro=mysql_fetch_assoc($recordpro);
			
			
			//print("<td>".$tablepro[handle]."</td>");
			$membersid[]=$tablefav[memberid];
			$membershan[]=$tablepro[handle];
			
			$n++;
			
			
		}
		print("お気に入り：".$n."人<br><br>");
		$row=$n%5;
		//print($row."行<br>");
		//print("<table border='1'><tr>");
		$i=0;
		
		while($i<$n){
			
			
			//print("i:".$i);
			if($i %5===0){
			?>
			
			<a href="send.php?membersid=<?php print($membersid[$i]."&type"); ?>=new" target='_blank'><?php print($membershan[$i])?></a>
			
			<?php	
			}elseif($i %5===4){
			?>	
			<a href="send.php?membersid=<?php print($membersid[$i]."&type"); ?>=new" target='_blank'><?php print($membershan[$i])?></a>
			<br>
				
			<?php	
				
			}else{
			?>	
			<a href="send.php?membersid=<?php print($membersid[$i]."&type"); ?>=new" target='_blank'><?php print($membershan[$i])?></a>
			
			<?php	
				
			}
			$i++;
		}
	
    		
    	?>
    	<hr>
    	<?php
    	$n=0;
    	$tablename="messages".$_SESSION[memberid];
    	$recordmes=mysql_query("SELECT * FROM $tablename");
    	
		while($tablemes=mysql_fetch_assoc($recordmes)){
			if($_SESSION[memberid]!==$tablemes[tomemberid]){
				$recordpro=mysql_query("SELECT * FROM profiles WHERE (memberid='{$tablemes[tomemberid]}')");
				$tablepro=mysql_fetch_assoc($recordpro);
				
				$tomembersid[]=$tablemes[tomemberid];
				$tomembershan[]=$tablepro[handle];
				//print("to:".$tablemes[tomemberid]."<br>");
				$n++;
				}
			
			
			
		}
		//print($n."<br>");
		//print($_SESSION[memberid]."<br>");
		//print_r($tomembersid);
		//print("<br>");
		$tomembersid=array_unique($tomembersid);//重複削除
		$n=count($tomembersid);
		print("履歴：".$n."人<br><br>");
		$row=$n%5;
		//print($row."行<br>");
		//print("<table border='1'><tr>");
		$i=0;
		
		while($i<$n){
			
			
			//print("i:".$i);
			if($i %5===0){
			?>
			
			<a href="send.php?membersid=<?php print($tomembersid[$i]."&type"); ?>=new" target='_blank'><?php print($tomembershan[$i])?></a>
			
			<?php	
			}elseif($i %5===4){
			?>	
			<a href="send.php?membersid=<?php print($tomembersid[$i]."&type"); ?>=new" target='_blank'><?php print($tomembershan[$i])?></a>
			<br>
				
			<?php	
				
			}else{
			?>	
			<a href="send.php?membersid=<?php print($tomembersid[$i]."&type"); ?>=new" target='_blank'><?php print($tomembershan[$i])?></a>
			
			<?php	
				
			}
			$i++;
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