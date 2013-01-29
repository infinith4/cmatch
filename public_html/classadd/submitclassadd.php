<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<title>講義追加</title>
	<!-- 全ページ共通start-->
	<link rel="shortcut icon" href="../img/icon06.ico" type="image/vnd.microsoft.icon">
	<!-- 全ページ共通end-->
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<style type="text/css">
	body {margin: 0px; padding: 0px; }
	</style>
<!-- 5秒後に移動する場合 -->
<META http-equiv="refresh" content="3000; url=classadd.php">
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
3秒後に移動します。
3秒たっても移動しない場合は
<a href="classadd.php">こちら</a>をクリックしてください。<br><br>

<div id="in-box" align="left" class="radius">

<?php
session_start();
require('../dbconnect.php');

$i=0;
while($i<count($_POST[daytime1])){
	//print($_POST[daytime1][$i]."<br>");
	$time1=$time1.$_POST[day1].$_POST[daytime1][$i];
	//print("time1:".$time1."<br>");
	$i++;
}

$i=0;
while($i<count($_POST[daytime2])){
	//print($_POST[daytime2][$i]."<br>");
	$time2=$time2.$_POST[day2].$_POST[daytime2][$i];
	//print("time2:".$time2."<br>");
	$i++;
}


//$daytime=$_POST[daytime]+1;

//print("day:".$_POST[day]."<br>");
//print("daytime:".$daytime."<br>");

//print("time[]:".$time."<br>");


$time=$time1.$time2;
//print("連結：");
//print($time);
//print("<br>");

$i=0;

while($i<count($times)){
	$time=$time.$times[$i];
	//print($time."<br>");

	$i++;

}

if(empty($_POST[selclass])||empty($_POST[code])||empty($_POST[subject])||empty($_POST[teacher])||empty($_POST[term])||empty($time)||empty($_POST[yearly])){

	$error='1';
	print("エラーです。入力されていない項目が存在します。<br><br><a href='classadd.php'>戻る</a>");
	//exit();
	

}

if(empty($error)){
	$sql = sprintf("SELECT COUNT(*) AS cnt FROM $_POST[selclass] WHERE code='%s'",
		mysql_real_escape_string($_POST['code'])
	);
	$record = mysql_query($sql) or die(mysql_error());
	$table = mysql_fetch_assoc($record);
	
	if($table['cnt'] > 0){
		print("入力された講義は既に、存在しています。<br><br><a href='classadd.php'>戻る</a><br><br>
		問題が生じているならば、
		<a href='../mail/mailcmatch.php' target='_blank'>メール</a>
		で、お知らせ下さい。");
	
	}else{
		$sql = sprintf("INSERT INTO $_POST[selclass] SET code='%s', subject='%s', teacher='%s',term='%s',time='%s',yearly='%s'",
				mysql_real_escape_string(htmlspecialchars($_POST[code])),
				mysql_real_escape_string(htmlspecialchars($_POST[subject])),
				mysql_real_escape_string(htmlspecialchars($_POST[teacher])),
				mysql_real_escape_string(htmlspecialchars($_POST[term])),
				mysql_real_escape_string(htmlspecialchars($time)),
				mysql_real_escape_string(htmlspecialchars($_POST[yearly]))
				);
		mysql_query($sql) or die(mysql_error());

		print("<h2>講義の追加</h2><br><b>コード：　<font color='#0066cc'>".$_POST[code]."</font><br><br>");
		print("科目名：　<font color='#0066cc'>".$_POST[subject]."</font><br><br>");
		print("教員名：　<font color='#0066cc'>".$_POST[teacher]."</font><br><br>");
		print("学期：　<font color='#0066cc'>".$_POST[term]."</font><br><br>");
		print("曜日・時限：　<font color='#0066cc'>".$time."</font><br><br>");
		print("対象年次：　<font color='#0066cc'>".$_POST[yearly]."</font><br><br></b>");
		print("上記の科目は、テーブルに追加されました。");

		if(!empty($_POST[type])){
		
		
		
			$char=$time;//分割文字列
	
			$j=0;
			while($j<mb_strlen($time)/2){
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
					$sql = sprintf("INSERT INTO submitsubject SET memberid='%s',code='%s', selclass='%s',time='%s'",
					mysql_real_escape_string(htmlspecialchars($_SESSION[memberid])),
					mysql_real_escape_string(htmlspecialchars($_POST[code])),
					mysql_real_escape_string(htmlspecialchars($_POST[selclass])),
					mysql_real_escape_string(htmlspecialchars($time))
					);
					mysql_query($sql) or die(mysql_error());
					
					print("<br>上記の科目は、時間割にも追加されました。<br>");
					$j=count($subchar);//追加は一度だけ
				}else{
					print("<br>上記の科目は、重複しているため時間割に追加できませんでした。<br>");
					$j=count($subchar);//追加は一度だけ
				}
				
			
			$j++;

			}
			
			
			
		}
		
		
		
		
	
	}
		
}
?>
<br><br>
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