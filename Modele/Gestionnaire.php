<?php declare(strict_types=1);
require_once "Personne.php";

class Gestionnaire extends Personne implements Modele {

  protected Int $personne = 0;
  protected String $mot_passe = "";

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
  public function get_mot_passe() : String {
    return $this->mot_passe;
  }
  public function set_mot_passe(String $mot_passe) {
    if(strlen($mot_passe) == 97) {
      $this->mot_passe = $mot_passe;
      return true;
    }
    else return false;
  }

  public function select_personne_mysql(Int $id, Object $connexion_lire) : Bool {
    if($id > 0) {

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
    else return false;
  }

  public function select_mysql(Int $id, Object $connexion_lire) : Object|Bool {
    if($id > 0) {
      $sql = $connexion_lire->prepare("SELECT * FROM personnes p JOIN gestionnaires g ON p.id = g.personne WHERE g.personne = :id");
      $sql->bindParam(':id', $id, PDO::PARAM_INT);
      $sql->execute();
      $gestionnaire = $sql->fetch(PDO::FETCH_OBJ);

      if($gestionnaire) {
        $validation = true;

        $validation = $this->set_id($gestionnaire->id);
        $validation = $this->set_prenom($gestionnaire->prenom);
        $validation = $this->set_nom($gestionnaire->nom);
        $validation = $this->set_adresse($gestionnaire->adresse);
        $validation = $this->set_telephone(intval($gestionnaire->telephone));
        $validation = $this->set_courriel($gestionnaire->courriel);
        $validation = $this->set_personne($gestionnaire->personne);
        $validation = $this->set_mot_passe($gestionnaire->mot_passe);

        return $validation;
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
  public function update_mysql(Object $connexion_ecrire) : Int|Bool {
    if($this->get_personne() > 0) {
      $sql = $connexion_ecrire->prepare("UPDATE gestionnaires SET
        mot_passe = :mot_passe
        WHERE personne = :personne");
      $sql->bindParam(':personne', $this->get_personne(), PDO::PARAM_INT);
      $sql->bindParam(':mot_passe', $this->get_mot_passe(), PDO::PARAM_STR);
      $resultat = $sql->execute();
      return $resultat;
    }
    else {
      return false;
    }
  }
  public function delete_mysql(Object $connexion_effacer) : Int|Bool {
    // Code ici lorsque requis...
  }
}
?>
