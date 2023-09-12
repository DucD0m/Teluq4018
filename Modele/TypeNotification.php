<?php declare(strict_types=1);
require_once "Modele.php";

class TypeNotification implements Modele {

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
      $sql = $connexion_lire->prepare("SELECT * FROM types_notifications WHERE id = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $types_notifications = $sql->fetch(PDO::FETCH_OBJ);

      if($type_notifications) {
        $validation = true;

        $validation = $this->set_id($types_notifications->id);
        $validation = $this->set_nom($types_notifications->nom);

        return $validation;
      }
      else return false;
    }
    else {
      return false;
    }
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code lorsque requis...
  }
  public function update_mysql(Object $connexion_ecrire) : Int|Bool {
    // Code lorsque requis...
  }
  public function delete_mysql(Object $connexion_effacer) : Int|Bool {
    // Code lorsque requis...
  }
}
?>
