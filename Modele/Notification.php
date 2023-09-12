<?php declare(strict_types=1);
require_once "Modele.php";

class Notification implements Modele {

  private Int $id = 0;
  private String $date_heure = "";
  private Int $type = 0;
  private Int $client = 0;
  private Int $vu = 0; // 0 = non vu, 1 = vu, 2 = non visible.

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
  public function get_date_heure() : String {
    return $this->date_heure;
  }
  public function set_date_heure(String $date_heure) {
    $date = date_create($date_heure);
    if(date_format($date,"Y-m-d H:i:s")) {
      $this->date_heure = date_format($date,"Y-m-d H:i:s");
      return true;
    }
    else return false;
  }
  public function get_type() : Int{
    return $this->type;
  }
  public function set_type(Int $type) {
    if($type > 0) {
      $this->type = $type;
      return true;
    }
    else return false;
  }
  public function get_client() : Int {
    return $this->client;
  }
  public function set_client(Int $client) {
    if($client > 0) {
      $this->client = $client;
      return true;
    }
    else return false;
  }
  public function get_vu() : Int {
    return $this->vu;
  }
  public function set_vu(Int $vu) {
    if($vu >= 0 && $vu <= 255) {
      $this->vu = $vu;
      return true;
    }
    else return false;
  }

  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT * FROM notifications WHERE id = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $notification = $sql->fetch(PDO::FETCH_OBJ);

      if($notification) {
        $validation = true;

        $validation =  $this->set_id($notification->id);
        $validation =  $this->set_date_heure($notification->date_heure);
        $validation =  $this->set_type($notification->type);
        $validation =  $this->set_client($notification->client);
        $validation =  $this->set_vu($notification->vu);

        return $validation;
      }
      else return false;
    }
    else {
      return false;
    }
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    if(get_class($obj) === 'Notification') {

      $notification_date_heure = $obj->get_date_heure();
      $notification_type = $obj->get_type();
      $notification_client = $obj->get_client();

      $sql = $connexion_ecrire->prepare("SELECT client FROM notifications WHERE client = :client");
      $sql->bindParam(':client', $notification_client, PDO::PARAM_INT);
      $sql->execute();
      $client = $sql->fetch(PDO::FETCH_OBJ);
      if(!$client) {
        $sql = $connexion_ecrire->prepare("INSERT INTO notifications (date_heure, type, client, vu) VALUES (:date_heure, :type, :client, 0)");
        $sql->bindParam(':date_heure', $notification_date_heure, PDO::PARAM_STR);
        $sql->bindParam(':type', $notification_type, PDO::PARAM_INT);
        $sql->bindParam(':client', $notification_client, PDO::PARAM_INT);
        $resultat = $sql->execute();
        return $resultat;
      }
      else {
        return false;
      }
    }
    else {
      return false;
    }
  }
  public function update_mysql(Object $connexion_ecrire) : Int|Bool {
    if($this->get_id() > 0) {

      $notification_id = $this->get_id();
      $notification_date_heure = $this->get_date_heure();
      $notification_type = $this->get_type();
      $notification_client = $this->get_client();
      $notification_vu = $this->get_vu();

      $sql = $connexion_ecrire->prepare("UPDATE notifications SET date_heure = :date_heure, type = :type, client = :client, vu = :vu WHERE id = :id");
      $sql->bindParam(':id', $notification_id, PDO::PARAM_INT);
      $sql->bindParam(':date_heure', $notification_date_heure, PDO::PARAM_STR);
      $sql->bindParam(':type', $notification_type, PDO::PARAM_INT);
      $sql->bindParam(':client', $notification_client, PDO::PARAM_INT);
      $sql->bindParam(':vu', $notification_vu, PDO::PARAM_INT);
      $resultat = $sql->execute();
      return $resultat;
    }
    else {
      return false;
    }
  }
  public function delete_mysql(Object $connexion_effacer) : Int|Bool {
    if($this->get_id() > 0) {

      $notification_id = $this->get_id();

      $sql = $connexion_effacer->prepare("DELETE FROM notifications WHERE id = :id");
      $sql->bindParam(':id', $notification_id, PDO::PARAM_INT);
      $resultat = $sql->execute();
      return $resultat;
    }
    else{
      return false;
    }
  }
}
?>
