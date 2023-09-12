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
    if($specialiste_id > 0) {
      $this->specialiste_id = $specialiste_id;
      return true;
    }
    else return false;
  }
  public function get_personne() : Int {
    return $this->personne;
  }
  public function set_personne(Int $personne) {
    if($personne > 0) {
      $this->personne = $personne;
      return true;
    }
    else return false;
  }
  public function get_specialite() : Int {
    return $this->specialite;
  }
  public function set_specialite(Int $specialite) {
    if($specialite > 0) {
      $this->specialite = $specialite;
      return true;
    }
    else return false;
  }
  public function get_mot_passe() : String{
    return $this->mot_passe;
  }
  public function set_mot_passe(String $mot_passe) {
    if(strlen($mot_passe) == 97) {
      $this->mot_passe = $mot_passe;
      return true;
    }
    else return false;
  }

  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT p.*, s.id AS specialiste_id, s.personne, s.specialite FROM personnes p JOIN specialistes s ON p.id = s.personne WHERE s.id = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $specialiste = $sql->fetch(PDO::FETCH_OBJ);

      if($specialiste) {
        $validation = true;

        $validation = $this->set_id($specialiste->id);
        $validation = $this->set_prenom($specialiste->prenom);
        $validation = $this->set_nom($specialiste->nom);
        $validation = $this->set_adresse($specialiste->adresse);
        $validation = $this->set_telephone(intval($specialiste->telephone));
        $validation = $this->set_courriel($specialiste->courriel);
        $validation = $this->set_specialiste_id($specialiste->specialiste_id);
        $validation = $this->set_personne($specialiste->personne);
        $validation = $this->set_specialite($specialiste->specialite);

        return $validation;
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
  public function update_mysql(Object $connexion_ecrire) : Int|Bool {
    if($this->get_specialiste_id() > 0) {
      $sql = $connexion_ecrire->prepare("UPDATE specialistes SET
        mot_passe = :mot_passe
        WHERE id = :id");
      $sql->bindParam(':id', $this->get_specialiste_id(), PDO::PARAM_INT);
      $sql->bindParam(':mot_passe', $this->get_mot_passe(), PDO::PARAM_STR);
      $resultat = $sql->execute();
      return $resultat;
    }
    else {
      return false;
    }
  }
  public function delete_mysql(Object $connexion_effacer) :Int|Bool {
    // Code ici lorsque requis...
  }
}
?>
