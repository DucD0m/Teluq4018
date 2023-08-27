<?php // Singleton Design Pattern
require "Configuration/config.php";

class ConnexionLireBD {

  private static $obj;

  private final function __construct() {
    $serveur = SERVERNAME;
    $lecteur = LECTEUR;
    $mdp_lecteur = MDPLECTEUR;
    $base_donnees = BASEDONNEES;

    try {
      $connexion = new PDO("mysql:host=$serveur;dbname=$base_donnees", $lecteur, $mdp_lecteur);
      $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }

  public static function connexion() {
    if (!isset(self::$obj)) {
      self::$obj = new ConnexionLireBD();
    }
    return self::$obj;
  }
}
?>
