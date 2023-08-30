<?php
require_once "Plan.php";

class ListePlans {

  private static $liste = array();

  public static function get_liste($connexion_lire)  {
    $sql = $connexion_lire->prepare("SELECT * FROM plans");
    $sql->execute();
    $resultats = $sql->fetchAll(PDO::FETCH_OBJ);
    foreach ($resultats as $resultat) {
      $plan = new Plan();
      $plan->set_id($resultat->id);
      $plan->set_nom($resultat->nom);
      $plan->set_duree($resultat->duree);
      $plan->set_prix($resultat->prix);
      $plan->set_acces_appareils($resultat->acces_appareils);
      $plan->set_acces_cours_groupe($resultat->acces_cours_groupe);
      $plan->set_prix_cours_groupe($resultat->prix_cours_groupe);
      array_push(self::$liste, $plan);
    }
    return self::$liste;
  }

}
?>
