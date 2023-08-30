<?php declare(strict_types=1);
require_once "Personne.php";

class Specialiste extends Personne implements Modele {

  protected Int $personne = 0;
  protected Int $specialite = 0;
  protected String $mot_passe = "";

  public function get_personne() : Int {
    return $this->personne;
  }
  public function set_personne(Int $personne) {
    $this->personne = $personne;
  }
  public function get_specialite() : Int {
    return $this->specialite;
  }
  public function set_specialite(Int $specialite) {
    $this->specialite = $specialite;
  }
  public function get_mot_passe() : String{
    return $this->mot_passe;
  }
  public function set_mot_passe(String $mot_passe) {
    $this->mot_passe = $mot_passe;
  }

  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      // MySQL here
      $this->set_personne(1);
      $this->set_specialite(1);
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
?>
