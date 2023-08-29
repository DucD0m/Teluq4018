<?php
require_once "Controlleurs/ConnexionLireBD.php";
require_once "Controlleurs/ConnexionEcrireBD.php";
//require_once "Controlleurs/ConnexionEffacerBD.php";
//require_once "Tests/ClientTest.php";

echo "Test require";
exit;

$connexion_lire = ConnexionLireBD::connexion();
$connexion_ecrire = ConnexionEcrireBD::connexion();
$connexion_effacer = ConnexionEffacerBD::connexion();

//$test_client = ClientTest::test_client($connexion_lire,$connexion_ecrire,$connexion_effacer);
//echo $test_client;

?>
