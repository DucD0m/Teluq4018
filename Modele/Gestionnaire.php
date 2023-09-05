<?php declare(strict_types=1);
require_once "Personne.php";

class Gestionnaire extends Personne implements Modele {

  protected Int $personne = 0;
  protected String $mot_passe = "";

  public function get_personne() : Int {
    return $this->personne;
  }
  public function set_personne(Int $personne) {
    $this->personne = $personne;
  }
  public function get_mot_passe() : String {
    return $this->mot_passe;
  }
  public function set_mot_passe(String $mot_passe) {
    $this->mot_passe = $mot_passe;
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
    // Code ici lorsque requis...
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code ici lorsque requis...
  }
  public function update_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code ici lorsque requis...
  }
  public function delete_mysql(Object $obj, Object $connexion_effacer) : Int|Bool {
    // Code ici lorsque requis...
  }
}
?>
