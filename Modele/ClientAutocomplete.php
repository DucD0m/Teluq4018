<?php
//require_once __DIR__ . '/../../Configuration/config.php';
//require_once __DIR__ . "/../../Controlleurs/ConnexionLireBD.php";

//$connexion_lire = ConnexionLireBD::connexion();

//$choix_liste = array();
$choix_liste = array("Volvo", "BMW", "Toyota");

//$_GET["term"] = "Duc";

// $client = trim($_GET["term"]);
//
// if($client != ""){
//   $sql = $connexion_lire->prepare("SELECT id, prenom, nom, telephone FROM personnes WHERE prenom LIKE '%$client%' OR nom LIKE '%$client%' OR telephone LIKE '%$client%' ORDER BY prenom ASC");
// 	// $sql = $connexion_lire->prepare("SELECT id, prenom, nom, telephone FROM personnes WHERE prenom LIKE CONCAT('%',:prenom,'%') OR nom LIKE CONCAT('%',:nom,'%') OR telephone LIKE CONCAT('%',:tel,'%') ORDER BY prenom ASC");
//   // $sql->bindParam(':prenom', $client, PDO::PARAM_STR);
//   // $sql->bindParam(':nom', $client, PDO::PARAM_STR);
//   // $sql->bindParam(':tel', $client, PDO::PARAM_INT);
//   $sql->execute();
//   $resultats = $sql->fetchAll(PDO::FETCH_OBJ);
//
//   foreach ($resultats as $resultat) {
//     $choix = $resultat->id." - ".$resultat->prenom." ".$resultat->nom." - ".$resultat->telephone;
//     array_push($choix_liste, $choix);
//   }

	echo json_encode($choix_liste);
}
?>
