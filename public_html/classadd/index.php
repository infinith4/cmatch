<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
session_start();
if(!empty($_SESSION[memberid])){
	header("Location: classadd.php");exit();
}else{
	header("Location: ../index.php");exit();	
}

?>