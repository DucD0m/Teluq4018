<?php
ini_set('error_reporting','E_ALL');
ini_set('display_errors','On');
ini_set('display_startup_errors','On');
require_once "Controlleurs/ConnexionLireBD.php";
require_once "Controlleurs/ConnexionEcrireBD.php";
require_once "Controlleurs/ConnexionEffacerBD.php";
//require_once "Tests/ClientTest.php";


$connexion_lire = ConnexionLireBD::connexion();
$connexion_ecrire = ConnexionEcrireBD::connexion();
$connexion_effacer = ConnexionEffacerBD::connexion();

echo "Test connexions";
exit;

//$test_client = ClientTest::test_client($connexion_lire,$connexion_ecrire,$connexion_effacer);
//echo $test_client;

?>
