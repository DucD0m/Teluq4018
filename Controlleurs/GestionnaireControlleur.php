<?php
require "Vues/Templates/PageMenu.php";
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
require_once "Modele/Notification.php";

class GestionnaireControlleur {

  public function afficherPage() {

      $gestionnaire_id = 1;
      $message = "Test message";
      $page = new PageMenu($gestionnaire_id, $message);

  }
}
?>
