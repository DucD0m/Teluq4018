<?php // Singleton Design Pattern
class ConnexionMySQL {

  private static $obj;

  private final function __construct() {
    echo __CLASS__ . " initiée une seule fois\n";
  }

  public static function connexion() {
    if (!isset(self::$obj)) {
      self::$obj = new ConnexionMySQL();
    }
    return self::$obj;
  }
}
?>
