<?php
interface Modele {
  public function select_mysql(Int $id, Object $connexion);
  public function insert_mysql(Object $obj, Object $connexion);
  public function update_mysql(Object $obj, Object $connexion);
  public function delete_mysql(Object $obj, Object $connexion);
}
?>
