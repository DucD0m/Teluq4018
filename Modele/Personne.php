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

  public function select_mysql(Int $id) {
    // Code here
  }
  public function insert_mysql(Object $obj) {
    // if(get_class($obj) === 'Client') {
    //   $sql = $connexion_lecteur->prepare("INSERT INTO personnes (prenom, nom, adresse, telephone, courriel) VALUES (:prenom, :nom, :adresse, :telephone, :courriel)");
    //   $sql->bindParam(':prenom', $courriel, PDO::PARAM_STR);
    //   $sql->bindParam(':nom', $courriel, PDO::PARAM_STR);
    //   $sql->bindParam(':adresse', $courriel, PDO::PARAM_STR);
    //   $sql->bindParam(':telephone', $courriel, PDO::PARAM_INT);
    //   $sql->bindParam(':courriel', $courriel, PDO::PARAM_STR);
    //   $sql->execute();
    // }
  }
  public function update_mysql(Object $obj) {
    // Code here
  }
  public function delete_mysql(Object $obj) {
    // Code here
  }
}
?>
