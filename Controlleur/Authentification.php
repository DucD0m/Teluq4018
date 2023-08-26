<?php
require_once "Controlleur/GestionnaireControlleur.php";
require_once "Controlleur/SpecialisteControlleur.php";

class Authentification {

  public static function get_utilisateur($courriel, $mot_passe) {
    echo "Authentification en cours...\n";

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
      echo "Vous n'avez pas accès à cette application.\n";
      self::quitter();
    }
  }

  public static function quitter() {
    $_SESSION = array();
    session_destroy();
    header(location: "index.php");
    //die ("Vous avez quitté\n");
  }
}
?>
