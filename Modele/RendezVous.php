<?php declare(strict_types=1);
require_once "Modele.php";

class RendezVous implements Modele {

  private String $date_heure = "";
  private Int $client = 0;
  private Int $specialiste = 0;

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

  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    // Code here
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code here
  }
  public function update_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code here
  }
  public function delete_mysql(Object $obj, Object $connexion_effacer) : Int|Bool {
    // Code here
  }
}
?>
