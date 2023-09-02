<?php
require_once "Vues/Templates/PageMenu.php";
require_once "Vues/Templates/PageClient.php";
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
require_once "Modele/ListePlans.php";
require_once "Modele/Notification.php";
require_once "Controlleurs/fonctions_php.php";

class GestionnaireControlleur {

  public function afficherPage($connexion_lire, $connexion_ecrire, $connexion_effacer) {

      if(isset($_POST['creer-compte']) && $_POST['creer-compte'] === 'oui') {
        $_SESSION['page'] = "PageClient";
        redirection();
      }

      if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-nouveau-client']) && $_POST['formulaire-nouveau-client'] === 'oui') {

        $date = date("Y-m-d H:i:s",strtotime('now'));
        $plan = new Plan();
        $plan->select_mysql($_POST['plan-id'], $connexion_lire);

        $client = new Client();
        $client->set_prenom($_POST['nouveau-prenom']);
        $client->set_nom($_POST['nouveau-nom']);
        $client->set_adresse($_POST['nouveau-adresse']);
        $client->set_telephone($_POST['nouveau-telephone']);
        $client->set_courriel($_POST['nouveau-courriel']);
        //$client->set_personne() = 0;
        $client->set_adhesion($date);
        $client->set_renouvellement($date);

        if(strpos($plan->nom,"Spécialiste") >= 0) $client->set_fin_abonnement($date);
        else {
          $fin_abonnement = date("Y-m-d",strtotime("+$plan->duree month"));
          $client->set_fin_abonnement($fin_abonnement);
        }

        if($plan->acces_appareils == 1) {
          $fin_abonnement = date("Y-m-d",strtotime("+$plan->duree month"));
          $client->set_fin_acces_appareils();
        }
        else {
          $client->set_fin_acces_appareils($date);
        }

        $client->set_heures_specialistes($_POST['client-spec']);
        $client->set_heures_specialistes_utilise(0);
        $client->set_cours_groupe_semaine($_POST['client-groupes']);
        $client->set_plan($plan->id);
        var_dump($client);exit;
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
