<?php
session_save_path("/home/cmatch/public_html/tmp");


if(empty($_COOKIE["SESSID"])){
header("Location: cookiesave.cgi");
}

require('dbconnect.php');


session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CourseMatch</title>
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

<!--popup start-->
<!--
<link href="popup/window.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery-1.1.2.js" type="text/javascript"></script>
<script src="popup/interface.js" type="text/javascript"></script>
<script src="popup/window.js" type="text/javascript"></script>
-->
<!--popup end-->

	<style type="text/css">
	body {margin: 0px; padding: 0px; }

<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'ja'}
</script>
<!--

a {  text-decoration: none}



-->

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

<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
function pop(obj) {
var w_size=350;
var h_size=150;
// 表示するウィンドウの位置
var l_position=Number((window.screen.width-w_size)/2);
var t_position=Number((window.screen.height-h_size)/2);
wobj = window.open('', 'pop','width='+w_size+', height='+h_size+', left='+l_position+', top='+t_position);
obj.target = "pop";
wobj.focus();
return true;
}
</script>


</head>


<body style="margin: 0px;">



<?php

//session_regenerate_id(TRUE);


/*
if ($_SESSION['auth']!==TRUE) {
	header('Location: index.php'); exit();
}
*/

print("
<div class='header'>

<img src='img/logo04-5.PNG'>
<div align='right'>
<a href='http://b.hatena.ne.jp/entry/' class='hatena-bookmark-button' data-hatena-bookmark-layout='standard' title='このエントリーをはてなブックマークに追加'><img src='http://b.st-hatena.com/images/entry-button/button-only.gif' alt='このエントリーをはてなブックマークに追加' width='20' height='20' style='border: none;' /></a><script type='text/javascript' src='http://b.st-hatena.com/js/bookmark_button.js' charset='utf-8' async='async'></script>
<a href='https://twitter.com/share' class='twitter-share-button' data-url='http://w9.oroti.net/~cmatch/' data-text='CourseMatch ' data-count='horizontal' data-via='tashirohiro4'>Tweet</a><script type='text/javascript' src='//platform.twitter.com/widgets.js'></script>
<g:plusone size='medium' href='http://w9.oroti.net/~cmatch/'></g:plusone>
<div class='fb-like' data-href='http://w9.oroti.net/~cmatch/' data-send='false' data-layout='button_count' data-width='50' data-show-faces='false'></div>
<!--
<iframe src='http://www.facebook.com/plugins/like.php?locale=ja_JP&href=http://w9.oroti.net/~cmatch/&layout=button_count&show_faces=true&width=100&action=recommend&colorscheme=light&height=22' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:100px; height:20px;' allowTransparency='true'></iframe>

<iframe src='http://www.facebook.com/plugins/like.php?locale=en_US&href=http://w9.oroti.net/~cmatch/&layout=button_count&show_faces=true&width=100&action=like&colorscheme=light&height=80' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:100px; height:80px;' allowTransparency='true'></iframe>
 -->
 <!--
<a href='http://www.google.com/bookmarks/mark?op=edit&bkmk=<$ArticlePermalink$>&title=<$BlogTitle URIESCAPE$>' target='_blank'>
  <img alt='Googleブックマークに追加' src='http://www.google.co.jp/favicon.ico' border='0' width='16' height='16' />
</a>
<a href='javascript:void window.open('http://bookmarks.yahoo.co.jp/bookmarklet/showpopup?t='+encodeURIComponent(document.title)+'&u='+encodeURIComponent(location.href)+'&ei=UTF-8','_blank',',scrollbars=1,resizable=1',0);'>
<img src='http://i.yimg.jp/images/sicons/ybm16.gif' width='16' height='16' alt='Yahoo!ブックマークに登録' style='border:none;'>
</a>
<a href='http://del.icio.us/post?url=<$ArticlePermalink$>&title=<$BlogTitle URIESCAPE$>'>
<img src='img/bookmark/delicious.gif' width='16' height='16' alt='del.icio.us it!' style='border: none;vertical-align: middle;' />
</a>
-->
</div>
</div>
");

require_once('login.php');
print("

<div align='right'>
<table>
<tr>
	<td width='65%'>
	<div id='loginmes-box' class='radius'>
　CourseMatchは、高知大学の学部生が受講している講義を登録し、登録した学生同士が観覧できます.　　　　　　　　　　　<br>
　　現在、<b><font color='FF0000'>
");
$sql = "select * from members";
$result = mysql_query($sql) or die ("failed");
$count = mysql_num_rows($result);
print($count . "</font></b>人の学生が登録しています。<br>");
print("
</div></td>
<td align='right' width='35%'>

</td>
</tr>
</table>
</div>
");


//print("SESSION:".$_SESSION);



/*
header('Expires: -1'); 
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

//print("<img src='img/logo01-2.PNG'><p>CourseMatchは、高知大学の学部生が受講している講義を登録し、登録した学生同士が観覧できます。</p>");
//require('dbconnect.php');





//print("　　ようこそ、".htmlspecialchars($_SESSION['name'], ENT_QUOTES));
//print("さん");

//$member_id="1";




/*
$sql = sprintf('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC LIMIT %s, 5',
	$start
);

*/


//print("<br>POST". $_POST['memberid']."<br>");
//ユーザーの登録済み講義番号を取得.

$record_subject=mysql_query("SELECT * FROM submitsubject WHERE (memberid='{$_SESSION['memberid']}')");

$i=1;

print("　　ID:".$_SESSION['memberid']);
//$n=mysql_query("SELECT COUNT(*) FROM submitsubject");//？


//print ("count<br>".$n."<br>");

$No=array();


while($table=mysql_fetch_assoc($record_subject)){
	
	$code[$i]=h($table['code']);
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
        
      </ul>   
    </li>
    <li><a href="logout.php">ログアウト</a></li>
  </ul>   
</div>   
</p>
<div align="center">
<div id="indextable-box" class="radius">



<table border="1" cellpadding="5"  class="bordered"
  summary="あなたの登録している講義" bordercolor="#3399ff" bordercolorlight="#FF0000" bordercolordark="#3399ff">
  <colgroup> 
        <col style="width:5px;" />
        <col style="width:140px;" />
        <col style="width:140px;" />
        <col style="width:140px;" />
        <col style="width:140px;" />
        <col style="width:140px;" />
    </colgroup>
    
  <p>
  
  <?php 
  	print(h($_SESSION['name'], ENT_QUOTES));
	print("さん"); ?>の登録している講義を表示しています。<br>
  <?php print('登録講義数は、<b><font color="#FF0000" size="3">' . $n . "</b></font>です。");
  if($n<=0){
  	print("<br><font size='2' color='#ff0000'>講義を追加するには、メニューの「講義」&gt;&gt;「講義一覧」から追加したい講義を追加して下さい。</font>");
  }
  ?>
  </p>
  <tr>
    <th></th>
    <th>月</th>
    <th>火</th>
    <th>水</th>
    <th>木</th>
    <th>金</th>
  </tr>
  
  <?php
  	$m=0;
  	$n=0;
  	while($n<=5){//行
  		$i=$n+1;
  		print("<tr>");
  		print("<td><b>".$i."</b></td>");
  		while($m <= 4){
  	
  	
  	
  			print("<td>");
  			///////講義を取得////////////
    	
    			$time=$selecttime[$m][$n];
    			//print($selecttime[0][1]);
    			$record=mysql_query("SELECT * FROM submitsubject WHERE (memberid='{$_SESSION['memberid']}') AND (time LIKE '%{$time}%')");
    			$table=mysql_fetch_assoc($record);
    			//print("table['selclass']:".$table['selclass']."<br>");
    			//print("table['code']:".$table['code']."<br>");
    			$selclass=$table['selclass'];
    			$record_class=mysql_query("SELECT * FROM $selclass WHERE (code='{$table['code']}')");
    			if(!empty($record_class)){//登録されていない曜日・時限の講義は非表示(これがないとエラーが表示される)
    				$table_class=mysql_fetch_assoc($record_class);
    				?>
    				<!--
    				<a href='subject/subject.php?selclass=<?php print($selclass) ;?>&code=<?php print($table[code]); ?>'>
    				<?php print($table_class['subject']); ?>
    				</a><br>
    				-->
    				<?php print($table_class['subject']); ?>
    				<br>
    				<?php
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
    						<b><font size="2" color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc33ff'">
						受講者
						</font></b>
    						</a>
    						-->
    						
    						<a href="classmembers.php?code=<?php print($table['code']."&selclass=".$selclass); ?>"
    						onClick="window.open('classmembers.php?code=<?php print($table['code']."&selclass=".$selclass); ?>','win','width=500,height=400,menubar=no,status=no,scrollbars=yes,location=no') ; return false ;">
    						<img src="img/classmembers04-min.png" onmouseout="this.src='img/classmembers04-min.png';"  onmouseover="this.src='img/onclassmembers04-min.png';">
    						</a>
    					<?php
    					//print("<font size='1'></font>");
    					//print("<form method='POST' action='membersclass.php' target='_blank'>");
    					//print("<select name='membersid' size=2 alt='box内に同じ講義を受講している人が表示されています'>");
    				
    				}
    				if($table_class[subject]){
    				?>
    					<div align="right">
    					<form method="POST" action="removesubject/removedialog.php"  target="pop" onsubmit="return pop(this)">
    					<input type="hidden" name="removesubject" value="<?php print($table_class[subject]); ?>">
    					<input type="hidden" name="removetime" value="<?php print($table_class[time]); ?>">
    					<!--<input type="image"
    						onClick="window.open('removesubject/removedialog02.php','win','width=250,height=150,menubar=no,status=no,scrollbars=no,location=no') ; return false ;"
    						src="img/remove.png" onmouseout="this.src='img/remove.png';" onmouseover="this.src='img/onremove.png';" alt="講義を削除する">
    					-->
    					<input type="image"
    						src="img/remove.png" onmouseout="this.src='img/remove.png';" onmouseover="this.src='img/onremove.png';" alt="講義を削除する">
    					
    					
    					</form>
    					</div>
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
</div>


<!--
<form method="POST" action="select/select.php">
<P>登録する講義の曜日・時限を選択して下さい</P>
	科目区分:
	<SELECT name="selclass">
	<OPTION value="">------------------------------------</OPTION>
	<OPTION value="classcom">共通教育</OPTION>
	<OPTGROUP label="人文学部">
	<OPTION value="classculhumspe">人間科学科 専門科目</OPTION>
	<OPTION value="classculhumedu">人間科学科 教職科目</OPTION>
	<OPTION value="classculintspe">国際社会コミュニケーション学科 専門科目</OPTION>
	<OPTION value="classculintedu">国際社会コミュニケーション学科 教職科目</OPTION>
	<OPTION value="classculsocspe">社会経済学科 専門科目</OPTION>
	<OPTION value="classculsocedu">社会経済学科 教職科目</OPTION>
	</OPTGROUP>
	<OPTGROUP label="理学部">
	<OPTION value="classscispe">理学部 専門科目</OPTION>
	<OPTION value="classsciedu">理学部 教職科目</OPTION>
	</OPTGROUP>
	</SELECT>
	<br>
	<SELECT name="selecttime">
	<OPTGROUP label="月曜日">
	<OPTION value="月1">月曜日1限</OPTION>
	<OPTION value="月2">月曜日2限</OPTION>
	<OPTION value="月3">月曜日3限</OPTION>
	<OPTION value="月4">月曜日4限</OPTION>
	<OPTION value="月5">月曜日5限</OPTION>
	<OPTION value="月6">月曜日6限</OPTION>
		</OPTGROUP>
	<OPTGROUP label="火曜日">
	<OPTION value="火1">火曜日1限</OPTION>
	<OPTION value="火2">火曜日2限</OPTION>
	<OPTION value="火3">火曜日3限</OPTION>
	<OPTION value="火4">火曜日4限</OPTION>
	<OPTION value="火5">火曜日5限</OPTION>
	<OPTION value="火6">火曜日6限</OPTION>
	</OPTGROUP>
	<OPTGROUP label="水曜日">
	<OPTION value="水1">水曜日1限</OPTION>
	<OPTION value="水2">水曜日2限</OPTION>
	<OPTION value="水3">水曜日3限</OPTION>
	<OPTION value="水4">水曜日4限</OPTION>
	<OPTION value="水5">水曜日5限</OPTION>
	<OPTION value="水6">水曜日6限</OPTION>
	</OPTGROUP>
	<OPTGROUP label="木曜日">
	<OPTION value="木1">木曜日1限</OPTION>
	<OPTION value="木2">木曜日2限</OPTION>
	<OPTION value="木3">木曜日3限</OPTION>
	<OPTION value="木4">木曜日4限</OPTION>
	<OPTION value="木5">木曜日5限</OPTION>
	<OPTION value="木6">木曜日6限</OPTION>
	</OPTGROUP>

	<OPTGROUP label="金曜日">
	<OPTION value="金1">金曜日1限</OPTION>
	<OPTION value="金2">金曜日2限</OPTION>
	<OPTION value="金3">金曜日3限</OPTION>
	<OPTION value="金4">金曜日4限</OPTION>
	<OPTION value="金5">金曜日5限</OPTION>
	<OPTION value="金6">金曜日6限</OPTION>
	</OPTGROUP>
	</SELECT>
	<br>


<input type="submit" name="subjectreg" value="決定">

</form>


-->
</div>



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
			<a href="link.php" target="_blank">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			リンク
			</font></a>
			　｜　
			<a href="coursematch.php" target="_blank">
			<font color="#FFFFFF" onmouseout="this.color='#FFFFFF'" onmouseover="this.color='#FF0000'">
			CourseMatchについて
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