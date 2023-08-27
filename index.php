<?php
require "Vues/Templates/PageIndex.php";
require "Controlleurs/ConnexionBD.php";
require "Controlleurs/Authentification.php";
require_once "Controlleurs/GestionnaireControlleur.php";
require_once "Controlleurs/SpecialisteControlleur.php";

if(isset($_POST['quitter']) && $_POST['quitter'] === true) {
  Authentification::quitter();
  exit;
}

session_start();
$connexion = ConnexionBD::connexion();

$_POST['courriel'] = "domupnorth@hotmail.com";
$_POST['mdp'] = "Specialiste";

//$_SESSION['auth'] = "Gestionnaire";

// Vérification de session
if($_SESSION['auth'] === 'Gestionnaire' || $_SESSION['auth'] === 'Specialiste'){
  session_start(); // Raffraîchir la session.
  if($_SESSION['auth'] === 'Gestionnaire') $utilisateur = new GestionnaireControlleur();
  else if($_SESSION['auth'] === 'Specialiste') $utilisateur = new SpecialisteControlleur();
  $utilisateur->afficherPage();
}

// Authentification
else if(isset($_POST['courriel']) && $_POST['courriel'] != '' && isset($_POST['mdp']) && $_POST['mdp'] != ''){
  $courriel = $_POST['courriel'];
  $mot_passe = $_POST['mdp'];
  $utilisateur = Authentification::get_utilisateur($courriel, $mot_passe);
  if(get_class($utilisateur) === 'SpecialisteControlleur' || get_class($utilisateur) === 'GestionnaireControlleur'){
    $utilisateur->afficherPage();
  }
}

// Affichage de la page d'authentification
else {
  //require "Vue/Template/auth.php";
  //echo "Vous n'êtes pas authentifié.\n";
  $page = new PageIndex();
}

?>
