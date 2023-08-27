<?php
require "Vues/Templates/PageMenu.php";
require "Vues/Templates/PageClient.php";
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
require_once "Modele/Notification.php";

class GestionnaireControlleur {

  public function afficherPage() {

      if(isset($_POST['creer-compte']) && $_POST['creer-compte'] === 'oui') {
        $client = new Client();
        $plans = array();
        $page = new PageClient($client, $plans);
        $_SESSION['page'] = "PageClient";

        // POST REDIRECT GET pattern
        header('Location: http://10.0.1.18', true, 303);
        exit;
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
