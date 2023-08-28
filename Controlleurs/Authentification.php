<?php
require_once "Configuration/config.php";
require_once "Controlleurs/GestionnaireControlleur.php";
require_once "Controlleurs/SpecialisteControlleur.php";

class Authentification {

  public static function get_utilisateur($courriel, $mot_passe) {

    $pepper = PEPPER;
    $pwd = $mot_passe;
    $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);

    $sql = $connexion_lecteur->prepare('SELECT g.personne, g.mot_passe
      FROM gestionnaires g
      JOIN personnes p ON g.personne = p.id
      WHERE p.courriel = :courriel');

    $sql->bindParam(':courriel', $courriel, PDO::PARAM_STR);
    $sql->execute();
    $resultat = $sql->fetch(PDO::FETCH_OBJ);

    $pwd_hashed = $resultat->mot_passe;
    if (password_verify($pwd_peppered, $pwd_hashed)) {
      $_SESSION['auth'] = 'Gestionnaire';
      $_SESSION['id'] = $resultat->personne;
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    else {
      $sql = $connexion_lecteur->prepare('SELECT s.id, s.mot_passe
        FROM specialistes s
        JOIN personnes p ON s.personne = p.id
        WHERE p.courriel = :courriel');

      $sql->bindParam(':courriel', $courriel, PDO::PARAM_STR);
      $sql->execute();
      $resultat = $sql->fetch(PDO::FETCH_OBJ);

      $pwd_hashed = $resultat->mot_passe;
      if (password_verify($pwd_peppered, $pwd_hashed)) {
        $_SESSION['auth'] = 'Specialiste';
        $_SESSION['id'] = $resultat->personne;
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      }
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
