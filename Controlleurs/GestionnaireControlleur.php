<?php
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
require_once "Modele/Notification.php";

class GestionnaireControlleur {
  public function afficherPage() {
    $client = new Client();
    $client->select_mysql(1);
    echo $client->get_adhesion()."\n";
    $plan = new Plan();
    $plan->select_mysql(1);
    echo $plan->get_nom()."\n";
  }
}
?>
