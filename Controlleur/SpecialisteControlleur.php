<?php
require_once "Modele/Client.php";
require_once "Modele/Specialiste.php";
require_once "Modele/RendezVous.php";

class SpecialisteControlleur {
  public function afficherPage() {
    // $client = new Client();
    // $client->select_mysql(1);
    // echo $client->get_heures_specialistes()."\n";
    // $specialiste = new Specialiste();
    // $specialiste->select_mysql(1);
    // if($specialiste->get_specialite() == 1) echo "Physio\n";

    if(isset($_POST['rdv-client']) && $_POST['rdv-client'] > 0 &&
       isset($_POST['rdv-date']) && format_date($_POST['rdv-date'], "yy-mm-dd") &&
       isset($_POST['rdv-heure']) && format_date($_POST['rdv-heure'], "hh-mm")) {

        $client_id = $_POST['rdv-client'];
        $date = $_POST['rdv-date'];
        $heure = $_POST['rdv-heure'];
        // Vérifier si client a des heures specialiste disponible
        $client = new Client();
        $client->select_mysql($client_id);
        if($client->get_heures_specialistes() >= 1) {

        }
        else {
          $message = "Le rendez-vous ne peut être fixé. La banque d'heures du client est vide.";
        }
        $rendez_vous = new RendezVous();

    }
    $specialiste_id = 1;
    $message = "Test message";
    $page = new PageRendezVous($specialise_id,$message);
  }
}
?>
