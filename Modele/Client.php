<?php declare(strict_types=1);
require_once "Personne.php";

class Client extends Personne implements Modele {

  protected Int $personne = 0;
  protected String $adhesion = "0000-00-00";
  protected String $renouvellement = "";
  protected String $fin_abonnement = "0000-00-00";
  protected String $fin_acces_appareils = "0000-00-00";
  protected Int $heures_specialistes = 0;
  protected Int $heures_specialistes_utilise = 0;
  protected Int $cours_groupe_semaine = 0;
  protected Int $plan = 0;

  public function get_personne() : Int {
    return $this->personne;
  }
  public function set_personne(Int $personne) {
    $this->personne = $personne;
  }
  public function get_adhesion() : String {
    return $this->adhesion;
  }
  public function set_adhesion(String $adhesion) {
    $this->adhesion = $adhesion;
  }
  public function get_renouvellement() : String {
    return $this->renouvellement;
  }
  public function set_renouvellement(String $renouvellement) {
    $this->renouvellement = $renouvellement;
  }
  public function get_fin_abonnement() : String {
    return $this->fin_abonnement;
  }
  public function set_fin_abonnement(String $fin_abonnement) {
    $this->fin_abonnement = $fin_abonnement;
  }
  public function get_fin_acces_appareils() : String {
    return $this->fin_acces_appareils;
  }
  public function set_fin_acces_appareils(String $fin_acces_appareils) {
    $this->fin_acces_appareils = $fin_acces_appareils;
  }
  public function get_heures_specialistes() : Int {
    return $this->heures_specialistes;
  }
  public function set_heures_specialistes(Int $heures_specialistes) {
    $this->heures_specialistes = $heures_specialistes;
  }
  public function get_heures_specialistes_utilise() : Int {
    return $this->heures_specialistes_utilise;
  }
  public function set_heures_specialistes_utilise(Int $heures_specialistes_utilise) {
    $this->heures_specialistes_utilise = $heures_specialistes_utilise;
  }
  public function get_cours_groupe_semaine() : Int {
    return $this->cours_groupe_semaine;
  }
  public function set_cours_groupe_semaine(Int $cours_groupe_semaine) {
    $this->cours_groupe_semaine = $cours_groupe_semaine;
  }
  public function get_plan() : Int {
    return $this->plan;
  }
  public function set_plan(Int $plan) {
    $this->plan = $plan;
  }

  public function select_personne_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    $resultat = parent::select_mysql($id, $connexion_lire);
    $this->set_id($resultat->id);
    $this->set_prenom($resultat->prenom);
    $this->set_nom($resultat->nom);
    $this->set_adresse($resultat->adresse);
    $this->set_telephone($resultat->telephone);
    $this->set_courriel($resultat->courriel);
    return true;
  }
  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT * FROM personnes p JOIN clients c ON p.id = c.personne WHERE c.personne = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $client = $sql->fetch(PDO::FETCH_OBJ);

      $this->set_prenom($client->prenom);
      $this->set_nom($client->nom);
      $this->set_adresse($client->adresse);
      $this->set_telephone(intval($client->telephone));
      $this->set_courriel($client->courriel);
      $this->set_personne($client->personne);
      $this->set_adhesion($client->adhesion);
      $this->set_renouvellement($client->renouvellement);
      $this->set_fin_abonnement($client->fin_abonnement);
      $this->set_fin_acces_appareils($client->fin_acces_appareils);
      $this->set_heures_specialistes($client->heures_specialistes);
      $this->set_heures_specialistes_utilise($client->heures_specialistes_utilise);
      $this->set_cours_groupe_semaine($client->cours_groupe_semaine);
      $this->set_plan($client->plan);
      return true;
    }
    else {
      return false;
    }
  }
  public function insert_personne_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    $resultat = parent::insert_mysql($obj, $connexion_ecrire);
    return $resultat;
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    if(get_class($obj) === 'Client') {
      $personne = parent::insert_mysql($obj, $connexion_ecrire);
      $sql = $connexion_ecrire->prepare("INSERT INTO clients (
        personne, adhesion, renouvellement, fin_abonnement, fin_acces_appareils,
        heures_specialistes, heures_specialistes_utilise, cours_groupe_semaine, plan)
        VALUES (:personne, :adhesion, :renouvellement, :fin_abonnement, :fin_acces_appareils,
        :heures_specialistes, :heures_specialistes_utilise, :cours_groupe_semaine, :plan)");
      $sql->bindParam(':personne', $personne, PDO::PARAM_INT);
      $sql->bindParam(':adhesion', $obj->get_adhesion(), PDO::PARAM_STR);
      $sql->bindParam(':renouvellement', $obj->get_renouvellement(), PDO::PARAM_STR);
      $sql->bindParam(':fin_abonnement', $obj->get_fin_abonnement(), PDO::PARAM_STR);
      $sql->bindParam(':fin_acces_appareils', $obj->get_fin_acces_appareils(), PDO::PARAM_STR);
      $sql->bindParam(':heures_specialistes', $obj->get_heures_specialistes(), PDO::PARAM_INT);
      $sql->bindParam(':heures_specialistes_utilise', $obj->get_heures_specialistes_utilise(), PDO::PARAM_INT);
      $sql->bindParam(':cours_groupe_semaine', $obj->get_cours_groupe_semaine(), PDO::PARAM_INT);
      $sql->bindParam(':plan', $obj->get_plan(), PDO::PARAM_INT);
      $sql->execute();
      return (Int)$personne;
    }
    else {
      return false;
    }
  }
  public function update_personne_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    $resultat = parent::update_mysql($obj, $connexion_ecrire);
    return $resultat;
  }
  public function update_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code here
    if(get_class($obj) === 'Client') echo get_class($obj);
    else echo 'wrong type';
  }
  public function delete_personne_mysql(Object $obj, Object $connexion_effacer) : Int|Bool {
    $resultat = parent::delete_mysql($obj, $connexion_effacer);
    return $resultat;
  }
  public function delete_mysql(Object $obj, Object $connexion_effacer) : Int|Bool {
    // Code here
    if(get_class($obj) === 'Client') echo get_class($obj);
    else echo 'wrong type';
  }
}
?>
