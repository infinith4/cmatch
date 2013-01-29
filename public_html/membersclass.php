<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
# 認証を要求したいページの先頭に以下を記述します。
session_start();

require('dbconnect.php');
if(!empty($_REQUEST['membersid'])){
	$record_handle=mysql_query("SELECT * FROM profiles WHERE (memberid='{$_REQUEST['membersid']}')");
	$table_handle=mysql_fetch_assoc($record_handle);
	$members_handle=htmlspecialchars($table_handle['handle']);
}else{
	
	header("Location:members.php");
	print("データがありません。<br><br><a href='members.php'>メンバー一覧に戻る</a>");
	exit();
}

?>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="tablestyle.css" />
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
<title>
	<?php 
		print(htmlspecialchars($members_handle));
		print("さん");
	?>
</title>
<!-- 全ページ共通start-->
<link rel="shortcut icon" href="img/icon06.ico" type="image/vnd.microsoft.icon">
<!-- 全ページ共通end-->
<style type="text/css">
	body {margin: 0px; padding: 0px; }
	body { background: #ffffff url("img/background.jpg") fixed left top }
</style>
<style>
.bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 15px;
    -webkit-border-radius: 15px;
    border-radius: 15px;
    -webkit-box-shadow: 0 1px 1px #ccc; 
    -moz-box-shadow: 0 1px 1px #ccc; 
    box-shadow: 0 1px 1px #ccc;         
    text-align: center;
}
.bordered th {
    background-color: #cc33ff;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ffcccc), to(#cc33ff));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #cc33ff);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #cc33ff);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #cc33ff);
    background-image:      -o-linear-gradient(top, #ebf3fc, #cc33ff);
    background-image:         linear-gradient(top, #ebf3fc, #cc33ff);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
}
th:first-child {
    -moz-border-radius: 15px 0 0 0;
    -webkit-border-radius: 15px 0 0 0;
    border-radius: 15px 0 0 0;
    text-align: center;
}
 
th:last-child {
    -moz-border-radius: 0 15px 0 0;
    -webkit-border-radius: 0 15px 0 0;
    border-radius: 0 15px 0 0;
    text-align: center;
}
.bordered td
{
    background: #e0fff6;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;
    text-align: center;
}
.bordered tr:last-child td:first-child {
    -moz-border-radius: 0 0 0 15px;
    -webkit-border-radius: 0 0 0 15px;
    border-radius: 0 0 0 15px;
}

.bordered tr:last-child td:last-child {
    -moz-border-radius: 0 0 15px 0;
    -webkit-border-radius: 0 0 15px 0;
    border-radius: 0 0 15px 0;
}


.bordered td:hover
{
    background: #faeeb2;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;
    text-align: center;
}
</style>
</head>
<body>
<p class='header'>
<img src='img/logo04-5.PNG'>
</p>
<?php
//membersclass.php


/*
if ($_SESSION['auth']===FALSE) {
	header('Location: index.php'); exit();
}
*/
/*
header('Expires: -1'); //下記「余談」の追記も参照
header('Cache-Control:');
header('Pragma:');
*/

// htmlspecialcharsのショートカット
function h($value) {
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// 本文内のURLにリンクを設定します
function makeLink($value) {
	return mb_ereg_replace("(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)", '<a href="\1\2">\1\2</a>' , $value);
}



//ユーザーの登録済み講義番号を取得.

$record_subject=mysql_query("SELECT * FROM submitsubject WHERE (memberid='{$_REQUEST['membersid']}')");

$i=1;

//$n=mysql_query("SELECT COUNT(*) FROM submitsubject");//？


//print ("count<br>".$n."<br>");

$No=array();


while($table=mysql_fetch_assoc($record_subject)){
	
	$No[$i]=htmlspecialchars($table['No']);
	//print($i.":");
	//print($No[$i]);//ユーザーの登録番号を表示	
	$i++;
	//print(".<br>");
}

//print_r($No);//Array ( [1] => 12 [2] => 10 ) と表示される



$n=$i-1;

//print("<br><b><font color="#FF0000" size="3">あなたの登録講義数:".$n."</b></font>");

$selecttime=array(
array('月1','月2','月3','月4','月5','月6'),
array('火1','火2','火3','火4','火5','火6'),
array('水1','水2','水3','水4','水5','水6'),
array('木1','木2','木3','木4','木5','木6'),
array('金1','金2','金3','金4','金5','金6'));

$record_profiles=mysql_query("SELECT * FROM profiles WHERE (memberid='{$_REQUEST[membersid]}')");
$tableprofiles=mysql_fetch_assoc($record_profiles)


?>

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

<div align="left">

 
<table>
<tr>
	<td valign="top" width="200">
	<?php
	if($_REQUEST[memberid]!==$_SESSION[memberid]){
	?>
	<!--<a href="message/send.php?membersid=<?php print($_REQUEST[membersid])?>&type=new">
	<b><font color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc33ff'">
	メッセージを送る
	</font></b>
	</a>-->
	<a href="message/send.php?membersid=<?php print($_REQUEST[membersid])?>&type=new">
	<img src="img/send01.png" onmouseout="this.src='img/send01.png';"  onmouseover="this.src='img/onsend01.png';">
	</a>
	
	
	<?php
	}
	?>

	</td>
	<td>
	<div align="center">
  		<div id="membersclasstable-box" class="radius">
  	<?php 
  	
		print(htmlspecialchars($members_handle));
		print("さん");
	?>
		の登録している講義を表示しています。<br>
		<?php print('登録講義数は、<b><font color="#FF0000" size="3">' . $n . "</b></font>です。");?>
	
	
	<table border="1" cellpadding="5"  class="bordered"
	  summary="登録している講義" bordercolor="#3399ff" bordercolorlight="#FF0000" bordercolordark="#3399ff">
	    <colgroup> 
	        <col style="width:5px;" />
	        <col style="width:140px;" />
	        <col style="width:140px;" />
	        <col style="width:140px;" />
	        <col style="width:140px;" />
       		<col style="width:140px;" />
    		</colgroup>
  	<p>

 	 <tr>
 	 <th></th>
   	 <th>月</th>
   	 <th>火</th>
   	 <th>水</th>
   	 <th>木</th>
   	 <th>金</th>
  	</tr>
  	<tr>
  	<?php
  		$m=0;
  		$n=0;
  		while($n<=5){//行
  			$i=$n+1;
  			print("<tr>");
  			print("<td>".$i."</td>");
  			while($m <= 4){
  		
  		
  		
  				print("<td>");
  				///////講義を取得////////////
    		
    				$time=$selecttime[$m][$n];
    				//print($selecttime[0][1]);
    				$record=mysql_query("SELECT * FROM submitsubject WHERE (memberid='{$_REQUEST[membersid]}') AND (time LIKE '%{$time}%')");
    				$table=mysql_fetch_assoc($record);
    				//print("table['selclass']:".$table['selclass']."<br>");
    				//print("table['code']:".$table['code']."<br>");
    				$selclass=$table['selclass'];
    				$record_class=mysql_query("SELECT * FROM $selclass WHERE (code='{$table['code']}')");
    				if(!empty($record_class)){//登録されていない曜日・時限の講義は非表示(これがないとエラーが表示される)
    					$table_class=mysql_fetch_assoc($record_class);
    					print($table_class['subject']."<br>");
    					print("(".$table_class['teacher'].")<br>");
    					//print("(".$table['code'].")<br>");
    			
    					////////受講している人のhandlenameを表示する/////////////////
    			
    					//submitsubjectからcodeに一致するレコードのmemberidを、取得。
    					$record_matchcnt=mysql_query("SELECT * FROM submitsubject WHERE (code='{$table['code']}')");
    					///*
    					
    					$i=0;
    					while($table_matchcnt=mysql_fetch_assoc($record_matchcnt)){
    						$i++;
    			
    					}
    					//print("i:".$i);
    					if($i>1){
    						?>
    						<!--
    						<a href="classmembers.php?code=<?php print($table['code']."&selclass=".$selclass); ?>"
    						onClick="window.open('classmembers.php?code=<?php print($table['code']."&selclass=".$selclass); ?>','win','width=500,height=400,menubar=no,status=no,scrollbars=yes,location=no') ; return false ;">
    						講義受講者
    						</a>-->
    						<a href="classmembers.php?code=<?php print($table['code']."&selclass=".$selclass); ?>"
    						onClick="window.open('classmembers.php?code=<?php print($table['code']."&selclass=".$selclass); ?>','win','width=500,height=400,menubar=no,status=no,scrollbars=yes,location=no') ; return false ;">
    						<img src="img/classmembers04-min.png" onmouseout="this.src='img/classmembers04-min.png';"  onmouseover="this.src='img/onclassmembers04-min.png';">
    						</a>
    						<?php
    					
    					}
    					
    			
    			
    				}
    			
    			
    			
    			
  			
  			print("</td>");
  			$m++;
  			}
  		print("</tr>");
  		$m=0;
  		$n++;
  		}
  	
  	?>
  	</tr>	
	</table>
	<br><br>
	</div></div>
	</td>
	
	
	<td  valign="top" >
	<?php
	$privrecord=mysql_query("SELECT * FROM privacyprofiles WHERE memberid='{$_REQUEST[membersid]}'");
	$privtable =mysql_fetch_assoc($privrecord);
	?>
		<div align="center" id="memclapro-box"  class="radius">プロフィール
		<table border="0" bordercolor="#3399ff" bordercolorlight="#FF0000" bordercolordark="#3399ff">
		<tr>
			<td width="120" hight="120">
			<img src='img/profile/nofaceimg.jpg'>
			</td>
			<td width="150" hight="150" align="center">
			<!--
			<img src='img/profile/alpha.png'>
			<img src='img/profile/epsilon.png'>
			<img src='img/profile/pi.png'>
			-->
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">ハンドルネーム</font>
			</td>
			<td width="150">
			<?php print($tableprofiles[handle]); ?>
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">学部</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privdep]==='1'){
				print($tableprofiles[department]);
			}else{
				print("(非公開)");
			}
			?>
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">学科</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privcon]==='1'){
				print($tableprofiles[concentration]);
			}else{
				print("(非公開)");
			}
			?>
			<?php  ?>
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">コース</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privcou]==='1'){
				print($tableprofiles[course]);
			}else{
				print("(非公開)");
			}
			?>
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">年次</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privyea]==='1'){
				print($tableprofiles[yearly]);
			}else{
				print("(非公開)");
			}
			?>
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">紹介文</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privmes]==='1'){
				print($tableprofiles[message]);
			}else{
				print("(非公開)");
			}
			?>
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">性別</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privsex]==='1'){
				print($tableprofiles[sex]);
			}else{
				print("(非公開)");
			}
			?>
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">交際ステータス</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privcom]==='1'){
				print($tableprofiles[companyfriendship]);
			}else{
				print("(非公開)");
			}
			?>
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">よく出没する場所</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privpla]==='1'){
				print($tableprofiles[place]);
			}else{
				print("(非公開)");
			}
			?>
			</td>
		</tr>
		<tr>
			<td width="130">
			<font size="2">知り合いたい対象</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privint]==='1'){
				print($tableprofiles[interact]);
			}else{
				print("(非公開)");
			}
			?>
			</td>
		</tr>
		<tr>
			<td width="120">
			<font size="2">登録中のSNS</font>
			</td>
			<td width="150">
			<?php
			if($privtable[privsns]==='1'){
				print($tableprofiles[sns]);
			}else{
				print("(非公開)");
			}
			?>
			</td>
		</tr>
		</table>
		</div>
	</td>

</tr>
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