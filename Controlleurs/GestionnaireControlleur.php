<?php
require_once "Vues/Templates/PageMenu.php";
require_once "Vues/Templates/PageClient.php";
require_once "Vues/Templates/PagePlans.php";
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
require_once "Modele/ListePlans.php";
require_once "Modele/Notification.php";
require_once "Controlleurs/Authentification.php";
require_once "Controlleurs/fonctions_php.php";

class GestionnaireControlleur {

  public function afficherPage($connexion_lire, $connexion_ecrire, $connexion_effacer) {

      if(isset($_POST['creer-compte']) && $_POST['creer-compte'] === 'oui') {
        $_SESSION['page'] = "PageClient";
        unset($_SESSION['client-id']);
        redirection();
      }
      else if(isset($_POST['gestion-plans']) && $_POST['gestion-plans'] === 'oui') {
        $_SESSION['page'] = "PagePlans";
        redirection();
      }

      // Si le token csrf ne correspond pas.
      if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        Authentification::quitter();
      }
      // Insertion d'un nouveau compte client.
      else if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-nouveau-client']) && $_POST['formulaire-nouveau-client'] === 'oui') {

        $date = date("Y-m-d",strtotime('now'));
        $plan = new Plan();
        $plan->select_mysql($_POST['plan-id'], $connexion_lire);

        $client = new Client();
        $client->set_prenom($_POST['nouveau-prenom']);
        $client->set_nom($_POST['nouveau-nom']);
        $client->set_adresse($_POST['nouveau-adresse']);
        $client->set_telephone(intval($_POST['nouveau-telephone']));
        $client->set_courriel($_POST['nouveau-courriel']);
        //$client->set_personne() = 0;
        $client->set_adhesion($date);
        $client->set_renouvellement($date);

        if(strpos($plan->get_nom(),"Spécialiste") >= 0 && strpos($plan->get_nom(),"Spécialiste") != '') $client->set_fin_abonnement($date);
        else {
          $fin_abonnement = date("Y-m-d",strtotime("+".$plan->get_duree()." months"));
          $client->set_fin_abonnement($fin_abonnement);
        }

        if($plan->get_acces_appareils() == 1) {
          $fin_acces_appareils = date("Y-m-d",strtotime("+".$plan->get_duree()." months"));
          $client->set_fin_acces_appareils($fin_acces_appareils);
        }
        else {
          $client->set_fin_acces_appareils($date);
        }

        $client->set_heures_specialistes(intval($_POST['client-spec']));
        $client->set_heures_specialistes_utilise(0);
        $client->set_cours_groupe_semaine(intval($_POST['client-groupes']));
        $client->set_plan($_POST['plan-id']);

        $resultat_insertion = $client->insert_mysql($client, $connexion_ecrire);

        if($resultat_insertion > 0) {
          $_SESSION['message'] = "Le nouveau compte client a été créé avec succès.";
          $_SESSION['client-id'] = $resultat_insertion;
        }

        redirection();
      }
      // IModification des plans
      else if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-modifier-plans']) && $_POST['formulaire-modifier-plans'] === 'oui') {

           unset($_POST['formulaire-modifier-plans']);
           unset($_POST['csrf_token']);

           foreach ($_POST as $prix) {
             $plan = new Plan();
             $plan->select_mysql($prix[0],$connexion_lire);
             $plan->set_prix_cours_groupe($prix[1]);
             $plan->set_prix($prix[2]);
             $plan->update_mysql($plan, $connexion_ecrire);
           }

           $_SESSION['message'] = "Les prix ont été modifiés avec succès.";
           redirection();
      }

      if(isset($_SESSION['page']) && $_SESSION['page'] === "PageClient") {
        $client = new Client();
        $plan = new Plan();
        if(isset($_SESSION['client-id']) && $_SESSION['client-id'] > 0) {
          $select_client = $client->select_mysql($_SESSION['client-id'], $connexion_lire);
          $select_plan = $plan->select_mysql($client->get_plan(), $connexion_lire);
        }
        $plans = ListePlans::get_liste($connexion_lire);
        $page = new PageClient($client, $plan, $plans);
      }
      else if(isset($_SESSION['page']) && $_SESSION['page'] === "PagePlans") {
        $plans = ListePlans::get_liste($connexion_lire);
        $page = new PagePlans($plans);
      }
      else {
        $gestionnaire_id = 1;
        $message = "Test message";
        $page = new PageMenu($gestionnaire_id, $message);
      }
  }
}
?>
