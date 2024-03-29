<?php declare(strict_types=1);
require_once "Modele.php";

class Specialite implements Modele {

  protected Int $id = 0;
  protected String $nom = "";

  public function get_id() : Int {
    return $this->id;
  }
  public function set_id(Int $id) {
    if($id > 0) {
      $this->id = $id;
      return true;
    }
    else return false;
  }
  public function get_nom() : String {
    return $this->nom;
  }
  public function set_nom(String $nom) {
    if(strlen($nom) > 0 && strlen($nom) <= 32) {
      $this->nom = $nom;
      return true;
    }
    else return false;
  }

  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT * FROM specialites WHERE id = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $specialite = $sql->fetch(PDO::FETCH_OBJ);

      if($specialite) {
        $validation = true;

        $validation = $this->set_id($specialite->id);
        $validation = $this->set_nom($specialite->nom);

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
    // Code ici lorsque requis...
  }
  public function delete_mysql(Object $connexion_effacer) :Int|Bool {
    // Code ici lorsque requis...
  }
}
?>
