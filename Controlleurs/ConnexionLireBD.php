<?php // Singleton Design Pattern
require_once __DIR__ . "/../Configuration/config.php";

class ConnexionLireBD {

  private static $connexion;

  private final function __construct() {}

  public static function connexion() {
    if (!isset(self::$connexion)) {
      $serveur = SERVERNAME;
      $lecteur = LECTEUR;
      $mdp_lecteur = MDPLECTEUR;
      $base_donnees = BASEDONNEES;

      try {
        self::$connexion = new PDO("mysql:host=$serveur;dbname=$base_donnees", $lecteur, $mdp_lecteur);
        self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        //die("Connection failed: " . $e->getMessage());
        die("Impossible de se connecter en ce moment. Veuillez essayer plus tard.(1)");
      }
    }
    return self::$connexion;
  }
}
?>
