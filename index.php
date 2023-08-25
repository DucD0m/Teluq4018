<?php

require "Controlleur/ConnexionMySQL.php";
require "Controlleur/Authentification.php";
require_once "Controlleur/GestionnaireControlleur.php";
require_once "Controlleur/SpecialisteControlleur.php";

$_POST['courriel'] = "domupnorth@hotmail.com";
$_POST['mdp'] = "Specialiste";

//$_SESSION['auth'] = "Gestionnaire";

// Vérification de session
if($_SESSION['auth'] === 'Gestionnaire' || $_SESSION['auth'] === 'Specialiste'){
  if($_SESSION['auth'] === 'Gestionnaire') $utilisateur = new GestionnaireControlleur();
  else if($_SESSION['auth'] === 'Specialiste') $utilisateur = new SpecialisteControlleur();
  $connexion = ConnexionMySQL::connexion();
  $utilisateur->afficherPage();
}

// Authentification
else if(isset($_POST['courriel']) && $_POST['courriel'] != '' && isset($_POST['mdp']) && $_POST['mdp'] != ''){
  $courriel = $_POST['courriel'];
  $mot_passe = $_POST['mdp'];
  $utilisateur = Authentification::get_utilisateur($courriel, $mot_passe);
  if(get_class($utilisateur) === 'SpecialisteControlleur' || get_class($utilisateur) === 'GestionnaireControlleur'){
    $connexion = ConnexionMySQL::connexion();
    $utilisateur->afficherPage();
  }
}

// Affichage de la page d'authentification
else {
  //require "Vue/Template/auth.php";
  echo "Vous n'êtes pas authentifié.\n";
}

?>
