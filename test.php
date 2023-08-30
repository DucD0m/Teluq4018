<?php
require_once "Modele/Plan.php";
require_once "Controlleurs/ConnexionLireBD.php";

class ListePlans {

  private static $liste = array();

  public static function get_liste($connexion_lire)  {
    $sql = $connexion_lire->prepare("SELECT * FROM plans");
    $sql->execute();
    $resultats = $sql->fetchAll(PDO::FETCH_OBJ);
    self::$liste = $resultats;
    // foreach ($resultats as $resultat) {
    //   $plan = new Plan();
    //   $plan->set_id($resultat->id);
    //   $plan->set_nom($resultat->nom);
    //   $plan->set_duree($resultat->duree);
    //   $plan->set_prix($resultat->prix);
    //   $plan->set_acces_appareils($resultat->acces_appareils);
    //   $plan->set_acces_cours_groupe($resultat->acces_cours_groupe);
    //   $plan->set_prix_cours_groupe($resultat->prix_cours_groupe);
    //   array_push($liste, $plan);
    // }
    return self::$liste;
  }

}

$connexion_lire = ConnexionLireBD::connexion();
$plans = ListePlans::get_liste($connexion_lire);
var_dump($plans);
?>
