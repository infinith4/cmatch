<?php
session_save_path("/tmp");
session_name('NEW');
session_id();
session_start();
//session_register("s_name");
//$HTTP_SESSION_VARS["s_name"] = "abc";
echo "現在のセッション名は ". session_name() ." です。<br>";

//session_regenerate_id(true);

$_SESSION['sessiontest']='test01';

print($_SESSION['sessiontest']."<br>");

echo "session_id:";
echo session_id();
print("<br>");

print("<a href='session02.php'>確認</a><br>");

?>
