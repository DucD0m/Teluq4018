<?php
require "Vues/Templates/PageMenu.php";
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
require_once "Modele/Notification.php";

class GestionnaireControlleur {

  public function afficherPage() {

      $page = new PageMenu();

  }
}
?>
