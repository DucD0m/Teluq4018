<?php declare(strict_types=1);

class PageIndex {

  public function __construct() {

?>

    <!DOCTYPE HTML>
    <html lang='fr'>

    <?php
      require_once "head.html";
    ?>

    <!-- <head>
      <title>Gym Argenté</title>

      <meta charset="UTF-8">

      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/cupertino/jquery-ui.css">
      <link rel="stylesheet" href="Vues/css/global.css">

      <script
        src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
        crossorigin="anonymous">
      </script>

      <script
        src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
        crossorigin="anonymous">
      </script>

      <script src="https://kit.fontawesome.com/4d2a9d3318.js" crossorigin="anonymous"></script>
    </head> -->

    <body>
        <div class='couleurs logo'>
          GY<i class="fa-solid fa-dumbbell"></i><br>
          ARGENTÉ
        </div>

        <div class="titre">
          SYSTÈME DE GESTION
        </div>

        <form action="<?php echo URL; ?>" method="post">
          <input class="auth auth-courriel" type="text" id="auth-email" name="auth-courriel" placeholder="courriel">
          <input class="auth auth-mdp" type="password" id="auth-mdp" name="auth-mdp" placeholder="mot de passe">
          <input id="auth-soumettre" class="auth auth-submit couleurs" type="submit" value="OUVRIR UNE SESSION">
        </form>

        <script>
          // $( document ).ready(function() {
          //   $('#auth-soumettre').click(function(){
          //     if($('#auth-mdp').val() === "gestionnaire") location.href = "file:///Users/dominiqueducas/Desktop/Gym_Argente/Vue/templates/gestionnaire.html";
          //     else if($('#auth-mdp').val() === "specialiste") location.href = "file:///Users/dominiqueducas/Desktop/Gym_Argente/Vue/templates/specialiste.html";
          //     else alert("Svp vérifier vos informations d'identification");
          //   });
          // });
        </script>

    </body>
    </html>

<?php
  }
}
?>
