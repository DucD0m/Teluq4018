<?php declare(strict_types=1);
require_once "Modele.php";

class RendezVous implements Modele {

  private $date_heure;
  private $client;
  private $specialiste;

  public function get_date_heure() : String{
    return $this->date_heure;
  }
  public function set_date_heure(String $date_heure) {
    $this->date_heure = $date_heure;
  }
  public function get_client() : Int {
    return $this->client;
  }
  public function set_client(Int $client) {
    $this->client = $client;
  }
  public function get_specialiste() : Int {
    return $this->specialiste;
  }
  public function set_specialiste(Int $specialiste) {
    $this->specialiste = $specialiste;
  }

  public function select_mysql(Int $id) {
    // Code here
    if($id > 0) echo gettype($id);
  }
  public function insert_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'RendezVous') echo get_class($obj);
    else echo 'wrong type';
  }
  public function update_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'RendezVous') echo get_class($obj);
    else echo 'wrong type';
  }
  public function delete_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'RendezVous') echo get_class($obj);
    else echo 'wrong type';
  }
}
?>
