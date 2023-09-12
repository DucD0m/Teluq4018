<?php
require_once "Configuration/config.php";
require_once "Controlleurs/ConnexionEcrireBD.php";
require_once "Controlleurs/GestionnaireControlleur.php";
require_once "Controlleurs/SpecialisteControlleur.php";

class Authentification {

  private static $pepper = PEPPER;

  private static function sql_gestionnaire($courriel, $connexion_lire) {
    $sql = $connexion_lire->prepare('SELECT g.personne, g.mot_passe
      FROM gestionnaires g
      JOIN personnes p ON g.personne = p.id
      WHERE p.courriel = :courriel');

    $sql->bindParam(':courriel', $courriel, PDO::PARAM_STR);
    $sql->execute();
    $resultat = $sql->fetch(PDO::FETCH_OBJ);

    return $resultat;
  }

  private static function sql_specialiste($courriel, $connexion_lire) {
    $sql = $connexion_lire->prepare('SELECT s.id, s.mot_passe
      FROM specialistes s
      JOIN personnes p ON s.personne = p.id
      WHERE p.courriel = :courriel');

    $sql->bindParam(':courriel', $courriel, PDO::PARAM_STR);
    $sql->execute();
    $resultats = $sql->fetchAll(PDO::FETCH_OBJ);

    return $resultats;
  }

  private static function validation($nouveau_mot_passe) {
    $validation = true;
    $message_validation = "";

    if(strlen($nouveau_mot_passe) < 8) $validation = false;
    $message_validation .= "Le mot de passe doit contenir au moins 8 caractères. ";

    if(!preg_match('/[a-z]/', $nouveau_mot_passe)) $validation = false;
    $message_validation .= "Le mot de passe doit contenir au moins une lettre minuscule. ";

    if(!preg_match('/[A-Z]/', $nouveau_mot_passe)) $validation = false;
    $message_validation .= "Le mot de passe doit contenir au moins une lettre majuscule. ";

    if(!preg_match('/\d/', $nouveau_mot_passe)) $validation = false;
    $message_validation .= "Le mot de passe doit contenir au moins un chiffre. ";

    if(!preg_match('/[^a-zA-Z\d]/', $nouveau_mot_passe)) $validation = false;
    $message_validation .= "Le mot de passe doit contenir au moins un caractère spécial. ";

    return array('validation'=>$validation, 'message_validation'=>$message_validation);
  }

  private static function erreurs_mdp($verify) {
    $message_erreur = "Veuillez vérifier vos informations et essayer de nouveau.";

    // Compter le nombre d'erreurs de mots de passe. Protection contre le "Brute Force".
    if(!$verify && !isset($_SESSION['erreurs_mdp'])) {
      $_SESSION['erreurs_mdp'] = 1;
      $_SESSION['message'] = $message_erreur;
    }
    else if(!$verify && isset($_SESSION['erreurs_mdp'])) {
      $_SESSION['erreurs_mdp'] = $_SESSION['erreurs_mdp'] + 1;
      $_SESSION['message'] = $message_erreur;
      if($_SESSION['erreurs_mdp'] === 5) {
        $_SESSION['err_mdp_temps'] = strtotime('now');
      }
    }
  }

  public static function get_utilisateur($courriel, $mot_passe, $connexion_lire) {

    $pwd = $mot_passe;
    $pwd_peppered = hash_hmac("sha256", $pwd, self::$pepper);

    $resultat = self::sql_gestionnaire($courriel, $connexion_lire);

    $pwd_hashed = $resultat->mot_passe;
    if (password_verify($pwd_peppered, $pwd_hashed)) {
      $verify = true;
      $_SESSION['auth'] = 'Gestionnaire';
      $_SESSION['id'] = $resultat->personne;
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      unset($_SESSION['erreurs_mdp']);
      unset($_SESSION['err_mdp_temps']);
    }

    else {

      $resultats = self::sql_specialiste($courriel, $connexion_lire);

      // Une personne pourrait avoir plus d'une spécialité. Le même courriel est utilisé.
      // Le mot de passe doit être différent pour chacune des spécialitées.
      foreach($resultats as $resultat) {
        $pwd_hashed = $resultat->mot_passe;
        if (password_verify($pwd_peppered, $pwd_hashed)) {
          $verify = true;
          $_SESSION['auth'] = 'Specialiste';
          $_SESSION['id'] = $resultat->id;
          $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
          unset($_SESSION['erreurs_mdp']);
          unset($_SESSION['err_mdp_temps']);
        }
      }
    }
    self::erreurs_mdp($verify);
  }

  public static function set_mot_passe($courriel, $mot_passe, $nouveau_mot_passe, $connexion_lire) {

    $pwd = $mot_passe;
    $pwd_peppered = hash_hmac("sha256", $pwd, self::$pepper);

    $resultat = self::sql_gestionnaire($courriel, $connexion_lire);

    $pwd_hashed = $resultat->mot_passe;

    if (password_verify($pwd_peppered, $pwd_hashed)) {

      $verify = true;
      $connexion_ecrire = ConnexionEcrireBD::connexion();

      $validation_array = self::validation($nouveau_mot_passe);

      if($validation_array['validation']) {
        $mdp = $nouveau_mot_passe;
        $mdp_peppered = hash_hmac("sha256", $mdp, self::$pepper);
        $mdp_hashed = password_hash($mdp_peppered, PASSWORD_ARGON2ID);

        $gestionnaire = new Gestionnaire();
        $resultat_select = $gestionnaire->select_mysql($resultat->personne, $connexion_lire);

        if($resultat_select === true) {
          $gestionnaire->set_mot_passe($mdp_hashed);
          $resultat_update = $gestionnaire->update_mysql($connexion_ecrire);

          if($resultat_update > 0) {
            $_SESSION['message'] = "Le mot de passe a été mis à jour avec succès.";
          }
          else {
            $_SESSION['message'] = "Il y a eu un problème avec la mise à jour du mot de passe. Veuillez vérifier et essayer de nouveau.";
          }
        }
        else {
          $_SESSION['message'] = "Le compte du gestionnaire n'a pu être récupéré. Veuillez vérifier et essayer de nouveau.";
        }

        unset($_SESSION['erreurs_mdp']);
        unset($_SESSION['err_mdp_temps']);
      }
      else $_SESSION['message'] = $validation_array['message_validation'];
    }
    else {

      $resultats = self::sql_specialiste($courriel, $connexion_lire);

      // Une personne pourrait avoir plus d'une spécialité. Le même courriel est utilisé.
      // Le mot de passe doit être différent pour chacune des spécialitées.
      foreach($resultats as $resultat) {
        $pwd_hashed = $resultat->mot_passe;
        if (password_verify($pwd_peppered, $pwd_hashed)) {

          $verify = true;
          $connexion_ecrire = ConnexionEcrireBD::connexion();

          $validation_array = self::validation($nouveau_mot_passe);

          if($validation_array['validation']) {
            $mdp = $nouveau_mot_passe;
            $mdp_peppered = hash_hmac("sha256", $mdp, self::$pepper);
            $mdp_hashed = password_hash($mdp_peppered, PASSWORD_ARGON2ID);

            $specialiste = new Specialiste();
            $resultat_select = $specialiste->select_mysql($resultat->id, $connexion_lire);

            if($resultat_select === true) {
              $specialiste->set_mot_passe($mdp_hashed);
              $resultat_update = $specialiste->update_mysql($connexion_ecrire);

              if($resultat_update > 0) {
                $_SESSION['message'] = "Le mot de passe a été mis à jour avec succès.";
              }
              else {
                $_SESSION['message'] = "Il y a eu un problème avec la mise à jour du mot de passe. Veuillez vérifier et essayer de nouveau.";
              }
            }
            else {
              $_SESSION['message'] = "Le compte du specialiste n'a pu être récupéré. Veuillez vérifier et essayer de nouveau.";
            }

            unset($_SESSION['erreurs_mdp']);
            unset($_SESSION['err_mdp_temps']);
          }
          else $_SESSION['message'] = $validation_array['message_validation'];
        }
      }
    }
    self::erreurs_mdp($verify);
  }

  public static function quitter() {

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
