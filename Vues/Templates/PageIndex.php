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

        <div class="titre">
          SYSTÈME DE GESTION
        </div>

        <form action="<?php echo URL; ?>" method="post">
          <input class="auth auth-courriel" type="text" id="auth-email" name="auth-courriel" placeholder="courriel">
          <input class="auth auth-mdp" type="password" id="auth-mdp" name="auth-mdp" placeholder="mot de passe">
          <input id="auth-soumettre" class="auth auth-submit couleurs" type="submit" value="OUVRIR UNE SESSION">
        </form>

    </body>

    </html>

<?php
  }
}
?>
