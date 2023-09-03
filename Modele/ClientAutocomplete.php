<?php
require_once __DIR__ . '/../Configuration/config.php';
//require_once __DIR__ . "/../Controlleurs/ConnexionLireBD.php";

//$connexion_lire = ConnexionLireBD::connexion();

$serveur = SERVERNAME;
$lecteur = LECTEUR;
$mdp_lecteur = MDPLECTEUR;
$base_donnees = BASEDONNEES;

try {
  $connexion_lire = new PDO("mysql:host=$serveur;dbname=$base_donnees", $lecteur, $mdp_lecteur);
  $connexion_lire->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  //die("Connection failed: " . $e->getMessage());
  die("Impossible de se connecter en ce moment. Veuillez essayer plus tard.(1)");
}

$choix_liste = array();
//$choix_liste = array();
//array_push($choix_liste,$_GET['term']);

//$_GET["term"] = "Duc";

$client = trim($_GET["term"]);

if($client != ""){
  $sql = $connexion_lire->prepare("SELECT id, prenom, nom, telephone FROM personnes WHERE prenom LIKE '%$client%' OR nom LIKE '%$client%' OR telephone LIKE '%$client%' ORDER BY prenom ASC");
	// $sql = $connexion_lire->prepare("SELECT id, prenom, nom, telephone FROM personnes WHERE prenom LIKE CONCAT('%',:prenom,'%') OR nom LIKE CONCAT('%',:nom,'%') OR telephone LIKE CONCAT('%',:tel,'%') ORDER BY prenom ASC");
  // $sql->bindParam(':prenom', $client, PDO::PARAM_STR);
  // $sql->bindParam(':nom', $client, PDO::PARAM_STR);
  // $sql->bindParam(':tel', $client, PDO::PARAM_INT);
  $sql->execute();
  $resultats = $sql->fetchAll(PDO::FETCH_OBJ);

  foreach ($resultats as $resultat) {
    $choix = $resultat->id." - ".$resultat->prenom." ".$resultat->nom." - ".$resultat->telephone;
    array_push($choix_liste, $choix);
  }

	echo json_encode($choix_liste);
}
?>
