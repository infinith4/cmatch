<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />

	<!--MENU START-->
	<link href="menu/jquery.jdMenu.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery-1.3.1.js" type="text/javascript"></script>
<script src="menu/jquery.dimensions.js" type="text/javascript"></script>
<script src="menu/jquery.positionBy.js" type="text/javascript"></script>  
<script src="menu/jquery.bgiframe.js" type="text/javascript"></script>
<script src="menu/jquery.jdMenu.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
  $("ul.jd_menu").jdMenu();
  //$("ul.jd_menu").jdMenu({ showDelay: 200, hideDelay: 500 });
  //$("ul.jd_menu").jdMenu({ showDelay: 1000, hideDelay: 1000 });
  //$("ul.jd_menu").jdMenu({disableLinks: true});
});  
</script>
<!--MENU END-->
<title>メンバー一覧</title>
<!-- 全ページ共通start-->
<link rel="shortcut icon" href="img/icon06.ico" type="image/vnd.microsoft.icon">
<!-- 全ページ共通end-->

<style type="text/css">
	body {margin: 0px; padding: 0px; }
	body { background: #ffffff url("img/background.jpg") fixed left top }
</style>


	<link rel="stylesheet" type="text/css" href="css/flexigrid.pack.css" />

	<script type="text/javascript" src="js/flexigrid.pack.js"></script>
    <style type="text/css">
        body { font-family:Arial, Helvetica, Sans-Serif; font-size:0.8em;}
        #report { border-collapse:collapse;}
        #report h4 { margin:0px; padding:0px;}
        #report div.addinfo { float:left; margin-left:20px; margin-right:10px;}
        #report div.addinfoleft {color: #9933ff; float:left; margin-right:10px;}
        #report div.addinforight { float:right;}
        #report div.face { margin:10px; float:left;}
        #report ul { margin:10px 0 10px 40px; padding:0px;}
        #report th { font-size:0.8em; background:#7CB8E2 url(header_bkg.png) repeat-x scroll center left; color:#fff; padding:7px 15px; text-align:left;}
        #report td { font-size:0.8em; background:#C7DDEE none repeat-x scroll center left; color:#000; padding:7px 15px; }
        #report tr.odd td { font-size:0.8em; background:#fff url(row_bkg.png) repeat-x scroll center left; cursor:pointer; }
        #report div.arrow { background:transparent url(arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
        #report div.up { background-position:0px 0px;}
    </style>
    
    <script type="text/javascript">  
        $(document).ready(function(){
            $("#report tr:odd").addClass("odd");
            $("#report tr:not(.odd)").hide();
            $("#report tr:first-child").show();
            
            $("#report tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
            //$("#report").jExpand();
        });
    </script>
</head>
<body>
<p class='header'>
<img src='img/logo04-5.PNG'>
</p>
<?php
session_start();

if ($_SESSION['auth']===FALSE) {
	header('Location: index.php'); exit();
}

require('dbconnect.php');


print("<br><div id='loginmes-box' class='radius'>　". $_SESSION['name']);
print("さん、友達を探してみましょう。</div>");





//対象の講義を取得する


$recordset=mysql_query("SELECT * FROM profiles");








?>


<body>
<p class="boder">

<div id="jdmenuwrap">
  <ul class="jd_menu">   
    <li><a href="index.php">ホーム</a></li>
    <li><a href="members.php">メンバー &raquo;</a>   
      <ul>   
        <li><a href="members.php">登録メンバー</a></li>   
        <li>
        <a href="favoritemembers.php"
    		onClick="window.open('favoritemembers.php','win','width=500,height=400,menubar=no,status=no,scrollbars=yes,location=no') ; return false ;">
    		お気に入り</a>
    	</li>
      </ul>
    </li>
    <li><a href="#">講義 &raquo;</a>   
      <ul>   
        <li><a href="select/subjectlist.php">講義一覧 &raquo;</a>   
          <ul>
          <?php
          	$allsubject = array('classcom', 'classculhumedu','classculhumspe', 'classculintedu','classculintspe','classculsocedu','classculsocspe','classsciedu','classscispe');
		$allsubjectname = array('共通教育', '人文学部 人間科学科 教職','人文学部 人間科学科 専門', '国際社会コミュニケーション学科 教職','国際社会コミュニケーション学科 専門','人文学部 社会経済学科 教職','人文学部 社会経済学科 専門','理学部 理学科,応用理学科 教職','理学部 理学科,応用理学科 専門');
          $i=0;
          while($i<count($allsubject)){
          ?>
          
            <li>
            <a href="select/subjectlist.php?subject=<?php print($allsubject[$i])?>">
            <?php print($allsubjectname[$i]); ?></a>
            </li>
          <?php
          $i++;
          }
          ?>
          </ul>
        </li>
        <li><a href="classadd/classadd.php">講義追加</a></li>
      </ul>
    </li>
    <!--<li><a href="project/project.php">企画</a></li>-->
    <li><a href="message/frommes.php">メッセージ &raquo;</a>
      <ul>   
        <li><a href="message/frommes.php">受信BOX</a></li>   
        <li><a href="message/tomes.php">送信BOX</a></li>   
        <li><a href="message/send.php">作成</a></li>   
      </ul>
    </li>
    <li><a href="#">設定変更 &raquo;</a>   
      <ul>
      	<li><a href="profiles/index.php">プロフィール更新</a></li>
        <li><a href="#">講義変更</a></li>
      </ul>   
    </li>
    <li><a href="logout.php">ログアウト</a></li>
  </ul>   
</div>   
</p>


<div align="center">



	<table id="report" width="850" >
        <tr>
            <th>ハンドルネーム</th>
            <th>学部</th>
            <th>学科</th>
            <th>コース</th>
            <th>年次</th>
            <th></th>
        </tr>
	<?php

while ($table =mysql_fetch_assoc($recordset)){

$privrecord=mysql_query("SELECT * FROM privacyprofiles WHERE memberid='{$table[memberid]}'");
$privtable =mysql_fetch_assoc($privrecord);
?>



	
	<tr>
		<td>
 		<a href="membersclass.php?membersid=<?php print($table[memberid]);?>">
 		<b><font size="2" color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc33ff'">
 		<?php print(htmlspecialchars($table['handle'])); ?>
 		</font></b>
 		</a>
 		</td>
		<td>
		<font size="2">
		<?php
			if($privtable[privdep]==='1'){
				print(htmlspecialchars($table['department']));
			}else{
				print("");
			}
		?>
		</font>
		</td>
 		<td>
 		<font size="2">
 		<?php
			if($privtable[privcon]==='1'){
				print(htmlspecialchars($table['concentration']));
			}else{
				print("");
			}
		?>
		</font>
		</td>
 		<td>
 		<font size="2">
 		<?php
			if($privtable[privcou]==='1'){
				print(htmlspecialchars($table['course']));
			}else{
				print("");
			}
		?>
		</font>
		</td>
 		<td>
 		<font size="2">
 		<?php
			if($privtable[privyea]==='1'){
				print(htmlspecialchars($table['yearly']));
			}else{
				print("");
			}
		?>
		</font>
		</td>
		
		
		<td><div class="arrow"></div></td>
		</tr>
		<tr>
	            <td colspan="6">
	                <div class="face">
	                <a href="membersclass.php?membersid=<?php print($table[memberid]);?>">
	                <img src="img/nofaceimg.jpg" />
	                </a>
	                <p align="center">
		                <a href="membersclass.php?membersid=<?php print($table[memberid]);?>">
		 		<b><font size="2" color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc33ff'">
		 		<?php print(htmlspecialchars($table['handle'])); ?>
		 		</font></b>
		 		</a>
	                </p>
	                </div>
	                <div class="addinfo">
	                
	                <div class="addinfoleft">
	                
	                    一行紹介：<br><hr>
	                    性別：<br><hr>
	                    交際ステータス：<br><hr>
	                    よく出没する場所：<br><hr>
	                    知り合いたい対象：<br><hr>
	                    参加中のSNS：<br><hr>
	                </div>
	                <div class="addinforight">
	                	<font size="2">
		 		<?php
					if($privtable[privmes]==='1'){
						print(htmlspecialchars($table['messageline']));
					}else{
						print("");
					}
				?>
				</font>
				<br><hr>
	                    <font size="2">
		 		<?php
					if($privtable[privsex]==='1'){
						print(htmlspecialchars($table['sex']));
					}else{
						print("");
					}
				?>
				</font>
	                    <br><hr>
	                     	<font size="2">
			 		<?php
						if($privtable[privcom]==='1'){
							print(htmlspecialchars($table['companyfriendship']));
						}else{
							print("");
						}
					?>
				</font>
	                    <br><hr>
	                    <font size="2">
		 		<?php
					if($privtable[privpla]==='1'){
						print(htmlspecialchars($table['place']));
					}else{
						print("");
					}
				?>
				</font>
				<br><hr>
	                     	<font size="2">
		 		<?php
					if($privtable[privint]==='1'){
						print(htmlspecialchars($table['interact']));
					}else{
						print("");
					}
				?>
				</font>
				<br><hr>
	                     	<font size="2">
		 		<?php
					if($privtable[privsns]==='1'){
						print(htmlspecialchars($table['sns']));
					}else{
						print("");
					}
				?>
				</font>
	                    <br><hr>
	                </div>
	                </div>
	            </td>
	        </tr>
		
 	
 	
<?php 
}

?>
	</table>



</div>
<br><br>

<!-- 全ページ共通start-->
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
<!-- 全ページ共通end-->
</body>
</html>
