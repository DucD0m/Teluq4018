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
    if($personne > 0) {
      $this->personne = $personne;
      return true;
    }
    else return false;
  }
  public function get_adhesion() : String {
    return $this->adhesion;
  }
  public function set_adhesion(String $adhesion) {
    if(date_format($adhesion,"Y-m-d")) {
      $this->adhesion = date_format($adhesion,"Y-m-d");
      return true;
    }
    else return false;
  }
  public function get_renouvellement() : String {
    return $this->renouvellement;
  }
  public function set_renouvellement(String $renouvellement) {
    if(date_format($renouvellement,"Y-m-d")) {
      $this->renouvellement = date_format($renouvellement,"Y-m-d");
      return true;
    }
    else return false;
  }
  public function get_fin_abonnement() : String {
    return $this->fin_abonnement;
  }
  public function set_fin_abonnement(String $fin_abonnement) {
    if(date_format($fin_abonnement,"Y-m-d")) {
      $this->fin_abonnement = date_format($fin_abonnement,"Y-m-d");
      return true;
    }
    else return false;
  }
  public function get_fin_acces_appareils() : String {
    return $this->fin_acces_appareils;
  }
  public function set_fin_acces_appareils(String $fin_acces_appareils) {
    if(date_format($fin_acces_appareils,"Y-m-d")) {
      $this->fin_acces_appareils = date_format($fin_acces_appareils,"Y-m-d");
      return true;
    }
    else return false;
  }
  public function get_heures_specialistes() : Int {
    return $this->heures_specialistes;
  }
  public function set_heures_specialistes(Int $heures_specialistes) {
    if($heures_specialistes >= 0 && $heures_specialistes <= 65535) {
      $this->heures_specialistes = $heures_specialistes;
      return true;
    }
    else return false;
  }
  public function get_heures_specialistes_utilise() : Int {
    return $this->heures_specialistes_utilise;
  }
  public function set_heures_specialistes_utilise(Int $heures_specialistes_utilise) {
    if($heures_specialistes_utilise >= 0 && $heures_specialistes_utilise <= 65535) {
      $this->heures_specialistes_utilise = $heures_specialistes_utilise;
      return true;
    }
    else return false;
  }
  public function get_cours_groupe_semaine() : Int {
    return $this->cours_groupe_semaine;
  }
  public function set_cours_groupe_semaine(Int $cours_groupe_semaine) {
    if($cours_groupe_semaine >=0 && $cours_groupe_semaine <=255) {
      $this->cours_groupe_semaine = $cours_groupe_semaine;
      return true;
    }
    else return false;
  }
  public function get_plan() : Int {
    return $this->plan;
  }
  public function set_plan(Int $plan) {
    if($plan > 0) {
      $this->plan = $plan;
      return true;
    }
    else return false;
  }

  public function select_personne_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    $resultat = parent::select_mysql($id, $connexion_lire);

    if($resultat) {
      $validation = true;
      $validation = $this->set_id($resultat->id);
      $validation = $this->set_prenom($resultat->prenom);
      $validation = $this->set_nom($resultat->nom);
      $validation = $this->set_adresse($resultat->adresse);
      $validation = $this->set_telephone($resultat->telephone);
      $validation = $this->set_courriel($resultat->courriel);
      return $validation;
    }
    else return false;
  }
  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT * FROM personnes p JOIN clients c ON p.id = c.personne WHERE c.personne = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $client = $sql->fetch(PDO::FETCH_OBJ);

      if($client) {
        $validation = true;
        
        $validation = $this->set_id($client->id);
        $validation = $this->set_prenom($client->prenom);
        $validation = $this->set_nom($client->nom);
        $validation = $this->set_adresse($client->adresse);
        $validation = $this->set_telephone(intval($client->telephone));
        $validation = $this->set_courriel($client->courriel);
        $validation = $this->set_personne($client->personne);
        $validation = $this->set_adhesion($client->adhesion);
        $validation = $this->set_renouvellement($client->renouvellement);
        $validation = $this->set_fin_abonnement($client->fin_abonnement);
        $validation = $this->set_fin_acces_appareils($client->fin_acces_appareils);
        $validation = $this->set_heures_specialistes($client->heures_specialistes);
        $validation = $this->set_heures_specialistes_utilise($client->heures_specialistes_utilise);
        $validation = $this->set_cours_groupe_semaine($client->cours_groupe_semaine);
        $validation = $this->set_plan($client->plan);

        return $validation;
      }
      else return false;
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
    if(get_class($obj) === 'Client' && $obj->get_personne() > 0) {
      $sql = $connexion_ecrire->prepare("UPDATE clients SET
        renouvellement = :renouvellement,
        fin_abonnement = :fin_abonnement,
        fin_acces_appareils = :fin_acces_appareils,
        heures_specialistes = :heures_specialistes,
        heures_specialistes_utilise = :heures_specialistes_utilise,
        cours_groupe_semaine = :cours_groupe_semaine,
        plan = :plan
        WHERE personne = :personne");
      $sql->bindParam(':personne', $obj->get_personne(), PDO::PARAM_INT);
      $sql->bindParam(':renouvellement', $obj->get_renouvellement(), PDO::PARAM_STR);
      $sql->bindParam(':fin_abonnement', $obj->get_fin_abonnement(), PDO::PARAM_STR);
      $sql->bindParam(':fin_acces_appareils', $obj->get_fin_acces_appareils(), PDO::PARAM_STR);
      $sql->bindParam(':heures_specialistes', $obj->get_heures_specialistes(), PDO::PARAM_INT);
      $sql->bindParam(':heures_specialistes_utilise', $obj->get_heures_specialistes_utilise(), PDO::PARAM_INT);
      $sql->bindParam(':cours_groupe_semaine', $obj->get_cours_groupe_semaine(), PDO::PARAM_INT);
      $sql->bindParam(':plan', $obj->get_plan(), PDO::PARAM_INT);
      $resultat = $sql->execute();
      return $resultat;
    }
    else {
      return false;
    }
  }
  public function delete_personne_mysql(Object $obj, Object $connexion_effacer) : Int|Bool {
    // La clé étrangère est configuré "ON DELETE CASCADE". En effaçant la personne, on efface automatiquement le client.
    $resultat = parent::delete_mysql($obj, $connexion_effacer);
    return $resultat;
  }
  public function delete_mysql(Object $obj, Object $connexion_effacer) : Int|Bool {
    // Code lorsque requis...
  }
}
?>
