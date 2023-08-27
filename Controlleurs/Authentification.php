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
    // Initialize the session.
    // If you are using session_name("something"), don't forget it now!
    session_start();

    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
        echo "vous avez quitté";
        //header('Location: http://10.0.1.18');
        //die ("Vous avez quitté\n");
  }
}
?>
