<?php
require_once "Personne.php";

class ClientTest {
    $client;
    $date = new DateTime('now');

    public function __constructor() {
        $connexion_lecteur = ConnexionLireBD::connexion();
        $client = new Client();

        $client->id = 0;
        $client->prenom = "Jean";
        $client->nom = "Smith";
        $client->adresse = "123 rue test, Montréal, Qc, J2J 1J1";
        $client->telephone = 5145555555;
        $client->courriel = "jeansmith@hotmail.com";

        $client->insert_personne_mysql($client);

        // $date->modify('+1 day');
        // $date->format('Y-m-d H:i:s');
        // $client->personne = 0;
        // $client->adhesion = "";
        // $client->renouvellement = "";
        // $client->fin_abonnement = "";
        // $client->fin_acces_appareils = "";
        // $client->heures_specialistes = 0;
        // $client->heures_specialistes_utilise = 0;
        // $client->cours_groupe_semaine = 0;
        // $client->plan = 0;
    }
}
?>
