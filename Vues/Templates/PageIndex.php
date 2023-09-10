<?php declare(strict_types=1);

class PageIndex {

  public function __construct() {

?>

    <!DOCTYPE HTML>
    <html lang='fr'>

    <head>
      <?php
        require "Composantes/head.html";
      ?>
    </head>

    <body>

        <?php
          require "Composantes/message.php";
        ?>

        <?php
          require "Composantes/logo.html";
        ?>

        <button id="changer-mdp" class="couleurs quitter">
          CHANGER<br>
          MOT DE PASSE
        </button>

        <div class="titre">
          SYSTÈME DE GESTION
        </div>

        <form action="<?php echo URL; ?>" method="post">
          <input class="auth auth-courriel" type="text" id="auth-email" name="auth-courriel" placeholder="courriel">
          <input class="auth auth-mdp" type="password" id="auth-mdp" name="auth-mdp" placeholder="mot de passe">
          <input class="auth auth-mdp-changer" type="password" id="auth-mdp-changer" name="auth-mdp-changer" placeholder="nouveau mot de passe" disabled>
          <input class="auth auth-mdp-confirmer" type="password" id="auth-mdp-confirmer" name="auth-mdp-confirmer" placeholder="confirmer nouveau mot de passe" disabled>
          <input id="auth-soumettre" class="auth auth-submit couleurs" type="submit" value="OUVRIR UNE SESSION">
        </form>

        <script>
            $( "#changer-mdp" ).click(function(){
              $('#auth-mdp-changer').css('display','inline-block');
              $('#auth-mdp-confirmer').css('display','inline-block');
              $('#auth-mdp-changer').removeAttr('disabled');
              $('#auth-mdp-confirmer').removeAttr('disabled');
              $('#auth-soumettre').css('top','45vw');
            });
        </script>

    </body>

    </html>

<?php
  }
}
?>
