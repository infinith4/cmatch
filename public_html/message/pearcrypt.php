<?php
require_once 'Crypt/Blowfish.php';

echo "mcrypt module is " . (extension_loaded("mcrypt") ? "" : "not ") . "loaded\n";

// 暗号化するデータ
$data = '小池さんはラーメン大好き';
echo "data : " . $data . "\n";

// 暗号化キー
$key = 'the key value for crypting';

// CBCモードで暗号化するため、初期化ベクトルを用意する
$iv = substr(md5(uniqid(rand(), 1)), 0, 8);

// 暗号化処理
$blowfish = Crypt_Blowfish::factory('cbc', $key, $iv);
$encrypted_data = $blowfish->encrypt(base64_encode($data));
echo "encrypted data : " . base64_encode($encrypted_data) . "\n";


/**
 * [BK]mcrypt拡張モジュールがロードされている場合、1つのインスタンスを
 * 使い回すことができない（mcrypt_generic_deinitしていないため）ので、
 * 再度インスタンスを取得する必要がある。イケてない。。。
 */
if (extension_loaded("mcrypt")) {
	$blowfish = Crypt_Blowfish::factory('cbc', $key, $iv);
}


// 復号処理
$decrypted = $blowfish->decrypt($encrypted_data);
if (PEAR::isError($decrypted)) {
	die($decrypted->getMessage() . "\n");
}
echo $decrypted . "\n";
$decrypted_data = base64_decode($decrypted);

echo "decrypted data : " . $decrypted_data . "\n";
echo 'validate : ' . ($data == $decrypted_data ? 'true' : 'false') . "\n";

?>