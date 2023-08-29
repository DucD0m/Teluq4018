<?php
interface Modele {
  public function select_mysql(Int $id, Object $connexion_lire);
  public function insert_mysql(Object $obj, Object $connexion_ecrire);
  public function update_mysql(Object $obj, Object $connexion_ecrire);
  public function delete_mysql(Object $obj, Object $connexion_effacer);
}
?>
