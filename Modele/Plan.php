<?php declare(strict_types=1);
require_once "Modele.php";

class Plan implements Modele {

  private Int $id = 0;
  private String $nom = "";
  private Int $duree = 0;
  private Float $prix = 0.00;
  private Int $acces_appareils = 0;
  private Int $acces_cours_groupe = 0;
  private Float $prix_cours_groupe = 0.00;

  public function get_id() : Int {
    return $this->id;
  }
  public function set_id(Int $id) {
    $this->id = $id;
  }
  public function get_nom() : String {
    return $this->nom;
  }
  public function set_nom(String $nom) {
    $this->nom = $nom;
  }
  public function get_duree() : Int {
    return $this->duree;
  }
  public function set_duree(Int $duree) {
    $this->duree = $duree;
  }
  public function get_prix() : Float{
    return $this->prix;
  }
  public function set_prix(Float $prix) {
    $this->prix = $prix;
  }
  public function get_acces_appareils() : Int {
    return $this->acces_appareils;
  }
  public function set_acces_appareils(Int $acces_appareils) {
    $this->acces_appareils = $acces_appareils;
  }
  public function get_acces_cours_groupe() : Int {
    return $this->acces_cours_groupe;
  }
  public function set_acces_cours_groupe(Int $acces_cours_groupe) {
    $this->acces_cours_groupe = $acces_cours_groupe;
  }
  public function get_prix_cours_groupe() : Float {
    return $this->prix_cours_groupe;
  }
  public function set_prix_cours_groupe(Float $prix_cours_groupe) {
    $this->prix_cours_groupe = $prix_cours_groupe;
  }

  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT * FROM plans WHERE id = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $plan = $sql->fetch(PDO::FETCH_OBJ);

      if($plan) {
        $this->set_id($plan->id);
        $this->set_nom($plan->nom);
        $this->set_duree($plan->duree);
        $this->set_prix(floatval($plan->prix));
        $this->set_acces_appareils($plan->acces_appareils);
        $this->set_acces_cours_groupe($plan->acces_cours_groupe);
        $this->set_prix_cours_groupe(floatval($plan->prix_cours_groupe));
        return true;
      }
      else return false;
    }
    else {
      return false;
    }
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code lorsque requis...
  }
  public function update_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    if(get_class($obj) === 'Plan') {

      $plan_id = $obj->get_id();
      $plan_prix = $obj->get_prix();
      $plan_prix_cours_groupe = $obj->get_prix_cours_groupe();

      $sql = $connexion_ecrire->prepare("UPDATE plans SET prix = :prix, prix_cours_groupe = :prix_cours_groupe WHERE id = :id");
      $sql->bindParam(':id', $plan_id, PDO::PARAM_INT);
      $sql->bindParam(':prix', $plan_prix, PDO::PARAM_STR);
      $sql->bindParam(':prix_cours_groupe', $plan_prix_cours_groupe, PDO::PARAM_STR);
      $resultat = $sql->execute();
      return $resultat;
    }
    else {
      return false;
    }
  }
  public function delete_mysql(Object $obj, Object $connexion_effacer) :Int|Bool {
    // Code lorsque requis...
  }
}
?>
