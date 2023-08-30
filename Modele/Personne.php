<?php declare(strict_types=1);
require_once "Modele.php";

abstract class Personne implements Modele {

  private Int $id = 0;
  private String $prenom = "";
  private String $nom = "";
  private String $adresse = "";
  private Int $telephone = 0;
  private String $courriel = "";

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
  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT * FROM personnes WHERE id = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $personne = $sql->fetch(PDO::FETCH_OBJ);
      return $personne;
    }
    else {
      return false;
    }
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    if(get_class($obj) === 'Client' || get_class($obj) === 'Gestionnaire' || get_class($obj) === 'Specialiste') {
      $sql = $connexion_ecrire->prepare("INSERT INTO personnes (prenom, nom, adresse, telephone, courriel) VALUES (:prenom, :nom, :adresse, :telephone, :courriel)");
      $sql->bindParam(':prenom', $obj->get_prenom(), PDO::PARAM_STR);
      $sql->bindParam(':nom', $obj->get_nom(), PDO::PARAM_STR);
      $sql->bindParam(':adresse', $obj->get_adresse(), PDO::PARAM_STR);
      $sql->bindParam(':telephone', $obj->get_telephone(), PDO::PARAM_INT);
      $sql->bindParam(':courriel', $obj->get_courriel(), PDO::PARAM_STR);
      $sql->execute();
      $insert_id = $connexion_ecrire->lastInsertId();
      return (Int)$insert_id;
    }
    else {
      return false;
    }
  }
  public function update_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    if(get_class($obj) === 'Client' || get_class($obj) === 'Gestionnaire' || get_class($obj) === 'Specialiste') {
      $sql = $connexion_ecrire->prepare("UPDATE personnes SET prenom = :prenom, nom = :nom, adresse = :adresse, telephone = :telephone, courriel = :courriel WHERE id = :id");
      $sql->bindParam(':id', $obj->get_id(), PDO::PARAM_INT);
      $sql->bindParam(':prenom', $obj->get_prenom(), PDO::PARAM_STR);
      $sql->bindParam(':nom', $obj->get_nom(), PDO::PARAM_STR);
      $sql->bindParam(':adresse', $obj->get_adresse(), PDO::PARAM_STR);
      $sql->bindParam(':telephone', $obj->get_telephone(), PDO::PARAM_INT);
      $sql->bindParam(':courriel', $obj->get_courriel(), PDO::PARAM_STR);
      $sql->execute();
      return $sql;
    }
    else {
      return false;
    }
  }
  public function delete_mysql(Object $obj, Object $connexion_effacer) : Int|Bool {
    if((get_class($obj) === 'Client' || get_class($obj) === 'Gestionnaire' || get_class($obj) === 'Specialiste') && $obj->get_id() > 0) {
      // $sql = $connexion_effacer->prepare("DELETE FROM personnes WHERE id = :id");
      // $sql->bindParam(':id', $obj->get_id(), PDO::PARAM_INT);
      // $sql->execute();
      // return $sql;
      return true;
    }
    else{
      return false;
    }
  }
}
?>
