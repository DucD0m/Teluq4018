<?php
class NotificationUtilitaires {

  private $liste = array();

  public function getListe($type) {
    $sql = $lecteur->prepare("SELECT * FROM notifications WHERE type = :type order by vu DESC, date_heure DESC");
    $sql->bindParam('type', $type, PDO::PARAM_INT);
    $sql->execute();
    $resultat = $sql->fetchAll();
    $this->liste = $resultat;
    return $this->liste;
  }

  public function genererNotifications() {
    $sql = $lecteur->prepare("SELECT personne FROM clients WHERE fin_abonnement > CURDATE()");
    $sql->execute();
    $resultat = $sql->fetchAll();

    foreach ($resultat as $r) {
      $sql = $lecteur->prepare("INSERT INTO notifications(type,client) VALUES (1, :client)");
      $sql->bindParam('client', $r, PDO::PARAM_INT);
      $sql->execute();
    }

    $sql = $lecteur->prepare("SELECT personne FROM clients WHERE fin_abonnement BETWEEN DATE_ADD(NOW(), INTERVAL -30 DAY) AND CURDATE()");
    $sql->execute();
    $resultat = $sql->fetchAll();

    foreach ($resultat as $r) {
      $sql = $lecteur->prepare("INSERT INTO notifications(type,client) VALUES (2, :client)");
      $sql->bindParam('client', $r, PDO::PARAM_INT);
      $sql->execute();
    }
  }

  public function marquerVu($id) {
    $sql = $lecteur->prepare("UPDATE notifications SET vu = 1 WHERE id = :id");
    $sql->bindParam('id', $id, PDO::PARAM_INT);
    $sql->execute();
    return $sql;
  }

}
?>
