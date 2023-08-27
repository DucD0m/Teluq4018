<?php
require "Vues/Templates/PageRendezVous.php";
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
require_once "Modele/Notification.php";

class GestionnaireControlleur {

  public function afficherPage() {

    if(!isset($_POST)) {
      $page = new PageMenu();
    }

  }
}
?>
