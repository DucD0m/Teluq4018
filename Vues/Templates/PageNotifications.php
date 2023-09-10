<?php declare(strict_types=1);

class PageNotifications {

  public function __construct(Gestionnaire $obj, TypeNotification $obj_type_notifications, array $items) {

    $prenom_utilisateur = htmlentities($obj->get_prenom());
    $nom_utilisateur = htmlentities($obj->get_nom());
    $type_id = intval($obj_type_notifications->get_id());
    $type_nom = htmlentities($obj_type_notifications->get_nom());
?>

    <!DOCTYPE HTML>
    <html lang='fr'>

    <head>
      <?php
        require "Composantes/head.html";
      ?>
      <!-- <title>Gym Argenté</title>

      <meta charset="UTF-8">

      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/cupertino/jquery-ui.css">
      <link rel="stylesheet" href="Vues/css/global.css?v4">

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

      <script src="Vues/javascript/global.js"></script> -->
    </head>

    <body>

        <?php
          require "Composantes/message.php";
        ?>

        <?php
          require "Composantes/retour.php";
        ?>

        <?php
          require "Composantes/quitter.php";
        ?>

        <div class="name">
          <?php echo $prenom_utilisateur." ".$nom_utilisateur." - GESTIONNAIRE DE COMPTE"; ?>
        </div>

        <div class="titre">
          <?php echo "NOTIFICATIONS - ".$type_nom; ?>
        </div>

        <div id="notif-cadre">
            <?php
            if($items) {
              foreach ($items as $item) {
                $notification_id = intval($item[0]->get_id());
                $notification_vu = intval($item[0]->get_vu());
                $client_prenom = htmlentities($item[1]->get_prenom());
                $client_nom = htmlentities($item[1]->get_nom());
                $client_telephone = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', htmlentities(strval($item[1]->get_telephone())));
                $client_fin_abonnement = htmlentities($item[1]->get_fin_abonnement());
                $plan_nom = htmlentities($item[2]->get_nom());
            ?>

                  <?php if($type_id === 1 && $notification_vu === 0): ?>
                    <div class="notif-details notif-bordure-ex">
                      <form id="notif-vu-form<?php echo $notification_id; ?>" class="hidden" action="<?php echo URL; ?>" method="post">
                        <input type="hidden" id="formulaire-notification-vu<?php echo $notification_id; ?>" name="formulaire-notification-vu" value="oui">
                        <input type="hidden" id="notification-vu-id<?php echo $notification_id; ?>" name="notification-vu-id" value="<?php echo $notification_id; ?>">
                        <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <button class="notif-vu" title="Marquer comme vu" type="submit">
                          <i class="fa-solid fa-eye"></i>
                        </button>
                      </form>

                  <?php elseif($type_id === 2 && $notification_vu === 0): ?>
                    <div class="notif-details notif-bordure-30">
                      <form id="notif-vu-form<?php echo $notification_id; ?>" class="hidden" action="<?php echo URL; ?>" method="post">
                        <input type="hidden" id="formulaire-notification-vu<?php echo $notification_id; ?>" name="formulaire-notification-vu" value="oui">
                        <input type="hidden" id="notification-vu-id<?php echo $notification_id; ?>" name="notification-vu-id" value="<?php echo $notification_id; ?>">
                        <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <button class="notif-vu" title="Marquer comme vu" type="submit">
                          <i class="fa-solid fa-eye"></i>
                        </button>
                      </form>

                  <?php else: ?>
                    <div class="notif-details">
                      <form id="notif-vu-form<?php echo $notification_id; ?>" class="hidden" action="<?php echo URL; ?>" method="post">
                        <input type="hidden" id="formulaire-notification-vu<?php echo $notification_id; ?>" name="formulaire-notification-vu" value="oui">
                        <input type="hidden" id="notification-vu-id<?php echo $notification_id; ?>" name="notification-vu-id" value="<?php echo $notification_id; ?>">
                        <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <button class="invisible notif-vu" title="Marquer comme vu" type="submit">
                          <i class="fa-solid fa-eye"></i>
                        </button>
                      </form>

                  <?php endif; ?>


                    <div class="notif-infos" title="Visualiser le compte client">
                      <div class="notif-client">
                        <?php echo $client_prenom." ".$client_nom; ?><br>
                        <?php echo $client_telephone; ?>
                      </div>
                      <div class="notif-plan">
                        <?php echo $plan_nom; ?><br>
                        Fin de l'abonnement:&nbsp;
                        <?php if($type_id === 1): ?>
                          <span class="notif-date-ex"><?php echo date_francais($client_fin_abonnement, "j F Y"); ?></span>
                        <?php elseif($type_id === 2): ?>
                          <span class="notif-date-30"><?php echo date_francais($client_fin_abonnement, "j F Y"); ?></span>
                        <?php else: ?>
                          <span><?php echo date_francais($client_fin_abonnement, "j F Y"); ?></span>
                        <?php endif; ?>
                      </div>
                    </div>
                    <form id="notif-supprimer-form<?php echo $notification_id; ?>" class="hidden" action="<?php echo URL; ?>" method="post">
                      <input type="hidden" id="formulaire-notification-supprimer<?php echo $notification_id; ?>" name="formulaire-notification-supprimer" value="oui">
                      <input type="hidden" id="notification-supprimer-id<?php echo $notification_id; ?>" name="notification-supprimer-id" value="<?php echo $notification_id; ?>">
                      <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                      <button class="notif-supprimer" title="Supprimer la notification" type="submit" onclick="return false;">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  </div>
              <?php }
              }
              else {
              ?>
              <div id="aucune-notifications">Il n'y aucune notification pour le moment.</div>
              <?php } ?>
        </div>

        <script>
          $( document ).ready(function() {
            $( document ).tooltip({
               classes: {
                 "ui-tooltip": "ui-corner-all"
               }
            });
            $('.notif-supprimer').click(function(){
              let confirmation;
              confirmation = confirm('Êtes-vous certain de vouloir supprimer cette notification?');
              if(confirmation) {
                $(this).closest("form").submit();
              }
              else return false;
            });
          });
        </script>

    </body>
    </html>

<?php
  }
}
?>
