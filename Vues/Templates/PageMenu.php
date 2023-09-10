<?php declare(strict_types=1);

class PageMenu {

  public function __construct(Gestionnaire $obj, $nb_expires, $nb_30jours) {

    $prenom_utilisateur = htmlentities($obj->get_prenom());
    $nom_utilisateur = htmlentities($obj->get_nom());

    $nombre_expires = intval($nb_expires);
    $nombre_30jours = intval($nb_30jours);
?>

    <!DOCTYPE HTML>
    <html lang='fr'>

    <head>
      <?php
        require "Composantes/head.html";
      ?>
    </head>

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

        <?php
          require "Composantes/message.php";
        ?>

        <?php
          require "Composantes/logo.html";
        ?>

        <?php
          require "Composantes/quitter.php";
        ?>

        <div class="name">
          <?php echo $prenom_utilisateur." ".$nom_utilisateur; ?>
        </div>

        <div class="titre">
          GESTIONNAIRE DE COMPTE
        </div>


        <form id="creer-form" class="hidden" action="<?php echo URL; ?>" method="post">
          <input type="hidden" id="creer-compte" name="creer-compte" value="oui">
          <button id="creer" class="couleurs menu menu1">
            CRÉER UN<br>
            NOUVEAU COMPTE<br>
            <i class="icons fa-solid fa-user-plus"></i>
          </button>
        </form>

        <div class="couleurs-no-hover menu menu2">
          <div class="notif">
            VISUALISER<br>
            UN COMPTE<br>
          </div>
          <i class="icons-sm fa-solid fa-user-pen"></i>
          <form id="visualiser-form" onSubmit="return false;" action="<?php echo URL; ?>" method="post">
            <input type="hidden" id="visualiser-compte" name="visualiser-compte" value="oui">
            <input id="vis-client" class="vis-auto" type="text" name="vis-client" placeholder="nom ou no. de téléphone" title="Vous devez choisir une suggestion proposée.">
          </form>
        </div>

        <form id="plans-form" class="hidden" action="<?php echo URL; ?>" method="post">
          <input type="hidden" id="gestion-plans" name="gestion-plans" value="oui">
          <button id="plans" class="couleurs menu menu3">
            GESTION<br>
            DES PLANS<br>
            <i class="icons fa-solid fa-file"></i>
          </button>
        </form>

        <div class="couleurs-no-hover menu menu4">
          <div class="notif">
            NOTIFICATIONS
          </div>
          <form id="notifications-form" class="hidden" action="<?php echo URL; ?>" method="post">
            <input type="hidden" id="gestion-notifications" name="gestion-notifications" value="oui">
            <input type="hidden" id="type-notifications" name="type-notifications" value="2">
            <button id="notif-30" class="couleurs notif-btn notif-btn1">
              30 JOURS <span class="pastille pastille-30" title="Vous avez de nouveaux avis 30 jours"><?php echo $nombre_30jours; ?></span>
            </button>
          </form>

          <form id="notifications-form" class="hidden" action="<?php echo URL; ?>" method="post">
            <input type="hidden" id="gestion-notifications" name="gestion-notifications" value="oui">
            <input type="hidden" id="type-notifications" name="type-notifications" value="1">
            <button id="notif-ex" class="couleurs notif-btn notif-btn2">
              EXPIRÉS <span class="pastille pastille-ex" title="Vous avez de nouveaux abonements expirés"><?php echo $nombre_expires; ?></span>
            </button>
          </form>
        </div>

        <script>
          $( document ).ready(function() {
            $( "#vis-client" ).autocomplete({
              source: "Modele/ClientAutocomplete.php",
              select: function( event, ui ) {
                if(ui.item.value != '') {
                  $('#vis-client').val(ui.item.value);
                  $('#visualiser-form').removeAttr('onSubmit');
                  $('#visualiser-form').submit();
                }
              }
            });
            $( "#vis-client" ).click(function(){
              $('#vis-client').val('');
            });
            $( document ).tooltip({
               classes: {
                 "ui-tooltip": "ui-corner-all"
               },
               position: {
                 my: "left top-115", at: "left bottom", collision: "flipfit"
               }
             });
          });
        </script>

    </body>
    </html>

<?php
  }
}
?>
