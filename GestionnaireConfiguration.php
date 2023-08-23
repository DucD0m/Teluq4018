<?php
//$_SESSION['auth'] = 'gestionnaire';
//$_SESSION = array();
if($_SESSION['auth'] !== 'gestionnaire') die("Vous n'avez pas accès à cette ressource\n");
else {
  class GestionnaireConfiguration {

    private $pepper = "c1isvFdxMDdmjOlvxpecFw";

    public function getPepper() {
      return $this->pepper;
    }
  }
}
?>
