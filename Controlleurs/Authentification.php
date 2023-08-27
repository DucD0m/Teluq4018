<?php
require_once "Controlleurs/GestionnaireControlleur.php";
require_once "Controlleurs/SpecialisteControlleur.php";

class Authentification {

  public static function get_utilisateur($courriel, $mot_passe) {
    //echo "Authentification en cours...\n";
    $mot_passe = $_POST['auth-mdp'];
    //mysql resquest gestionnaire
    if($mot_passe == 'Gestionnaire') $resultat_gestionnaire = true;
    if($resultat_gestionnaire === true) {
      $_SESSION['auth'] = 'Gestionnaire';
      $utilisateur = new GestionnaireControlleur();
    }

    //mysql resquest specialiste
    if($mot_passe == 'Specialiste') $resultat_specialiste = true;
    if($resultat_specialiste === true) {
      $_SESSION['auth'] = 'Specialiste';
      $utilisateur = new SpecialisteControlleur();
    }

    if(get_class($utilisateur) === 'SpecialisteControlleur' || get_class($utilisateur) === 'GestionnaireControlleur'){
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      return $utilisateur;
    }
    else {
      //echo "Vous n'avez pas accès à cette application.\n";
      self::quitter();
    }
  }

  public static function quitter() {
    $_SESSION = array();
    session_destroy();
    //header('Location: http://10.0.1.18');
    //die ("Vous avez quitté\n");
  }
}
?>
