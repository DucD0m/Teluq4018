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
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT * FROM personnes p JOIN gestionnaires g ON p.id = g.personne WHERE g.personne = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $gestionnaire = $sql->fetch(PDO::FETCH_OBJ);

      if($gestionnaire) {
        $this->set_id($gestionnaire->id);
        $this->set_prenom($gestionnaire->prenom);
        $this->set_nom($gestionnaire->nom);
        $this->set_adresse($gestionnaire->adresse);
        $this->set_telephone(intval($gestionnaire->telephone));
        $this->set_courriel($gestionnaire->courriel);
        $this->set_personne($gestionnaire->personne);
        $this->set_mot_passe($gestionnaire->mot_passe);

        return true;
      }
      else return false;
    }
    else {
      return false;
    }
  }
  public function insert_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    // Code ici lorsque requis...
  }
  public function update_mysql(Object $obj, Object $connexion_ecrire) : Int|Bool {
    if(get_class($obj) === 'Gestionnaire' && $obj->get_personne() > 0) {
      $sql = $connexion_ecrire->prepare("UPDATE gestionnaires SET
        mot_passe = :mot_passe
        WHERE personne = :personne");
      $sql->bindParam(':personne', $obj->get_personne(), PDO::PARAM_INT);
      $sql->bindParam(':mot_passe', $obj->get_mot_passe(), PDO::PARAM_STR);
      $resultat = $sql->execute();
      return $resultat;
    }
    else {
      return false;
    }
  }
  public function delete_mysql(Object $obj, Object $connexion_effacer) : Int|Bool {
    // Code ici lorsque requis...
  }
}
?>
