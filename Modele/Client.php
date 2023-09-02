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
      // MySQL here
      $this->set_personne(1);
      $this->set_adhesion("2023...");
      $this->set_renouvellement("2023...");
      $this->set_fin_abonnement("2023...");
      $this->set_fin_acces_appareils("2023...");
      $this->set_heures_specialistes(10);
      $this->set_heures_specialistes_utilise(0);
      $this->set_cours_groupe_semaine(1);
      $this->set_plan(1);
    }
  }
  public function insert_personne_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    $resultat = parent::insert_mysql($obj, $connexion_ecrire);
    return $resultat;
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code here
    if(get_class($obj) === 'Client') echo get_class($obj);
    else echo 'wrong type';
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
