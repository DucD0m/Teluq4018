<?php
require "Vues/Templates/PageMenu.php";
require "Vues/Templates/PageClient.php";
require "Modele/Client.php";
require "Modele/Plan.php";
require "Modele/ListePlans.php";
require "Modele/Notification.php";
require "Controlleurs/fonctions_php.php";

class GestionnaireControlleur {

  public function afficherPage($connexion_lire) {

      if(isset($_POST['creer-compte']) && $_POST['creer-compte'] === 'oui') {
        $_SESSION['page'] = "PageClient";
        redirection();
      }

      if(isset($_SESSION['page']) && $_SESSION['page'] === "PageClient") {
        $client = new Client();
        // $client->set_prenom("Louis");
        // $client->set_nom("Tremblay");
        // $client->set_adresse("999 Boul. Test, Québec, Qc, G2G 2G2");
        // $client->set_telephone(4185555555);
        // $client->set_courriel("louistremblay@google.com");
        $plans = ListePlans::get_liste($connexion_lire);
        //var_dump($plans);exit;
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
