<?php
require_once "Controlleurs/ConnexionLireBD.php";
require_once "Tests/ClientTest.php";

$connexion_lecteur = ConnexionLireBD::connexion();

$test_client = new ClientTest();
$test_client->test_client($connexion_lecteur);
?>
