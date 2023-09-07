<?php
require_once "Notification.php";

class ListeNotifications {

  private static $liste = array();

  public static function get_liste($type, $connexion_lire) {

    $sql = $connexion_lire->prepare("SELECT * FROM notifications WHERE type = :type order by vu DESC, date_heure DESC");
    $sql->bindParam('type', $type, PDO::PARAM_INT);
    $sql->execute();
    $resultats = $sql->fetchAll(PDO::FETCH_OBJ);
    foreach ($resultats as $resultat) {
      $notification = new Notification();
      $notification->set_id($resultat->id);
      $notification->set_date_heure($resultat->date_heure);
      $notification->set_type($resultat->type);
      $notification->set_client($resultat->client);
      $notification->set_vu($resultat->vu);
      array_push(self::$liste, $notification);
    }

    return self::$liste;
  }

  public static function mise_a_jour_bd($connexion_ecrire, $connexion_effacer) {

    $date_heure = date("Y-m-d H:i:s");

    $sql = $connexion_ecrire->prepare("SELECT personne FROM clients WHERE fin_abonnement < CURDATE()");
    $sql->execute();
    $resultats = $sql->fetchAll();

    foreach ($resultats as $resultat) {

      $sql = $connexion_ecrire->prepare("SELECT id FROM notifications WHERE client = :client");
      $sql->bindParam('client', $resultat->personne, PDO::PARAM_INT);
      $sql->execute();
      $notifications = $sql->fetchAll(PDO::FETCH_OBJ);

      foreach ($notifications as $notification) {
        $n = new Notification();
        $n->select_mysql($notification->id, $connexion_effacer);
        $n->delete_mysql($n, $connexion_effacer);
      }

      $notification = new Notification();
      $notification->set_date_heure($date_heure);
      $notification->set_type(1);
      $notification->set_client($resultat->personne);
      $notification->insert_mysql($notification, $connexion_ecrire);
    }

    $sql = $connexion_ecrire->prepare("SELECT personne FROM clients WHERE fin_abonnement BETWEEN CURDATE() AND DATE_ADD(NOW(), INTERVAL +30 DAY)");
    $sql->execute();
    $resultats = $sql->fetchAll(PDO::FETCH_OBJ);

    //var_dump($resultats);exit;

    foreach ($resultats as $resultat) {

      //echo $resultat->personne."<br>";

      $sql = $connexion_ecrire->prepare("SELECT id FROM notifications WHERE client = :client");
      $sql->bindParam(':client', $resultat->personne, PDO::PARAM_INT);
      $sql->execute();
      $notifications = $sql->fetchAll(PDO::FETCH_OBJ);

      foreach ($notifications as $notification) {
        $n = new Notification();
        $n->select_mysql($notification->id, $connexion_effacer);
        $n->delete_mysql($n, $connexion_effacer);
      }

      $notification = new Notification();
      $notification->set_date_heure($date_heure);
      $notification->set_type(2);
      $notification->set_client($resultat->personne);
      $notification->insert_mysql($notification, $connexion_ecrire);
    }
  }
}
?>
