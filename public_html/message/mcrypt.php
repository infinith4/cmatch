<?php
// 暗号化するデータ
$data = '小池さんはラーメン大好き';
$base64_data = base64_encode($data);
echo "data : " . $data . "\n";

// 暗号化キー
$key = 'the key value for crypting';

/**
 * 初期化ベクトルを用意する
 * Windowsの場合、MCRYPT_DEV_URANDOMの代わりにMCRYPT_RANDを使用する
 */
$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);

// 暗号化処理
$encrypted_data = mcrypt_cbc(MCRYPT_BLOWFISH, $key, $base64_data, MCRYPT_ENCRYPT, $iv);
echo "encrypted data : " . base64_encode($encrypted_data)."\n";

// 復号処理
$base64_decrypted_data = mcrypt_cbc(MCRYPT_BLOWFISH, $key, $encrypted_data, MCRYPT_DECRYPT, $iv);
$decrypted_data = base64_decode($base64_decrypted_data);
echo "decrypted data : " . $decrypted_data . "\n";

echo 'validate : ' . ($data == $decrypted_data ? 'true' : 'false') . "\n";

?>

