<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>プロフィール更新</title>
	<!-- 全ページ共通start-->
	<link rel="shortcut icon" href="../img/icon06.ico" type="image/vnd.microsoft.icon">
	<!-- 全ページ共通end-->
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<link href="../menu/jquery.jdMenu.css" rel="stylesheet" type="text/css" />
	<script src="../scripts/jquery-1.3.1.js" type="text/javascript"></script>
	<script src="../scripts/jquery-1.2.6.js" type="text/javascript"></script>
	<script src="../menu/jquery.dimensions.js" type="text/javascript"></script>
	<script src="../menu/jquery.positionBy.js" type="text/javascript"></script>  
	<script src="../menu/jquery.bgiframe.js" type="text/javascript"></script>
	<script src="../menu/jquery.jdMenu.js" type="text/javascript"></script>
	<script src="../js/cascadingdropdownlist.js" type="text/javascript"></script>
	<script type="text/javascript">


$(function() {
  $("ul.jd_menu").jdMenu();
  //$("ul.jd_menu").jdMenu({ showDelay: 200, hideDelay: 500 });
  //$("ul.jd_menu").jdMenu({ showDelay: 1000, hideDelay: 1000 });
  //$("ul.jd_menu").jdMenu({disableLinks: true});
});  
$(function() {
  cascadingDropDownList("parent", "child", false, "1");    
  cascadingDropDownList("child", "grandsun", true, "");  
});
</script>
	<style type="text/css">
	body {margin: 0px; padding: 0px; }
	body { background: #ffffff url("../img/background.jpg") fixed left top }
</style>


</head>
<body>
<p class='header'>
<img src='../img/logo04-5.PNG'>
</p>
<?php
require('../dbconnect.php');

session_start();

if(empty($_SESSION[memberid])){
	header("Location:../");
	print("　<a href='../'>ホーム</a>");
	exit();
}


//print("<img src='../img/logo01-2.PNG'>");
$memberid=$_SESSION['memberid'];

$record=mysql_query("SELECT * FROM profiles WHERE memberid='{$memberid}'");
$table=mysql_fetch_assoc($record);

$privacyrecord=mysql_query("SELECT * FROM privacyprofiles WHERE memberid='{$memberid}'");
$privtable =mysql_fetch_assoc($privacyrecord);


if (!empty($_POST)) {
	// エラー項目の確認
	if ($_POST['lastname'] == '') {
		$error['lastname'] = 'blank';
	}
	if ($_POST['firstname'] == '') {
		$error['firstname'] = 'blank';
	}
	if ($_POST['handle'] == '') {
		$error['handle'] = 'blank';
	}
	if ($_POST['department'] == '') {
		$error['department'] = 'blank';
	}
	if ($_POST['concentration'] == '') {
		$error['concentration'] = 'blank';
	}
	if ($_POST['course'] == '') {
		$error['course'] = 'blank';
	}
	if ($_POST['yearly'] == '') {
		$error['yearly'] = 'blank';
	}
	
	if ($_POST['messageline'] == '') {
		$error['messageline'] = 'blank';
	}
	if ($_POST['message'] == '') {
		$error['message'] = 'blank';
	}
	if ($_POST['sex'] == '') {
		$error['sex'] = 'blank';
	}
	/*
	if ($_POST['companyfriendship'] == '') {
		$error['companyfriendship'] = 'blank';
	}
	*/
	/*
	if ($_POST['place'] == '') {
		$error['place'] = 'blank';
	}
	*/
	if ($_POST['interact'] == '') {
		$error['interact'] = 'blank';
	}
	/*
	if ($_POST['sns'] == '') {
		$error['sns'] = 'blank';
	}
	*/
	// 重複アカウントのチェック
	if (empty($error)) {
		$sql = sprintf("SELECT COUNT(*) AS cnt FROM profiles WHERE memberid='%s'",
			mysql_real_escape_string($_SESSION['memberid'])
		);
		$record = mysql_query($sql) or die(mysql_error());
		$table = mysql_fetch_assoc($record);
		if ($table['cnt'] > 0) {
			$error['memberid'] = 'duplicate';
			//print("* 既に登録済みです。");
		}
		if (empty($error)) {
		
		$_SESSION['join'] = $_POST;
		//header('Location: check.php'); exit();
		}
	}
}


// 書き直し
if ($_REQUEST['action'] == 'rewrite') {
	$_POST = $_SESSION['join'];
	$error['rewite'] = true;
}
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
      	<li><a href="index.php">プロフィール更新</a></li>
        <li><a href="#">講義変更</a></li>
      </ul>   
    </li>
    <li><a href="../logout.php">ログアウト</a></li>
  </ul>   
</div>   
</p>





<div align='center'>




<?php 
print("<div id='in-box' class='radius'>
<h2>プロフィールの更新</h2>
<div id='statement-box' align='left'>");
//print("ID:".$_SESSION[memberid]);
print("<br>". $_SESSION['name']);
print("さんのプロフィールを入力してください。<br>");
print("ハンドルネームを、わかりやすくしておくと、知り合いが見つけやすくなります。<br>");
?>
<form action="submitprofiles.php" method="post" enctype="multipart/form-data">
<p>これらの情報は登録している学生にのみ公開されます。(<font color='#FF0000'>*</font>は必須)<br>
ただし、新規登録時に登録した「氏名」「メールアドレス」が公開されることはありません。</p>
各項目のチェックボックスにチェックすると公開、しなければ非公開となります。
</div>
<?php

$recordmembers=mysql_query("SELECT * FROM members WHERE memberid='{$memberid}'");
$tablemembers=mysql_fetch_assoc($recordmembers);
?>
<div align="center">
<table>


  <tr>
    <td>氏名：<font color='#FF0000'>*</font></td>
    <td><input type="text" name="lastname" size="20" maxlength="255" value="<?php print($tablemembers[lastname]); ?>"/>
    	<?php if ($error['lastname'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> 姓を入力してください</p>
    	<?php endif; ?>
    <input type="text" name="firstname" size="20" maxlength="255" value="<?php print($tablemembers[firstname]); ?>"/>
    </td>
    	<?php if ($error['firstname'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> 名を入力してください</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>ハンドルネーム：<font color='#FF0000'>*</font></td>
    <td><input type="text" name="handle" size="50" maxlength="255" value="<?php print($table[handle]); ?>"/></td>
    	<?php if ($error['handle'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> ハンドルネームを入力してください</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privdep]==='1'){
    	print("<input type='checkbox' name='privdep' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privdep' value='1'>");
    }
    ?>
    　学部：<font color='#FF0000'>*</font></td>
    <td>
    <select id="parent" name='dep' >
    <!--trim( $table[department] );-->
    <option value="01" <?php if($table[department]==='人文学部'){ print("selected"); } ?>>人文学部</option>   
    <option value="02" <?php if($table[department]==='理学部'){ print("selected"); } ?>>理学部</option>   
  </select> 
    </td>
    	<?php if ($error['department'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> 学部を入力してください</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privcon]==='1'){
    	print("<input type='checkbox' name='privcon' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privcon' value='1'>");
    }
    ?>
    　学科：<font color='#FF0000'>*</font></td>
    <td>
    <select id="child" name='con'>
    
    <!--<?php $conarray=array('人間科学科','国際社会コミュニケーション学科','社会経済学科','理学科','応用理学科'); ?>-->
    <option class="sub_01" value="0101" <?php if($table[concentration]==='人間科学科'){ print("selected"); } ?>>人間科学科</option>   
    <option class="sub_01" value="0102" <?php if($table[concentration]==='国際社会コミュニケーション学科'){ print("selected"); } ?>>国際社会コミュニケーション学科</option>
    <option class="sub_01" value="0103" <?php if($table[concentration]==='社会経済学科'){ print("selected"); } ?>>社会経済学科</option>
    <option class="sub_02" value="0201" <?php if($table[concentration]==='理学科'){ print("selected"); } ?>>理学科</option>   
    <option class="sub_02" value="0202" <?php if($table[concentration]==='応用理学科'){ print("selected"); } ?>>応用理学科</option>
    </select>
    </td>
    	<?php if ($error['concentration'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> 学科を入力してください</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privcou]==='1'){
    	print("<input type='checkbox' name='privcou' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privcou' value='1'>");
    }
    ?>
    　コース：<font color='#FF0000'>*</font></td>
    <td>
    <select id="grandsun" name='cou'>
    <option class="sub_0101" value="010101" <?php if($table[course]==='人間基礎論'){ print("selected"); } ?>>人間基礎論</option>   
    <option class="sub_0101" value="010102" <?php if($table[course]==='地域変動論'){ print("selected"); } ?>>地域変動論</option>   
    <option class="sub_0101" value="010103" <?php if($table[course]==='言語表象論'){ print("selected"); } ?>>言語表象論</option>   
    <option class="sub_0102" value="010201" <?php if($table[course]===''){ print("selected"); } ?>>----------</option>   
    <option class="sub_0103" value="010301" <?php if($table[course]==='総合地域政策'){ print("selected"); } ?>>総合地域政策</option>   
    <option class="sub_0103" value="010302" <?php if($table[course]==='経済企業情報'){ print("selected"); } ?>>経済企業情報</option>   
    <option class="sub_0201" value="020101" <?php if($table[course]==='数学'){ print("selected"); } ?>>数学</option>   
    <option class="sub_0201" value="020102" <?php if(trim($table[course])==='物理科学'){ print("selected"); } ?>>物理学科</option>
    <option class="sub_0201" value="020103" <?php if($table[course]==='化学'){ print("selected"); } ?>>化学</option>
    <option class="sub_0201" value="020104" <?php if($table[course]==='生物科学'){ print("selected"); } ?>>生物科学</option>
    <option class="sub_0201" value="020105" <?php if($table[course]==='地球科学'){ print("selected"); } ?>>地球科学</option>
    <option class="sub_0202" value="020201" <?php if($table[course]==='情報科学'){ print("selected"); } ?>>情報科学</option>   
    <option class="sub_0202" value="020202" <?php if($table[course]==='応用化学'){ print("selected"); } ?>>応用化学</option>   
    <option class="sub_0202" value="020203" <?php if($table[course]==='海洋生命・分子工学'){ print("selected"); } ?>>海洋生命・分子工学</option>   
    <option class="sub_0202" value="020204" <?php if($table[course]==='災害科学'){ print("selected"); } ?>>災害科学</option>   
  </select>
    </td>
    	<?php if ($error['course'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> コースを入力してください</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privyea]==='1'){
    	print("<input type='checkbox' name='privyea' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privyea' value='1'>");
    }
    ?>
    年次：<font color='#FF0000'>*</font></td>
    <td>
	<SELECT name="yearly" >
		<OPTION value="" disabled>年次を選択</OPTION>
		<?php
		$i=1;
		
		while($i<7){
		?>
		
		<!--なぜかintvalにしないといけない-->
			<OPTION value='<?php print($i); ?>' <?php if(intval($table[yearly])===$i){ print("selected"); } ?>><?php print($i); ?></OPTION>
		
		<?php
		
		$i++;
		}
		?>
		
		
	</SELECT>
    　</td>
    	<?php if ($error['course'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> 何回生か入力してください</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>一行紹介：<font color='#FF0000'>*</font></td>
    <td><input type="text" name="messageline" size="73" maxlength="255" value="<?php print($table[messageline]); ?>"/></td>
    	<?php if ($error['messageline'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> 一行紹介を入力してください</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privmes]==='1'){
    	print("<input type='checkbox' name='privmes' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privmes' value='1'>");
    }
    ?>　自己紹介：</td>
    
    <td><TEXTAREA cols="65" rows="15" name="message"><?php print($table[message]); ?></TEXTAREA></td>
    	<?php if ($error['messase'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> 自己紹介文を入力してください</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privsex]==='1'){
    	print("<input type='checkbox' name='privsex' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privsex' value='1'>");
    }
    ?>　性別：</td>
    <td>
    	<SELECT name="sex" >
    	
	<OPTION value="女性" <?php if($table[sex]==='女性'){ print("selected"); } ?>>女性</OPTION>
	<OPTION value="男性" <?php if($table[sex]==='男性'){ print("selected"); } ?>>男性</OPTION>
	</SELECT>
    </td>
    	<?php if ($error['sex'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> 性別を入力してください</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privcom]==='1'){
    	print("<input type='checkbox' name='privcom' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privcom' value='1'>");
    }
    ?>
    　交際ステータス：</td>
    <td><input type="text" name="companyfriendship" size="50" maxlength="255" value="<?php print($table[companyfriendship]); ?>"/></td>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privpla]==='1'){
    	print("<input type='checkbox' name='privpla' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privpla' value='1'>");
    }
    ?>
    　よく出没する場所：</td>
    <td><input type="text" name="place" size="50" maxlength="255" value="<?php print($table[place]); ?>"/></td>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privint]==='1'){
    	print("<input type='checkbox' name='privint' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privint' value='1'>");
    }
    ?>
    　知り合いたい対象：</td>
    <td><input type="text" name="interact" size="50" maxlength="255" value="<?php print($table[interact]); ?>"/></td>
    	<?php if ($error['sex'] == 'blank'): ?>
    	<p class="error"><font color='#FF0000'>*</font> どういう人と知り合いたいですか？</p>
    	<?php endif; ?>
  </tr>
  <tr>
    <td>
    <?php
    if($privtable[privsns]==='1'){
    	print("<input type='checkbox' name='privsns' value='1' checked>");
    }else{
    	print("<input type='checkbox' name='privsns' value='1'>");
    }
    ?>　登録しているSNS：<br></td>
    <td><input type="text" name="sns" size="50" maxlength="255" value="<?php print($table[sns]); ?>"/></td>
  </tr>
  <tr>
</table>
<hr>
<input type="submit" value="登録" /><br><br>
</form>
* SNSとはSocial Networking Serviceの略<br><br>
</div></div></div>





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
