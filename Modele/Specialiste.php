<?php declare(strict_types=1);
require_once "Personne.php";

class Specialiste extends Personne implements Modele {

  protected Int $specialiste_id = 0;
  protected Int $personne = 0;
  protected Int $specialite = 0;
  protected String $mot_passe = "";

  public function get_specialiste_id() : Int {
    return $this->specialiste_id;
  }
  public function set_specialiste_id(Int $specialiste_id) {
    $this->specialiste_id = $specialiste_id;
  }
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
      $sql = $connexion_lire->prepare("SELECT p.*, s.id AS specialiste_id, s.personne, s.specialite FROM personnes p JOIN specialistes s ON p.id = s.personne WHERE s.id = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $specialiste = $sql->fetch(PDO::FETCH_OBJ);

      if($specialiste) {
        $this->set_id($specialiste->id);
        $this->set_prenom($specialiste->prenom);
        $this->set_nom($specialiste->nom);
        $this->set_adresse($specialiste->adresse);
        $this->set_telephone(intval($specialiste->telephone));
        $this->set_courriel($specialiste->courriel);
        $this->set_specialiste_id($specialiste->specialiste_id);
        $this->set_personne($specialiste->personne);
        $this->set_specialite($specialiste->specialite);

        return true;
      }
      else return false;
    }
    else {
      return false;
    }
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code ici lorsque requis...
  }
  public function update_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code ici lorsque requis...
  }
  public function delete_mysql(Object $obj, Object $connexion_effacer) :Int|Bool {
    // Code ici lorsque requis...
  }
}
?>
