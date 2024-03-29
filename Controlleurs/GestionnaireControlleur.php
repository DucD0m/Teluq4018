<?php
require_once "Vues/Templates/PageMenu.php";
require_once "Vues/Templates/PageClient.php";
require_once "Vues/Templates/PagePlans.php";
require_once "Vues/Templates/PageNotifications.php";
require_once "Modele/Gestionnaire.php";
require_once "Modele/Client.php";
require_once "Modele/Plan.php";
require_once "Modele/ListePlans.php";
require_once "Modele/Notification.php";
require_once "Modele/TypeNotification.php";
require_once "Modele/ListeNotifications.php";
require_once "Controlleurs/Authentification.php";
require_once "Controlleurs/fonctions_php.php";

class GestionnaireControlleur {

  public function afficherPage($connexion_lire, $connexion_ecrire, $connexion_effacer) {

      $gestionnaire = new Gestionnaire();
      $gestionnaire->select_personne_mysql($_SESSION['id'], $connexion_lire);
      $date = date("Y-m-d",strtotime('now'));


      /************************************************************************
      *                                                                       *
      *                  NAVIGATION BOUTONS MENU GESTIONNAIRE                 *
      *                                                                       *
      ************************************************************************/

      if(isset($_POST['creer-compte']) && $_POST['creer-compte'] === 'oui') {
        $_SESSION['page'] = "PageClient";
        unset($_SESSION['client-id']);
        redirection();
      }
      else if(isset($_POST['visualiser-compte']) && $_POST['visualiser-compte'] === 'oui') {
        $_SESSION['page'] = "PageClient";
        unset($_SESSION['client-id']);

        $client_id_pos = strpos(strval($_POST['vis-client'])," -");
        $client_id = substr(strval($_POST['vis-client']),0,$client_id_pos);

        if(intval($client_id) > 0) {
          $_SESSION['client-id'] = $client_id;
        }

        redirection();
      }
      else if(isset($_POST['gestion-plans']) && $_POST['gestion-plans'] === 'oui') {
        $_SESSION['page'] = "PagePlans";
        redirection();
      }
      else if(isset($_POST['gestion-notifications']) && $_POST['gestion-notifications'] === 'oui') {
        $_SESSION['page'] = "PageNotifications";
        if(isset($_POST['type-notifications']) && $_POST['type-notifications'] === '1') {
          $_SESSION['type_notifications'] = '1';
        }
        else if(isset($_POST['type-notifications']) && $_POST['type-notifications'] === '2') {
          $_SESSION['type_notifications'] = '2';
        }
        redirection();
      }

      /************************************************************************
      *                                                                       *
      *            MODIFICATION BASE DE DONNEES GESTIONNAIRE                  *
      *                                                                       *
      ************************************************************************/

      // Si le token csrf ne correspond pas.
      if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        Authentification::quitter();
      }
      // Insertion d'un nouveau compte client.
      else if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-nouveau-client']) && $_POST['formulaire-nouveau-client'] === 'oui') {

        $validation = true;

        $plan = new Plan();
        $validation = $plan->select_mysql(intval($_POST['plan-id']), $connexion_lire);

        $client = new Client();
        if(!$client->set_prenom(strval($_POST['nouveau-prenom']))) $validation = false;
        if(!$client->set_nom(strval($_POST['nouveau-nom']))) $validation = false;
        if(!$client->set_adresse(strval($_POST['nouveau-adresse']))) $validation = false;
        if(!$client->set_telephone(intval($_POST['nouveau-telephone']))) $validation = false;
        if(!$client->set_courriel(strval($_POST['nouveau-courriel']))) $validation = false;
        if(!$client->set_adhesion($date)) $validation = false;
        if(!$client->set_renouvellement($date)) $validation = false;

        if(strpos($plan->get_nom(),"Spécialiste") >= 0 && strpos($plan->get_nom(),"Spécialiste") != '') {
          if(!$client->set_fin_abonnement($date)) $validation = false;
        }
        else {
          $fin_abonnement = date("Y-m-d",strtotime("+".$plan->get_duree()." months"));
          if(!$client->set_fin_abonnement($fin_abonnement)) $validation = false;
        }

        if($plan->get_acces_appareils() == 1) {
          $fin_acces_appareils = date("Y-m-d",strtotime("+".$plan->get_duree()." months"));
          if(!$client->set_fin_acces_appareils($fin_acces_appareils)) $validation = false;
        }
        else {
          if(!$client->set_fin_acces_appareils($date)) $validation = false;
        }

        if(!$client->set_heures_specialistes(intval($_POST['client-spec']))) $validation = false;
        if(!$client->set_heures_specialistes_utilise(0)) $validation = false;
        if(!$client->set_cours_groupe_semaine(intval($_POST['client-groupes']))) $validation = false;
        if(!$client->set_plan(intval($_POST['plan-id']))) $validation = false;

        $resultat_insertion = 0;

        if($validation) {
          $resultat_insertion = $client->insert_mysql($client, $connexion_ecrire);
        }

        if($resultat_insertion > 0) {
          $_SESSION['message'] = "Le nouveau compte client a été créé avec succès.";
          $_SESSION['client-id'] = $resultat_insertion;
        }
        else $_SESSION['message'] = "Il y a eu un problème avec la création du compte. Veuillez vérifier et essayer de nouveau.";

        redirection();
      }
      // Modification de la table personne d'un client (formulaire de gauche de la page client existant).
      else if (isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-client-personne']) && $_POST['formulaire-client-personne'] === 'oui') {

           $validation = true;

           $client = new Client();
           $validation = $client->select_mysql(intval($_POST['client-id']), $connexion_lire);

           if(!$client->set_prenom(strval($_POST['client-prenom']))) $validation = false;
           if(!$client->set_nom(strval($_POST['client-nom']))) $validation = false;
           if(!$client->set_adresse(strval($_POST['client-adresse']))) $validation = false;
           if(!$client->set_telephone(intval($_POST['client-telephone']))) $validation = false;
           if(!$client->set_courriel(strval($_POST['client-courriel']))) $validation = false;

           $resultat_update = 0;

           if($validation) {
             $resultat_update = $client->update_personne_mysql($connexion_ecrire);
           }

           if($resultat_update > 0) {
             $_SESSION['message'] = "La mise à jour des informations personnelles du client a été accomplie avec succès.";
           }
           else {
             $_SESSION['message'] = "Il y a eu un problème avec la lise à jour des informations personnelles. Veuillez vérifier et essayer de nouveau.";
           }

           $_SESSION['client-id'] = $client->get_id();
           redirection();
      }
      // Modification de la table client (formulaire de droite de la page client existant).
      else if (isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-client-plan']) && $_POST['formulaire-client-plan'] === 'oui') {

           $validation = true;

           $plan = new Plan();
           $validation = $plan->select_mysql(intval($_POST['plan-id']), $connexion_lire);

           $client = new Client();
           $validation = $client->select_mysql(intval($_POST['client-personne']), $connexion_lire);

           // Si on ajoute des heures spécialistes à un abonnement. On ne change pas la date de renouvellement.
           if(strpos($plan->get_nom(),"Spécialiste") >= 0 && strpos($plan->get_nom(),"Spécialiste") != '') {
             // On garde la même date de renouvelement.
           }
           // Si on prolonge un abonnement précédent qui vient à échéance d'ici 30jours.
           else if(strtotime($client->get_fin_abonnement()) >= strtotime($date) && strtotime($date) >= strtotime($client->get_fin_abonnement()." -1 month")) {
             // La date de fin d'abonnement devient la date de renouvellement.
             if(!$client->set_renouvellement(date("Y-m-d",strtotime($client->get_fin_abonnement())))) $validation = false;
           }
           // Si on ajoute un nouvel abonnement après la date d'échéance de l'abonnement précédent.
           else {
             // La date de renouvellement est aujourd'hui.
             if(!$client->set_renouvellement($date)) $validation = false;
           }

           if(strpos($plan->get_nom(),"Spécialiste") >= 0 && strpos($plan->get_nom(),"Spécialiste") != '') {
             // On garde la même date de fin d'abonnement.
             // On affiche l'ancien plan.
           }
           else {
             $fin_abonnement = date("Y-m-d",strtotime($client->get_renouvellement()." +".$plan->get_duree()." months"));
             if(!$client->set_fin_abonnement($fin_abonnement)) $validation = false;
             if(!$client->set_plan(intval($_POST['plan-id']))) $validation = false;
           }

           if($plan->get_acces_appareils() == 1) {
             $fin_acces_appareils = date("Y-m-d",strtotime($client->get_renouvellement()." +".$plan->get_duree()." months"));
             if(!$client->set_fin_acces_appareils($fin_acces_appareils)) $validation = false;
           }

           // On ajoute les nouvelles heures spécialistes. On ne remet jamais le compteur à 0 ici. (Le compteur est remis à 0 lorsque le client
           // utilise sa dernière heure.)
           $somme_heures_specialistes = $client->get_heures_specialistes() + intval($_POST['client-spec']);
           if(!$client->set_heures_specialistes(intval($somme_heures_specialistes))) $validation = false;
           if(strpos($plan->get_nom(),"Spécialiste") >= 0 && strpos($plan->get_nom(),"Spécialiste") != '') {
             // On garde le même nombre de cours de groupe.
           }
           else {
             if(!$client->set_cours_groupe_semaine(intval($_POST['client-groupes']))) $validation = false;
           }

           $resultat_update = 0;

           if($validation) {
             $resultat_update = $client->update_mysql($connexion_ecrire);
           }

           if($resultat_update > 0) {
             $_SESSION['message'] = "La mise à jour du plan du client a été accomplie avec succès.";
           }
           else {
             $_SESSION['message'] = "Il y a eu un problème avec la mise à jour du plan. Veuillez vérifier et essayer de nouveau.";
           }

           $_SESSION['client-id'] = $client->get_id();
           redirection();
      }
      // Supprimer un compte client.
      else if (isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-supprimer-client']) && $_POST['formulaire-supprimer-client'] === 'oui') {

           $validation = true;

           $client = new Client();
           $validation = $client->select_mysql(intval($_POST['client-personne']), $connexion_lire);

           $resultat_delete = 0;

           if($validation) {
             $resultat_delete = $client->delete_personne_mysql($connexion_effacer);
           }

           if($resultat_delete > 0) {
             $_SESSION['message'] = "Le compte a été supprimé avec succès.";
             unset($_SESSION['client-id']);
             unset($_SESSION['page']);
           }
           else {
             $_SESSION['message'] = "Il y a eu un problème. Le compte n'a pas été supprimé. Veuillez vérifier et essayer de nouveau.";
             $_SESSION['client-id'] = $client->get_id();
           }

           redirection();
      }
      // Modification des plans
      else if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-modifier-plans']) && $_POST['formulaire-modifier-plans'] === 'oui') {

           unset($_POST['formulaire-modifier-plans']);
           unset($_POST['csrf_token']);

           $_SESSION['message'] = "";

           foreach ($_POST as $prix) {

             $validation = true;

             $plan = new Plan();
             $plan_id = intval($prix[0]);
             $plan_prix_cours_groupe = floatval($prix[1]);
             $plan_prix = floatval($prix[2]);
             $validation = $plan->select_mysql($plan_id,$connexion_lire);
             if(!$plan->set_prix_cours_groupe($plan_prix_cours_groupe)) $validation = false;
             if(!$plan->set_prix($plan_prix)) $validation = false;

             $resultat_update = 0;

             if($validation) {
               $resultat_update = $plan->update_mysql($connexion_ecrire);
             }

             if($resultat_update > 0) {
               // On laisse le message tel quel.
             }
             else $_SESSION['message'] = "Il y a eu un problème avec la modification des prix. Veuillez vérifier et essayer de nouveau";
           }
           if($_SESSION['message'] === '') $_SESSION['message'] = "Les prix ont été modifiés avec succès.";
           redirection();
      }
      // Marquer une notification comme vue.
      else if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-notification-vu']) && $_POST['formulaire-notification-vu'] === 'oui' &&
         isset($_POST['notification-vu-id']) && intval($_POST['notification-vu-id']) > 0) {

         $vaidation = true;
         $id = intval($_POST['notification-vu-id']);

         $notification = new Notification();
         $validation = $notification->select_mysql($id, $connexion_lire);

         if(!$notification->set_vu(1)) $validation = false;

         $resultat_update = 0;

         if($validation) {
           $resultat_update = $notification->update_mysql($connexion_ecrire);
         }

         if($resultat_update > 0) {
           // Aucun message. L'utilisateur va voir les changements visuellement.
         }
         else {
           $_SESSION['message'] = "Il y a eu un problème avec la mise à jour de la notification. Veuillez vérifier et essayer de nouveau.";
         }
         redirection();
      }
      // Supprimer une notification
      else if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
         isset($_POST['formulaire-notification-supprimer']) && $_POST['formulaire-notification-supprimer'] === 'oui' &&
         isset($_POST['notification-supprimer-id']) && intval($_POST['notification-supprimer-id']) > 0) {

         $validation = true;

         $id = intval($_POST['notification-supprimer-id']);

         $notification = new Notification();
         $validation = $notification->select_mysql($id, $connexion_lire);

         if(!$notification->set_vu(2)) $validation = false;

         $resultat_update = 0;

         if($validation) {
           $resultat_update = $notification->update_mysql($connexion_ecrire);
         }

         if($resultat_update > 0) {
           // Aucun message. L'utilisateur va voir les changements visuellement.
         }
         else {
           $_SESSION['message'] = "Il y a eu un problème avec la mise à jour de la notification. Veuillez vérifier et essayer de nouveau.";
         }
         redirection();
      }


      /************************************************************************
      *                                                                       *
      *                       NAVIGATION PAGES                                *
      *                                                                       *
      ************************************************************************/

      if(isset($_SESSION['page']) && $_SESSION['page'] === "PageClient") {
        $client = new Client();
        $plan = new Plan();
        if(isset($_SESSION['client-id']) && $_SESSION['client-id'] > 0) {
          $select_client = $client->select_mysql($_SESSION['client-id'], $connexion_lire);
          $select_plan = $plan->select_mysql($client->get_plan(), $connexion_lire);
        }
        $plans = ListePlans::get_liste($connexion_lire);
        $page = new PageClient($gestionnaire, $client, $plan, $plans);
      }
      else if(isset($_SESSION['page']) && $_SESSION['page'] === "PagePlans") {
        $plans = ListePlans::get_liste($connexion_lire);
        $page = new PagePlans($gestionnaire, $plans);
      }
      else {
        $mise_a_jour_notifications = ListeNotifications::mise_a_jour_bd($connexion_lire, $connexion_ecrire);
        $notifications_expires = ListeNotifications::get_liste(1,$connexion_lire);
        $notifications_30jours = ListeNotifications::get_liste(2,$connexion_lire);

        if(isset($_SESSION['page']) && $_SESSION['page'] === "PageNotifications") {
          if(isset($_SESSION['type_notifications']) && $_SESSION['type_notifications'] === "1") {
            $type_notifications = new TypeNotification();
            $type_notifications->select_mysql(1, $connexion_lire);
            $page = new PageNotifications($gestionnaire, $type_notifications, $notifications_expires);
          }
          else if(isset($_SESSION['type_notifications']) && $_SESSION['type_notifications'] === "2") {
            $type_notifications = new TypeNotification();
            $type_notifications->select_mysql(2, $connexion_lire);
            $page = new PageNotifications($gestionnaire, $type_notifications, $notifications_30jours);
          }
          else {
            unset($_SESSION['page']);
            unset($_SESSION['type_notifications']);
            redirection();
          }
        }
        else {
          $nombre_expires = count($notifications_expires);
          $nombre_30jours = count($notifications_30jours);
          $page = new PageMenu($gestionnaire, $nombre_expires, $nombre_30jours);
        }
      }
  }
}
?>
