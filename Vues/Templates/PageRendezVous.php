<?php declare(strict_types=1);

class PageRendezVous {

  public function __construct(Specialiste $obj, Specialite $obj_specialite) {

    $prenom_utilisateur = htmlentities($obj->get_prenom());
    $nom_utilisateur = htmlentities($obj->get_nom());
    $nom_specialite = htmlentities(strtoupper($obj_specialite->get_nom()));

    $message_autocomplete = "Vous devez choisir une suggestion proposée. Seulement les clients ayant des heures disponibles sont affichés.";
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
      <link rel="stylesheet" href="Vues/css/global.css?v=5">

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

      <script src="https://kit.fontawesome.com/4d2a9d3318.js" crossorigin="anonymous"></script> -->

      <style>
        .ui-autocomplete {
          left: 27.3vw !important;
          width: 45.7vw !important;
        }
      </style>

    </head>

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
          <?php echo $prenom_utilisateur." ".$nom_utilisateur." - ".$nom_specialite; ?>
        </div>

        <div class="titre">
          NOUVEAU RENDEZ-VOUS
        </div>

        <form id="rendez-vous" action="<?php echo URL; ?>" method="post">
          <input id="rdv-client" class="rdv" type="text" name="rdv-client" placeholder="nom ou no. de téléphone du client" title="<?php echo $message_autocomplete; ?>">
          <input id="rdv-date" class="rdv" type="text" name="rdv-date" placeholder="date du rendez-vous" readonly="readonly">
          <select id="rdv-heure" name="rdv-heure" class="rdv">
            <option value="">heure du rendez-vous</option>
            <option value="8:00">8:00</option>
            <option value="9:00">9:00</option>
            <option value="10:00">10:00</option>
            <option value="11:00">11:00</option>
            <option value="12:00">12:00</option>
            <option value="13:00">13:00</option>
            <option value="14:00">14:00</option>
            <option value="15:00">15:00</option>
            <option value="16:00">16:00</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
            <option value="20:00">20:00</option>
          </select>
          <input type="hidden" id="formulaire-rendez-vous-specialiste" name="formulaire-rendez-vous-specialiste" value="oui">
          <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="rdv-fixer" class="couleurs rdv" type="submit" value="FIXER LE RENDEZ-VOUS" onclick="return false;">
        </form>

        <script>
          $( document ).ready(function() {

            var rdv_specialiste_autocomplete = '';

            // Pour ajuster la couleur du select à l'ouverture de la page dans FireFox.
            $('#rdv-heure').css('background-color','#FFF');

            $( "#rdv-client" ).autocomplete({
              source: "Modele/ClientAutocomplete.php?rdv_specialiste=oui",
              select: function( event, ui ) {
                if(ui.item.value != '') {
                  //$('#rdv-client').val(ui.item.value);
                  rdv_specialiste_autocomplete = ui.item.value;
                }
              },
              close: function( event, ui ) {
                if(rdv_specialiste_autocomplete != '') {
                  $('#rdv-client').val(rdv_specialiste_autocomplete);
                  $('#rdv-client').attr('readonly','readonly');
                }
                else $('#rdv-client').val('').change();
              }
            });

            $('#rdv-client').click(function(){
              if($('#rdv-client').attr('readonly') == 'readonly') {
                $('#rdv-client').val('').change();
                $('#rdv-client'). removeAttr('readonly');
              }
            });

            $( function() {
              $( "#rdv-date" ).datepicker({
                minDate: 0,
                dateFormat: "yy-mm-dd"
              });
            });

            $.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
              closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
              prevText: '<Préc', prevStatus: 'Voir le mois précédent',
              nextText: 'Suiv>', nextStatus: 'Voir le mois suivant',
              currentText: 'Courant', currentStatus: 'Voir le mois courant',
              monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
              'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
              monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
              'Jul','Aoû','Sep','Oct','Nov','Déc'],
              monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',
              weekHeader: 'Sm', weekStatus: '',
              dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
              dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
              dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
              dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
              dateFormat: 'dd/mm/yy', firstDay: 0,
              initStatus: 'Choisir la date', isRTL: false};
            $.datepicker.setDefaults($.datepicker.regional['fr']);

          $('#rdv-heure').change(function(){
              $(this).css('color','#000');
          });

          $('#rdv-fixer').click(function(){
            let validation = true;
            $("#rendez-vous").children().each(function(){
                if($(this).val() === '') {
                  validation = false;
                  $(this).css('background-color','orange');
                }
            });
            if(validation === false) alert('Tous les champs sont requis.');
            else {
              $('#rendez-vous').submit();
            }
          });

          $('input, select').click(function(){
            $(this).css('background-color','#FFF');
          });

          $( document ).tooltip({
             classes: {
               "ui-tooltip": "ui-corner-all"
             },
             position: {
               my: "right top-200", at: "right bottom", collision: "flipfit"
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
