<?php declare(strict_types=1);
require_once "Modele.php";

class Specialite implements Modele {

  protected Int $id = 0;
  protected String $nom = "";

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

  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT * FROM specialites WHERE id = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $specialite = $sql->fetch(PDO::FETCH_OBJ);

      if($specialite) {
        $this->set_id($specialiste->id);
        $this->set_nom($specialiste->nom);

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
