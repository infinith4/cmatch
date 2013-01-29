<?php
$uniqid=uniqid();
$token_uniqid=uniqid('token_');
$uniqidtrue=uniqid('',TRUE);
$uniqidrand=uniqid(rand(1000000,9999999));
$uniqidrandtrue=uniqid(rand(100000,999999),TRUE);

print($uniqid."<br>");
print($token_uniqid."<br>");
print($uniqidtrue."<br>");
print($uniqidrand."<br>");
print($uniqidrandtrue."<br>");

print(mb_strlen($uniqid)."<br>");
print(mb_strlen($token_uniqid)."<br>");
print(mb_strlen($uniqidtrue)."<br>");
print(mb_strlen($uniqidrand)."<br>");
print(mb_strlen($uniqidrandtrue)."<br>");


?>