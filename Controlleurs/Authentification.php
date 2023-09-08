<?php
require_once "Configuration/config.php";
require_once "Controlleurs/GestionnaireControlleur.php";
require_once "Controlleurs/SpecialisteControlleur.php";

class Authentification {

  public static function get_utilisateur($courriel, $mot_passe, $connexion_lire) {

    $pepper = PEPPER;
    $pwd = $mot_passe;
    $pwd_peppered = hash_hmac("sha256", $pwd, $pepper);

    $sql = $connexion_lire->prepare('SELECT g.personne, g.mot_passe
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
      unset($_SESSION['erreurs_mdp']);
      unset($_SESSION['err_mdp_temps']);
    }

    else {
      $sql = $connexion_lire->prepare('SELECT s.id, s.mot_passe
        FROM specialistes s
        JOIN personnes p ON s.personne = p.id
        WHERE p.courriel = :courriel');

      $sql->bindParam(':courriel', $courriel, PDO::PARAM_STR);
      $sql->execute();
      $resultats = $sql->fetchAll(PDO::FETCH_OBJ);

      // Une personne pourrait avoir plus d'une spécialité. Le même courriel est utilisé.
      // Le mot de passe doit être différent pour chacune des spécialitées.
      foreach($resultats as $resultat) {
        $pwd_hashed = $resultat->mot_passe;
        if (password_verify($pwd_peppered, $pwd_hashed)) {
          $_SESSION['auth'] = 'Specialiste';
          $_SESSION['id'] = $resultat->id;
          $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
          unset($_SESSION['erreurs_mdp']);
          unset($_SESSION['err_mdp_temps']);
        }
      }
    }

    // Compter le nombre d'erreurs de mots de passe. Protection contre le "Brute Force".
    if(!isset($_SESSION['auth']) && !isset($_SESSION['erreurs_mdp'])) {
      $_SESSION['erreurs_mdp'] = 1;
    }
    else if(!isset($_SESSION['auth']) && isset($_SESSION['erreurs_mdp'])) {
      $_SESSION['erreurs_mdp'] = $_SESSION['erreurs_mdp'] + 1;
      if($_SESSION['erreurs_mdp'] === 5) {
        $_SESSION['err_mdp_temps'] = strtotime('now');
      }
    }

  }

  public static function quitter() {

    // session_start();

    $_SESSION = array();
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // session_destroy();

  }
}
?>
