<?php declare(strict_types=1);
require_once "Personne.php";

class Gestionnaire extends Personne implements Modele {

  protected Int $personne = 0;
  protected String $mot_passe = "";

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

  public function select_mysql(Int $id) : Object|Bool {
    // Code here
  }
  public function insert_mysql(Object $obj) Int|Bool {
    // Code here
  }
  public function update_mysql(Object $obj) Int|Bool {
    // Code here
  }
  public function delete_mysql(Object $obj) Int|Bool {
    // Code here
  }
}
?>
