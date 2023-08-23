<?php declare(strict_types=1);
require_once "Modele.php";

class Specialite implements Modele {

  protected $id;
  protected $nom;

  public function get_id() : Int {
    return $this->id;
  }
  public function set_id(Int $id) {
    $this->id = $id;
  }
  public function get_nom() : String {
    return $this->nom;
  }
  public function set_nom(String $nom) {
    $this->nom = $nom;
  }

  public function select_mysql(Int $id) {
    // Code here
    if($id > 0) echo gettype($id);
  }
  public function insert_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Specialite') echo get_class($obj);
    else echo 'wrong type';
  }
  public function update_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Specialite') echo get_class($obj);
    else echo 'wrong type';
  }
  public function delete_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Specialite') echo get_class($obj);
    else echo 'wrong type';
  }
}
$s = new Specialite();
//$s->select_mysql(123);
$s->insert_mysql($s);
?>
