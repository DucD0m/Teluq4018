<?php
require_once "Controlleur/ConnexionMySQL.php";
require_once "Controlleur/Authentification.php";
require_once "Controlleur/GestionnaireControlleur.php";
require_once "Controlleur/SpecialisteControlleur.php";

//$_POST['courriel'] = "domupnorth@hotmail.com";
//$_POST['mdp'] = "Gestionnaire";

$_SESSION['auth'] = "Specialiste";

if($_SESSION['auth'] === 'Gestionnaire' || $_SESSION['auth'] === 'Specialiste'){
  $connexion = ConnexionMySQL::connexion();
  if($_SESSION['auth'] === 'Gestionnaire') $utilisateur = new GestionnaireControlleur();
  else if($_SESSION['auth'] === 'Specialiste') $utilisateur = new SpecialisteControlleur();
  $utilisateur->afficherPage();
}
else if(isset($_POST['courriel']) && $_POST['courriel'] != '' && isset($_POST['mdp']) && $_POST['mdp'] != ''){
  $courriel = $_POST['courriel'];
  $mot_passe = $_POST['mdp'];
  $utilisateur = Authentification::get_utilisateur($courriel, $mot_passe);
  if(get_class($utilisateur) === 'SpecialisteControlleur' || get_class($utilisateur) === 'GestionnaireControlleur'){

  }
  $utilisateur->afficherPage();
}
else {
  //require "Vue/Template/auth.php";
  echo "Vous n'êtes pas authentifié.\n";
}
?>
