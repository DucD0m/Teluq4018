<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require "Vues/Templates/PageIndex.php";
require "Controlleurs/ConnexionBD.php";
require "Controlleurs/Authentification.php";
require_once "Controlleurs/GestionnaireControlleur.php";
require_once "Controlleurs/SpecialisteControlleur.php";
require_once "Controlleurs/fonctions_php.php";

$connexion;
$courriel;
$mot_passe;
$utilisateur;
$page;

// var_dump($_POST);
// echo "<br>";
// echo $_SESSION['auth'];

if(isset($_POST['quitter']) && $_POST['quitter'] === "oui") {
  Authentification::quitter();
  redirection();
}

if(isset($_POST['retour']) && $_POST['retour'] === "oui") {
  unset($_SESSION['page']);
  redirection();
}

$connexion = ConnexionBD::connexion();

// Vérification de session
if(isset($_SESSION['auth']) && ($_SESSION['auth'] === 'Gestionnaire' || $_SESSION['auth'] === 'Specialiste')){

  if($_SESSION['auth'] === 'Gestionnaire') $utilisateur = new GestionnaireControlleur();
  else if($_SESSION['auth'] === 'Specialiste') $utilisateur = new SpecialisteControlleur();
  $utilisateur->afficherPage();
}

// Authentification
else if(isset($_POST['auth-courriel']) && $_POST['auth-courriel'] != '' && isset($_POST['auth-mdp']) && $_POST['auth-mdp'] != ''){

  $courriel = $_POST['auth-courriel'];
  $mot_passe = $_POST['auth-mdp'];
  $utilisateur = Authentification::get_utilisateur($courriel, $mot_passe);
  redirection();
}

// Affichage de la page d'authentification
else {
  $page = new PageIndex();
}

?>
