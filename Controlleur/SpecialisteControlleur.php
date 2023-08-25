<?php
require_once "Modele/Client.php";
require_once "Modele/Specialiste.php";
require_once "Modele/RendezVous.php";

class SpecialisteControlleur {
  public function afficherPage() {
    $client = new Client();
    $client->select_mysql(1);
    echo $client->get_heures_specialistes()."\n";
    $specialiste = new Specialiste();
    $specialiste->select_mysql(1);
    if($specialiste->get_specialite() == 1) echo "Physio\n";
  }
}
?>
