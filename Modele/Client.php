<?php declare(strict_types=1);
require_once "Personne.php";

class Client extends Personne implements Modele {

  protected $personne;
  protected $adhesion;
  protected $renouvellement;
  protected $fin_abonnement;
  protected $fin_acces_appareils;
  protected $heures_specialistes;
  protected $heures_specialistes_utilise;
  protected $cours_groupe_semaine;
  protected $plan;

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

  public function select_mysql(Int $id) {
    // Code here
    if($id > 0) echo gettype($id);
  }
  public function insert_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Client') echo get_class($obj);
    else echo 'wrong type';
  }
  public function update_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Client') echo get_class($obj);
    else echo 'wrong type';
  }
  public function delete_mysql(Object $obj) {
    // Code here
    if(get_class($obj) === 'Client') echo get_class($obj);
    else echo 'wrong type';
  }
}
$s = new Client();
//$s->select_mysql(123);
//$s->insert_mysql($s);
$tel = '(514)554-5761';
$tel = str_replace("(","",$tel);
$tel = str_replace(")","",$tel);
$tel = str_replace("-","",$tel);
$tel = str_replace(" ","",$tel);
$s->set_telephone((Int)$tel);
//Personne::insert_mysql($s);
echo $s->get_telephone();
?>
