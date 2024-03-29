<?php
ini_set('error_reporting','E_ALL');
ini_set('display_errors','On');
ini_set('display_startup_errors','On');

require_once "Modele/Client.php";

class ClientTest {

    public static function test_client($connexion_lire,$connexion_ecrire,$connexion_effacer) {

        $client = new Client();
        $client_comparaison = new Client();
        $date = new DateTime('now');
        $message = "";

        $client->set_id(0);
        $client->set_prenom("Jean");
        $client->set_nom("Smith");
        $client->set_adresse("123 rue test, Montréal, Qc, J2J 1J1");
        $client->set_telephone(5145555555);
        $client->set_courriel("jeansmith@hotmail.com");
        $client_comparaison = $client;

        $client_id = $client->insert_personne_mysql($client, $connexion_ecrire);
        if($client_id == 0){
          $message .= "Le test insert_personne_mysql à échoué\n";
        }
        else {
          $client_select = $client->select_personne_mysql($client_id, $connexion_lire);

          if($client_comparaison->get_prenom() === $client->get_prenom() &&
             $client_comparaison->get_nom() === $client->get_nom() &&
             $client_comparaison->get_adresse() === $client->get_adresse() &&
             $client_comparaison->get_telephone() === $client->get_telephone() &&
             $client_comparaison->get_courriel() === $client->get_courriel()) {

               $client->set_prenom("Louis");
               $client->set_nom("Tremblay");
               $client->set_adresse("999 Boul. Test, Québec, Qc, G2G 2G2");
               $client->set_telephone(4185555555);
               $client->set_courriel("louistremblay@google.com");
               $client_comparaison = $client;

               $client_update = $client->update_personne_mysql($connexion_ecrire);

               $client_select = $client->select_personne_mysql($client->get_id(), $connexion_lire);

               if($client_comparaison->get_prenom() === $client->get_prenom() &&
                  $client_comparaison->get_nom() === $client->get_nom() &&
                  $client_comparaison->get_adresse() === $client->get_adresse() &&
                  $client_comparaison->get_telephone() === $client->get_telephone() &&
                  $client_comparaison->get_courriel() === $client->get_courriel()) {

                  $client_effacer = $client->delete_personne_mysql($connexion_effacer);

                  if($client_effacer == 0) {
                    $message .= "Le test delete_personne_mysql à échoué\n";
                  }

                } else {
                  $message .= "Le test update_personne_mysql à échoué\n";
                }

             } else {
               $message .= "Le test select_personne_mysql à échoué\n";
             }
         }

        echo "Résultat des tests Client:\n";
        if($message == "") {
          echo "Tous les tests Client ont réussi.\n\n";
        }
        else {
          echo $message;
        }
    }
}
?>
