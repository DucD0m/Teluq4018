<?php
require_once "Vues/Templates/PageMenu.php";
require_once "Vues/Templates/PageClient.php";
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
echo "ici Gest2";
require_once "Modele/Notification.php";
echo "ici Gest3";
require_once "Controlleurs/fonctions_php.php";
echo "ici Gest4";

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
echo "ici Gest5";exit;
?>
