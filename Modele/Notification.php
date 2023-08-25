<?php declare(strict_types=1);
require_once "Modele.php";

class Notification implements Modele {

  private $id;
  private $date_heure;
  private $type;
  private $client;
  private $vu;

  public function get_id() : Int {
    return $this->id;
  }
  public function set_id(Int $id) {
    $this->id = $id;
  }
  public function get_date_heure() : String {
    return $this->date_heure;
  }
  public function set_date_heure(String $date_heure) {
    $this->date_heure = $date_heure;
  }
  public function get_type() : Int{
    return $this->type;
  }
  public function set_type(Int $type) {
    $this->type = $type;
  }
  public function get_client() : Int {
    return $this->client;
  }
  public function set_client(Int $client) {
    $this->client = $client;
  }
  public function get_vu() : Int {
    return $this->vu;
  }
  public function set_vu(Int $vu) {
    $this->vu = $vu;
  }

  public function select_mysql(Int $id) {
    // Code here
    if($id > 0) echo gettype($id);
  }
  public function insert_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Notification') echo get_class($obj);
    else echo 'wrong type';
  }
  public function update_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Notification') echo get_class($obj);
    else echo 'wrong type';
  }
  public function delete_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Notification') echo get_class($obj);
    else echo 'wrong type';
  }
}
?>
