<?php declare(strict_types=1);
require_once "Modele.php";

abstract class Personne implements Modele {

  private $id = 0;
  private $prenom = "";
  private $nom = "";
  private $adresse = "";
  private $telephone = 0;
  private $courriel = "";

  public function get_id() : Int {
    return $this->id;
  }
  public function set_id(Int $id) {
    $this->id = $id;
  }
  public function get_prenom() : String {
    return $this->prenom;
  }
  public function set_prenom(String $prenom) {
    $this->prenom = $prenom;
  }
  public function get_nom() : String {
    return $this->nom;
  }
  public function set_nom(String $nom) {
    $this->nom = $nom;
  }
  public function get_adresse() : String {
    return $this->adresse;
  }
  public function set_adresse(String $adresse) {
    $this->adresse = $adresse;
  }
  public function get_telephone() : Int {
    return $this->telephone;
  }
  public function set_telephone(Int $telephone) {
    $this->telephone = $telephone;
  }
  public function get_courriel() : String {
    return $this->courriel;
  }
  public function set_courriel(String $courriel) {
    $this->courriel = $courriel;
  }

  public function select_mysql(Int $id) {
    // Code here
  }
  public function insert_mysql(Object $obj) {
    // Code here
    // if $obj is instanceof Personne...
    if($obj->telephone > 0) var_dump($obj);
    else echo 'wrong id';
  }
  public function update_mysql(Object $obj) {
    // Code here
  }
  public function delete_mysql(Object $obj) {
    // Code here
  }
}
?>
