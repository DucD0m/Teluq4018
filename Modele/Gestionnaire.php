<?php declare(strict_types=1);
require_once "Personne.php";

class Gestionnaire extends Personne implements Modele {

  protected $personne;
  protected $mot_passe;

  public function get_personne() : Int {
    return $this->personne;
  }
  public function set_personne(Int $personne) {
    $this->personne = $personne;
  }
  public function get_mot_passe() : String {
    return $this->mot_passe;
  }
  public function set_mot_passe(String $mot_passe) {
    $this->mot_passe = $mot_passe;
  }

  public function select_mysql(Int $id) {
    // Code here
    if($id > 0) echo gettype($id);
  }
  public function insert_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Gestionnaire') echo get_class($obj);
    else echo 'wrong type';
  }
  public function update_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Gestionnaire') echo get_class($obj);
    else echo 'wrong type';
  }
  public function delete_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Gestionnaire') echo get_class($obj);
    else echo 'wrong type';
  }
}
?>
