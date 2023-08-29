<?php // Singleton Design Pattern
require_once "Configuration/config.php";

class ConnexionEffacerBD {

  private static $connexion;

  private final function __construct() {}

  public static function connexion() {
    if (!isset(self::$connexion)) {
      $serveur = SERVERNAME;
      $effaceur = LECTEUR;
      $mdp_effaceur = MDPEFFACEUR;
      $base_donnees = BASEDONNEES;

      try {
        self::$connexion = new PDO("mysql:host=$serveur;dbname=$base_donnees", $effaceur, $mdp_effaceur);
        self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        //die("Connection failed: " . $e->getMessage());
        die("Impossible de se connecter en ce moment. Veuillez essayer plus tard.(3)");
      }
    }
    return self::$connexion;
  }
}
?>
