<?php
$_SESSION['auth'] = 'gestionnaire';
require "GestionnaireConfiguration.php";
$config = new GestionnaireConfiguration();
$pepper = $config->getPepper();
$pwd = $argv[1];
echo $pwd." ";
$pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
$pwd_hashed = password_hash($pwd_peppered, PASSWORD_DEFAULT);
echo "\n".$pwd_hashed;
if (password_verify($pwd_peppered, $pwd_hashed)) {
    echo "\nPassword matches.\n";
}
else {
    echo "\nPassword incorrect.\n";
}

// register.php
// $pepper = getConfigVariable("pepper");
// $pwd = $_POST['password'];
// $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
// $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
// add_user_to_database($username, $pwd_hashed);

// login.php
// $pepper = getConfigVariable("pepper");
// $pwd = $_POST['password'];
// $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);
// $pwd_hashed = get_pwd_from_db($username);
// if (password_verify($pwd_peppered, $pwd_hashed)) {
//     echo "Password matches.";
// }
// else {
//     echo "Password incorrect.";
// }
?>
