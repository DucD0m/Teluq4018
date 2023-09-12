<?php declare(strict_types=1);
interface Modele {
  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool;
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool;
  public function update_mysql(Object $connexion_ecrire) : Int|Bool;
  public function delete_mysql(Object $connexion_effacer) : Int|Bool;
}
?>
