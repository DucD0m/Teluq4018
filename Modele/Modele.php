<?php
interface Modele {
  public function select_mysql(Int $id);
  public function insert_mysql(Object $obj);
  public function update_mysql(Object $obj);
  public function delete_mysql(Object $obj);
}
?>
