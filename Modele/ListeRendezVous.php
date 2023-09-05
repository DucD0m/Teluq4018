<?php
require_once "RendezVous.php";

class ListeRendezVous {

  private static $liste = array();

  public static function get_liste(Object $obj, $connexion_lire)  {

    if((get_class($obj) === 'Client' || get_class($obj) === 'Specialiste') && $obj->get_id() > 0) {

      if(get_class($obj) === 'Client') {
        $sql = $connexion_lire->prepare("SELECT * FROM rendez_vous WHERE client = :client");
        $sql->bindParam(':client', $obj->get_id(), PDO::PARAM_INT);
      }
      else if(get_class($obj) === 'Specialiste') {
        $sql = $connexion_lire->prepare("SELECT * FROM rendez_vous WHERE specialiste = :specialiste");
        $sql->bindParam(':specialiste', $obj->get_specialiste_id(), PDO::PARAM_INT);
      }

      $sql->execute();
      $resultats = $sql->fetchAll(PDO::FETCH_OBJ);

      foreach ($resultats as $resultat) {
        $rdv = new RendezVous();
        $rdv->set_date_heure($resultat->date_heure);
        $rdv->set_client($resultat->client);
        $rdv->set_specialiste($resultat->specialiste);
        array_push(self::$liste, $rdv);
      }

      return self::$liste;
    }

    else return false;

  }

}
?>
