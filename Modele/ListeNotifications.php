<?php
require_once "Notification.php";

class ListeNotifications {

  private static $liste = array();

  public static function get_liste($type, $connexion_lire) {

    self::$liste = array();

    $sql = $connexion_lire->prepare("SELECT n.id AS notification, c.personne AS client, pl.id AS plan
      FROM notifications n
      JOIN clients c ON n.client = c.personne
      JOIN plans pl ON pl.id = c.plan
      WHERE n.type = :type
      ORDER BY n.vu DESC, n.date_heure DESC");

    $sql->bindParam('type', $type, PDO::PARAM_INT);
    $sql->execute();
    $resultats = $sql->fetchAll(PDO::FETCH_OBJ);
    foreach ($resultats as $resultat) {
      $notification = new Notification();
      $notification->select_mysql($resultat->notification, $connexion_lire);

      $client = new Client();
      $client->select_mysql($resultat->client, $connexion_lire);

      $plan = new Plan();
      $plan->select_mysql($resultat->plan, $connexion_lire);

      $item = array($notification, $client, $plan);

      array_push(self::$liste, $item);
    }

    return self::$liste;
  }

  public static function mise_a_jour_bd($connexion_lire, $connexion_ecrire) {

    $date_heure = date("Y-m-d H:i:s");

    $sql = $connexion_lire->prepare("SELECT personne FROM clients WHERE fin_abonnement < CURDATE()");
    $sql->execute();
    $resultats = $sql->fetchAll(PDO::FETCH_OBJ);

    foreach ($resultats as $resultat) {

      $sql = $connexion_lire->prepare("SELECT id FROM notifications WHERE client = :client");
      $sql->bindParam(':client', $resultat->personne, PDO::PARAM_INT);
      $sql->execute();
      $notifications = $sql->fetchAll(PDO::FETCH_OBJ);

      // S'il n'y a pas de notifications pour cette personne:
      if(!$notifications) {
        $notification = new Notification();
        $notification->set_date_heure($date_heure);
        $notification->set_type(1);
        $notification->set_client($resultat->personne);
        $notification->insert_mysql($notification, $connexion_ecrire);
      }

      // Sinon on vérifie s'il y a déjà des notifications existantes et on met à jour. En principe, il ne devrait y avoir qu'une seule
      // notification par compte client.
      else {
        foreach ($notifications as $notification) {
          $n = new Notification();
          $n->select_mysql($notification->id, $connexion_lire);
          $n_type = $n->get_type();
          if($n_type !== 1) {
            $n->set_date_heure($date_heure);
            $n->set_type(1);
            $n->update_mysql($n, $connexion_ecrire);
          }
        }
      }
    }

    $sql = $connexion_lire->prepare("SELECT personne FROM clients WHERE fin_abonnement BETWEEN CURDATE() AND DATE_ADD(NOW(), INTERVAL +29 DAY)");
    $sql->execute();
    $resultats = $sql->fetchAll(PDO::FETCH_OBJ);

    foreach ($resultats as $resultat) {

      $sql = $connexion_lire->prepare("SELECT id FROM notifications WHERE client = :client");
      $sql->bindParam(':client', $resultat->personne, PDO::PARAM_INT);
      $sql->execute();
      $notifications = $sql->fetchAll(PDO::FETCH_OBJ);

      // S'il n'y a pas de notifications pour cette personne:
      if(!$notifications) {
        $notification = new Notification();
        $notification->set_date_heure($date_heure);
        $notification->set_type(2);
        $notification->set_client($resultat->personne);
        $notification->insert_mysql($notification, $connexion_ecrire);
      }

      // Sinon on vérifie s'il y a déjà des notifications existantes et on met à jour. En principe, il ne devrait y avoir qu'une seule
      // notification par compte client.
      else {
        foreach ($notifications as $notification) {
          $n = new Notification();
          $n->select_mysql($notification->id, $connexion_lire);
          $n_type = $n->get_type();
          if($n_type !== 2) {
            $n->set_date_heure($date_heure);
            $n->set_type(2);
            $n->update_mysql($n, $connexion_ecrire);
          }
        }
      }
    }
  }
}
?>
