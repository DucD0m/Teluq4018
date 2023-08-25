<?php declare(strict_types=1);
require_once "Modele.php";

class Plan implements Modele {

  private $id;
  private $nom;
  private $duree;
  private $prix;
  private $acces_appareils;
  private $acces_cours_groupe;
  private $prix_cours_groupe;

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
  public function get_duree() : Int {
    return $this->duree;
  }
  public function set_duree(Int $duree) {
    $this->duree = $duree;
  }
  public function get_prix() : Float{
    return $this->prix;
  }
  public function set_prix(Float $prix) {
    $this->prix = $prix;
  }
  public function get_acces_appareils() : Int {
    return $this->acces_appareils;
  }
  public function set_acces_appareils(Int $acces_appareils) {
    $this->acces_appareils = $acces_appareils;
  }
  public function get_acces_cours_groupe() : Int {
    return $this->acces_cours_groupe;
  }
  public function set_acces_cours_groupe(Int $acces_cours_groupe) {
    $this->acces_cours_groupe = $acces_cours_groupe;
  }
  public function get_prix_cours_groupe() : Float {
    return $this->prix_cours_groupe;
  }
  public function set_prix_cours_groupe(Float $prix_cours_groupe) {
    $this->prix_cours_groupe = $prix_cours_groupe;
  }

  public function select_mysql(Int $id) {
    if($id > 0) {
      // MySQL here
      $this->set_nom("Mensuel...");
      $this->set_duree(1);
      $this->set_prix(55.00);
      $this->set_acces_appareils(1);
      $this->set_acces_cours_groupe(1);
      $this->set_prix_cours_groupe(25.00);
    }
  }
  public function insert_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Plan') echo get_class($obj);
    else echo 'wrong type';
  }
  public function update_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Plan') echo get_class($obj);
    else echo 'wrong type';
  }
  public function delete_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Plan') echo get_class($obj);
    else echo 'wrong type';
  }
}
?>
