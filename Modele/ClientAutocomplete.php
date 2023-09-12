<?php
require_once __DIR__ . '/../Configuration/config.php';
require_once __DIR__ . "/../Controlleurs/ConnexionLireBD.php";

$connexion_lire = ConnexionLireBD::connexion();

$choix_liste = array();

$client = trim($_GET["term"]);

if(isset($_GET["rdv_specialiste"]) && $_GET["rdv_specialiste"] == 'oui') {
  $and_where = " AND c.heures_specialistes_utilise <= c.heures_specialistes ";
}
else $and_where = "";

if($client != ""){
	$sql = $connexion_lire->prepare("SELECT id, prenom, nom, telephone FROM personnes p JOIN clients c ON p.id = c.personne WHERE (prenom LIKE CONCAT(:prenom,'%') OR nom LIKE CONCAT(:nom,'%') OR telephone LIKE CONCAT(:tel,'%')) $and_where ORDER BY prenom ASC");
  $sql->bindParam(':prenom', $client, PDO::PARAM_STR);
  $sql->bindParam(':nom', $client, PDO::PARAM_STR);
  $sql->bindParam(':tel', $client, PDO::PARAM_INT);
  $sql->execute();
  $resultats = $sql->fetchAll(PDO::FETCH_OBJ);

  foreach ($resultats as $resultat) {
    $telephone = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $resultat->telephone);
    $choix = $resultat->id." - ".$resultat->prenom." ".$resultat->nom." ".$telephone;
    array_push($choix_liste, $choix);
  }

	echo json_encode($choix_liste);
}
?>
