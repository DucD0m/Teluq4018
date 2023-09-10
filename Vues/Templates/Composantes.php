<!-- Patron de conception composite-->
<?php

class Composantes {

  public static function get_head() { ?>

      <title>Gym Argenté</title>

      <meta charset="UTF-8">

      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/cupertino/jquery-ui.css">
      <link rel="stylesheet" href="Vues/css/global.css?v=15">

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

      <script src="Vues/javascript/global.js"></script>

<?php }

  public static function get_logo() { ?>

      <div class='couleurs logo'>
        GY<i class="fa-solid fa-dumbbell"></i><br>
        ARGENTÉ
      </div>

<?php }

  public static function get_message() { ?>

    <?php if(isset($_SESSION['message']) && ($_SESSION['message'] != '')): ?>
      <script>
      $( document ).ready(function() {
        alert("<?php echo $_SESSION['message']; ?>");
      });
      </script>
    <?php unset($_SESSION['message']); endif; ?>

<?php }

  public static function get_bouton_quitter() { ?>

    <form id="quitter-form" class="hidden" action="<?php echo URL; ?>" method="post">
      <input type="hidden" id="quitter-input" name="quitter" value="oui">
      <button id="quitter" class="couleurs quitter" type="submit">
        QUITTER <i class="fa-solid fa-person-running"></i>
      </button>
    </form>

<?php }

  public static function get_bouton_retour() { ?>

    <form id="retour-form" class="hidden" action="<?php echo URL; ?>" method="post">
      <input type="hidden" id="retour-input" name="retour" value="oui">
      <button id="retour-menu" class="couleurs retour" type="submit">
        <i class="fa-solid fa-backward"></i> MENU<br>
      </button>
    </form>

<?php }

} ?>
