<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
session_start();

//直接アクセスした場合
if (!isset($_SESSION['memberid'])) {
	header('Location: ../index.php'); exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">
<HTML>
<HEAD>
<TITLE>講義を削除しますか？</TITLE>
<link rel="stylesheet" type="text/css" href="removesubject.css" />


</HEAD>
<body>
<div align="center">
	<font color="#ff0000">
	<?php

	print($_POST[removesubject]."(".$_POST[removetime].")<br>の講義を削除しますか？");

	?>
	</font>
	<br>
	<br>
	<FORM method="post" action="removesubject.php">
	<input type="hidden" name="removesubject" value="<?php print($_POST[removesubject]); ?>">
	<input type="hidden" name="removetime" value="<?php print($_POST[removetime]); ?>">
	<input type="submit" name="yes" value="削除する">
	<input type="button" name="close" value="閉じる" onClick="self.window.close()">
	</FORM>
</div>
</BODY>
</HTML>