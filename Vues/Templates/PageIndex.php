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
          CHANGER LE<br>
          MOT DE PASSE
        </button>

        <button id="annuler-mdp" class="couleurs quitter">
          ANNULER LE<br>
          CHANGEMENT
        </button>

        <div class="titre">
          SYSTÈME DE GESTION
        </div>

        <form action="<?php echo URL; ?>" method="post">
          <input class="auth auth-courriel" type="text" id="auth-email" name="auth-courriel" placeholder="courriel">
          <input class="auth auth-mdp" type="password" id="auth-mdp" name="auth-mdp" placeholder="mot de passe">
          <input class="auth auth-mdp-changer" type="password" id="auth-mdp-changer" name="auth-mdp-changer" placeholder="nouveau mot de passe" disabled>
          <input class="auth auth-mdp-confirmer" type="password" id="auth-mdp-confirmer" name="auth-mdp-confirmer" placeholder="confirmer le nouveau mot de passe" disabled>
          <input id="auth-soumettre" class="auth auth-submit couleurs" type="submit" value="OUVRIR UNE SESSION">
        </form>

        <script>
            $( document ).ready(function() {
              $( "#changer-mdp" ).click(function(){
                $('#changer-mdp').css('display','none');
                $('#annuler-mdp').css('display','inline-block');
                $('#auth-mdp-changer').css('display','inline-block');
                $('#auth-mdp-confirmer').css('display','inline-block');
                $('#auth-mdp-changer').removeAttr('disabled');
                $('#auth-mdp-confirmer').removeAttr('disabled');
                $('#auth-soumettre').css('top','45vw');
                $('#auth-soumettre').val('CHANGER LE MOT DE PASSE');
              });

              $( "#annuler-mdp" ).click(function(){
                $('#annuler-mdp').css('display','none');
                $('#changer-mdp').css('display','inline-block');
                $('#auth-mdp-changer').css('display','none');
                $('#auth-mdp-confirmer').css('display','none');
                $('#auth-mdp-changer').prop('disabled','true');
                $('#auth-mdp-confirmer').prop('disabled','true');
                $('#auth-soumettre').css('top','30vw');
                $('#auth-soumettre').val('OUVRIR UNE SESSION');
              });
            });
        </script>

    </body>

    </html>

<?php
  }
}
?>
