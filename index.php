<?php
require_once "Configuration/config.php";
require_once "Vues/Templates/PageIndex.php";
require_once "Controlleurs/ConnexionLireBD.php";
require_once "Controlleurs/ConnexionEcrireBD.php";
require_once "Controlleurs/ConnexionEffacerBD.php";
require_once "Controlleurs/Authentification.php";
require_once "Controlleurs/GestionnaireControlleur.php";
require_once "Controlleurs/SpecialisteControlleur.php";
require_once "Controlleurs/fonctions_php.php";

session_start();

$connexion_lire;
$courriel;
$mot_passe;
$utilisateur;
$page;

// Pour le calcul du 5 minutes d'attente dans le cas où il y a 5 erreurs de mot de passe consécutives.
$temps = strtotime('-5 minutes');


if(isset($_SESSION['err_mdp_temps']) && $temps < $_SESSION['err_mdp_temps']) {
  die("Vous avez atteint le nombre maximum de 5 essais pour vous authentifier. Vous devez maintenant attendre 5 minutes avant de pouvoir essayer de nouveau.");
}
else if(isset($_SESSION['err_mdp_temps']) && $temps >= $_SESSION['err_mdp_temps']) {
  unset($_SESSION['erreurs_mdp']);
  unset($_SESSION['err_mdp_temps']);
}

if(isset($_POST['quitter']) && $_POST['quitter'] === "oui") {
  Authentification::quitter();
  redirection();
}

if(isset($_POST['retour']) && $_POST['retour'] === "oui") {
  unset($_SESSION['page']);
  redirection();
}

$connexion_lire = ConnexionLireBD::connexion();

// Vérification de session
if(isset($_SESSION['auth']) && ($_SESSION['auth'] === 'Gestionnaire' || $_SESSION['auth'] === 'Specialiste') &&
isset($_SESSION['id']) && $_SESSION['id'] > 0){

  if($_SESSION['auth'] === 'Gestionnaire') $utilisateur = new GestionnaireControlleur();
  else if($_SESSION['auth'] === 'Specialiste') $utilisateur = new SpecialisteControlleur();
  $utilisateur->afficherPage($connexion_lire, $connexion_ecrire, $connexion_effacer);
}

// Authentification
else if(isset($_POST['auth-courriel']) && $_POST['auth-courriel'] != '' && isset($_POST['auth-mdp']) && $_POST['auth-mdp'] != ''){

  $courriel = $_POST['auth-courriel'];
  $mot_passe = $_POST['auth-mdp'];
  $utilisateur = Authentification::get_utilisateur($courriel, $mot_passe, $connexion_lire);
  redirection();
}

// Affichage de la page d'authentification
else {
  $page = new PageIndex();
}

?>
