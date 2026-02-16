<?php
$str = "sai12345";
echo "MD5 Hash: " . md5($str);
?>

<br><br>

<?php
$password = "sai12345";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "password_hash(): " . $hashed_password;
?>

