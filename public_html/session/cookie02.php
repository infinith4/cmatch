<?php
$value='test01,test02';
$time=time() + 60*60;
setcookie("testcookie",$value,$time);

$cookie=$_COOKIE["testcookie"];
?>
<html>
<body>
cookie:<?php print($cookie); ?>
<br>
</body>
</html>