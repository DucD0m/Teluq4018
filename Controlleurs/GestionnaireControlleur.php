<?php
require "Vues/Templates/PageMenu.php";
require "Vues/Templates/PageClient.php";
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
require_once "Modele/Notification.php";
require_once "Controlleurs/fonctions_php.php";

class GestionnaireControlleur {

  public function afficherPage() {

      if(isset($_POST['creer-compte']) && $_POST['creer-compte'] === 'oui') {
        $_SESSION['page'] = "PageClient";
        redirection();
      }

      if(isset($_SESSION['page']) && $_SESSION['page'] === "PageClient") {
        $client = new Client();
        $plans = array();
        $page = new PageClient($client, $plans);
      }

      else {
        $gestionnaire_id = 1;
        $message = "Test message";
        $page = new PageMenu($gestionnaire_id, $message);
      }
  }
}
?>
