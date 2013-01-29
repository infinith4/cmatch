<?php
session_save_path("/tmp");
session_name("NEW");
session_id();
session_start();
echo "現在のセッション名は ". session_name() ." です。<br>";
echo "現在のID名は ". session_id() ." です。<br>";

print_r($_SESSION);
print("<br>");
print("<br>session:".$_SESSION['sessiontest']);
print("<br>");


?>