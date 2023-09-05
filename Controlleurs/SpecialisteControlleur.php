<?php
require_once "Vues/Templates/PageRendezVous.php";
require_once "Modele/Client.php";
require_once "Modele/Specialiste.php";
require_once "Modele/Specialite.php";
require_once "Modele/RendezVous.php";
require_once "Modele/ListeRendezVous.php";
require_once "Controlleurs/fonctions_php.php";

class SpecialisteControlleur {

  public function afficherPage($connexion_lire, $connexion_ecrire, $connexion_effacer) {

    $specialiste = new Specialiste();
    $specialiste->select_mysql($_SESSION['id'], $connexion_lire);

    $specialite = new Specialite();
    $specialite->select_mysql($specialiste->get_specialite(), $connexion_lire);

    if(isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'] &&
       isset($_POST['formulaire-rendez-vous-specialiste']) && $_POST['formulaire-rendez-vous-specialiste'] === 'oui' &&
       isset($_POST['rdv-client']) && $_POST['rdv-client'] != '' &&
       isset($_POST['rdv-date']) && isset($_POST['rdv-heure']) &&
       date_format(date_create($_POST['rdv-date']." ".$_POST['rdv-heure']), "Y-m-d H:i")) {

        $client_id_pos = strpos($_POST['rdv-client']," -");
        $client_id = substr($_POST['rdv-client'],0,$client_id_pos);

        $date_heure = $_POST['rdv-date']." ".$_POST['rdv-heure'];
        $date_format = date_format(date_create($_POST['rdv-date']." ".$_POST['rdv-heure']), "Y-m-d H:i:s");

        $client = new Client();
        $client->select_mysql($client_id, $connexion_lire);

        // Vérifier si client a des heures specialiste disponible
        if($client->get_heures_specialistes_utilise() < $client->get_heures_specialistes()) {

          $_SESSION['message'] = "";

          $rdv_specialiste_verification = false;
          $rdv_client_verification = false;

          // Vérifier si le client ou le spécialiste à déjà un rendez-vous à ce moment.
          $liste_rdv_specialiste = ListeRendezVous::get_liste($specialiste, $connexion_lire);
          $liste_rdv_client = ListeRendezVous::get_liste($client, $connexion_lire);

          foreach ($liste_rdv_specialiste as $rdv_specialiste) {
            if($rdv_specialiste->get_date_heure() == $date_format) {
              $rdv_specialiste_verification = true;
            }
          }

          foreach ($liste_rdv_client as $rdv_client) {
            if($rdv_client->get_date_heure() == $date_format) {
              $rdv_client_verification = true;
            }
          }

          if($rdv_specialiste_verification === true) {
            $_SESSION['message'] .= "Le spécialiste a déjà un rendez-vous à ce moment.";
          }

          if($rdv_client_verification === true) {
            $_SESSION['message'] .= "Le client a déjà un rendez-vous à ce moment.";
          }

          if($rdv_specialiste_verification === false && $rdv_client_verification === false) {

            $rendez_vous = new RendezVous();
            $rendez_vous->set_date_heure($date_heure);
            $rendez_vous->set_client($client->get_personne());
            $rendez_vous->set_specialiste($specialiste->get_specialiste_id());

            $resultat_insertion = $rendez_vous->insert_mysql($rendez_vous, $connexion_ecrire);

            if($resultat_insertion > 0) {
              $_SESSION['message'] = "Le nouveau rendez-vous a été fixé avec succès.";

              $heures_specialistes_utilise = $client->get_heures_specialistes_utilise() + 1;
              $client->set_heures_specialistes_utilise($heures_specialistes_utilise);

              $resultat_update = $client->update_mysql($client, $connexion_ecrire);

              if($resultat_update > 0) {
                $_SESSION['message'] .= "La mise à jour des heures spécialistes du client a été accomplie avec succès.";
              }
              else {
                $_SESSION['message'] .= "Il y a eu un problème avec la mise à jour des heures spécialistes du client. Veuillez vérifier et essayer de nouveau.";
              }
            }
            else $_SESSION['message'] = "Il y a eu un problème avec la prise du rendez-vous. Veuillez vérifier et essayer de nouveau.";
          }
        }
        else {
          $_SESSION['message'] = "Le rendez-vous ne peut être fixé. La banque d'heures du client est vide.";
        }

        redirection();
    }
    else if(!empty($_POST)) {
        $_SESSION['message'] = "Il y a eu un problème. Le rendez-vous n'a pas été fixé. Veuillez vérifier et essayer de nouveau.";
        $page = new PageRendezVous($specialiste, $specialite);
    }
    else $page = new PageRendezVous($specialiste, $specialite);
  }
}
?>
