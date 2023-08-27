<?php
require_once "Controlleurs/GestionnaireControlleur.php";
require_once "Controlleurs/SpecialisteControlleur.php";

class Authentification {

  public static function get_utilisateur($courriel, $mot_passe) {

    //mysql resquest gestionnaire
    if($mot_passe == 'Gestionnaire') $resultat_gestionnaire = true;
    if($resultat_gestionnaire === true) {
      $_SESSION['auth'] = 'Gestionnaire';
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    //mysql resquest specialiste
    if($mot_passe == 'Specialiste') $resultat_specialiste = true;
    if($resultat_specialiste === true) {
      $_SESSION['auth'] = 'Specialiste';
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
  }

  public static function quitter() {

    session_start();

    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

  }
}
?>
