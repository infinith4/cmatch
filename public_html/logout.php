<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<?php
session_start();

session_unset();


// セッション情報を削除
$_SESSION = array();
/*if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
		$params["path"], $params["domain"],
		$params["secure"], $params["httponly"]
	);
}
*/
session_destroy();

// Cookie情報も削除
setcookie('memberid', '', time()-420000);
setcookie('password', '', time()-420000);

header('Location: index.php'); exit();
?>
