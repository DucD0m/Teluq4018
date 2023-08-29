<?php // Singleton Design Pattern
require_once "Configuration/config.php";

class ConnexionEcrireBD {

  private static $connexion;

  private final function __construct() {}

  public static function connexion() {
    if (!isset(self::$connexion)) {
      $serveur = SERVERNAME;
      $ecrivain = ECRIVAIN;
      $mdp_lecteur = MDPECRIVAIN;
      $base_donnees = BASEDONNEES;

      try {
        self::$connexion = new PDO("mysql:host=$serveur;dbname=$base_donnees", $ecrivain, $mdp_ecrivain);
        self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        //die("Connection failed: " . $e->getMessage());
        die("Impossible de se connecter en ce moment. Veuillez essayer plus tard.(2)");
      }
    }
    return self::$connexion;
  }
}
?>
