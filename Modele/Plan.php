<?php declare(strict_types=1);
require_once "Modele.php";

class Plan implements Modele {

  private Int $id = 0;
  private String $nom = "";
  private Int $duree = 0;
  private Float $prix = 0.00;
  private Int $acces_appareils = 0;
  private Int $acces_cours_groupe = 0;
  private Float $prix_cours_groupe = 0.00;

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

  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
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
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code here
  }
  public function update_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code here
  }
  public function delete_mysql(Object $obj, Object $connexion_effacer) :Int|Bool {
    // Code here
  }
}
$plan = new Plan();
$plan->set_id(1);
$plan->set_nom("test");
$plan->set_duree(1);
$plan->set_prix(50.00);
$plan->set_acces_appareils(1);
$plan->set_acces_cours_groupe(1);
$plan->set_prix_cours_groupe(10.90);
var_dump($plan);
?>
