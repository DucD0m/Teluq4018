<?php declare(strict_types=1);

class PageRendezVous {

  public function __construct(Specialiste $obj, Specialite $obj_specialite) {

    $prenom_utilisateur = htmlentities($obj->get_prenom());
    $nom_utilisateur = htmlentities($obj->get_nom());
    $nom_specialite = htmlentities($obj_specialite->get_nom());

    $message_autocomplete = "Vous devez choisir une suggestion proposée. Seulement les clients ayant des heures disponibles sont affichés.";
?>

    <!DOCTYPE HTML>
    <html lang='fr'>

    <head>
      <title>Gym Argenté</title>

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

      <script src="https://kit.fontawesome.com/4d2a9d3318.js" crossorigin="anonymous"></script>

      <!-- <style>
        html {
          font-family: arial;
        }
        tbody tr:nth-child(even) {
          background-color: #eee;
        }
        .auth {
          position: absolute;
          left: 25vw;
          display: inline-block;
          width: 50vw;
          height: 5vw;
          border-radius: 5vw;
          border: #666 0.1vw solid;
          text-align: center;
          font-size: 1.5vw;
        }
        .auth-courriel {
          top: 15vw;
        }
        .auth-mdp {
          top: 22.5vw;
        }
        .auth-submit {
          top: 30vw;
          border: none;
          box-sizing: content-box;
        }
        .couleurs {
          background-color: #666 !important;
          color: #87CEFA !important;
        }
        .couleurs:hover {
          color: #666 !important;
          background-color: #87CEFA !important;
          cursor: pointer;
        }
        .couleurs-no-hover {
          background-color: #666;
          color: #87CEFA;
        }
        .demi-droite {
          position: absolute;
          top: 12vw;
          left: 55vw;
          width: 40vw;
        }
        .demi-gauche {
          position: absolute;
          top: 12vw;
          left: 5vw;
          width: 45vw;
          border-right: #666 0.2vw solid;
          font-size: 1.3vw;
        }
        .icons {
          font-size: 7vw;
          padding: 1vw;
          border-radius: 1vw;
          border: #87CEFA 0.2vw solid;
        }
        .icons-sm {
          font-size: 3vw;
          padding: 1vw;
          border-radius: 1vw;
          border: #87CEFA 0.2vw solid;
        }
        .info-plan {
          line-height: 2vw;
          color: #666;
          font-size: 1.3vw;
        }
        .info-plan > div > span {
          float: right;
        }
        .input-client {
          display: inline-block;
          width: 40vw;
          height: 3vw;
          text-align: center;
          line-height: 3vw;
          margin-bottom: 3.77vw;
          border-bottom: #666 0.1vw solid;
          border-top: none;
          border-left: none;
          border-right: none;
          font-size: 1.5vw;
        }
        .input-paiement {
          width: 8vw !important;
        }
        .input-plan {
          display: inline-block;
          width: 5vw;
          height: 2.5vw;
          float: right;
          border-radius: 0.5vw;
          border: #666 0.1vw solid;
          color: #666;
          text-align: center;
          font-size: 1.5vw;
        }
        .invisible {
          visibility: hidden;
        }
        .logo {
          position: absolute;
          top: 0;
          left: 0;
          height: 10vw;
          width: 18vw;
          border-radius: 0 0 2vw 0;
          font-size: 3vw;
          line-height: 1.6;
          padding-left: 2vw;
          pointer-events: none;
        }
        .menu {
          position: absolute;
          height: 17vw;
          width: 28.5vw;
          border-radius: 1vw;
          text-align: center;
          line-height: 1.6;
          font-size: 1.5vw;
          border: none;
        }
        .menu1 {
          top: 12vw;
          left: 20.25vw;
        }
        .menu2 {
          top: 12vw;
          left: 51.25vw;
        }
        .menu3 {
          top: 32vw;
          left: 20.25vw;
        }
        .menu4 {
          top: 32vw;
          left: 51.25vw;
        }
        .modif-plan {
          color: #666;
          font-size: 1.3vw;
        }
        .modif-plan > form > label {
          display: inline-block;
          width: 30vw;
          padding: 1.33vw 0;
          font-size: 1.3vw;
        }
        .modif-plan > form > select {
          display: inline-block;
          width: 100%;
          height: 3vw;
          margin: 1vw 0;
          border-radius: 0.5vw;
          border: #666 0.1vw solid;
          text-align: center;
          color: #666;
          font-size: 1.3vw;
        }
        .name {
          position: absolute;
          top: 1.6vw;
          left: 25vw;
          font-size: 2vw;
        }
        .notif {
          margin-top: 1.5vw;
        }
        .notif-btn {
          display: inline-block;
          width: 25vw;
          border-radius: 1vw;
          border: #87CEFA 0.2vw solid;
          position: relative;
          height: 4vw;
          line-height: 3vw;
          font-size: 1.5vw;
        }
        .notif-btn1 {
          top: 2vw;
        }
        .notif-btn2 {
          top: 3.5vw;
        }
        .notif-client {
          display: inline-block;
          width: 21vw;
        }
        .notif-bordure-ex {
          border-color: red !important;
        }
        .notif-bordure-30 {
          border-color: orange !important;
        }
        .notif-date-ex {
          color: red;
        }
        .notif-date-30 {
          color: orange;
        }
        .notif-details {
          width: 70vw;
          height: 5vw;
          margin-left: 1vw;
          margin-bottom: 1vw;
          border: #666 0.1vw solid;
          border-radius: 1vw;
        }
        .notif-infos {
          position: relative;
          top: 0.5vw;
          display: inline-block;
          width: 50vw;
          text-align: left;
          font-size: 1.5vw;
          line-height: 1.9vw;
          color: #666;
          cursor: pointer;
        }
        .notif-infos:hover {
          color: #87CEFA;
        }
        .notif-plan {
          display: inline-block;
          width: 28vw;
        }
        .notif-supprimer {
          display: inline-block;
          height: 5vw;
          width: 6vw;
          border: none;
          background-color: transparent;
          color: #666;
          font-size: 2vw;
          text-align: right;
          cursor: pointer;
        }
        .notif-supprimer:hover {
          color: red;
        }
        .notif-vu {
          display: inline-block;
          height: 5vw;
          width: 10vw;
          border: none;
          background-color: transparent;
          color: #666;
          font-size: 2vw;
          cursor: pointer;
        }
        .notif-vu:hover {
          color: #87CEFA;
        }
        .pastille {
          position: absolute;
          top: 0.6vw;
          left: 18.5vw;
          width: 3.5vw;
          height: 2.5vw;
          display: inline-block;
          line-height: 2.5vw;
          border-radius: 50%;
          color: black;
        }
        .pastille-30 {
          background-color: orange;
        }
        .pastille-ex {
          background-color: red;
        }
        .plans-th {
          background-color: #666;
          color: #87CEFA;
        }
        .plans-tr-droite {
          border-radius: 0 1vw 1vw 0;
        }
        .plans-tr-gauche {
          border-radius: 1vw 0 0 1vw;
        }
        .quitter {
          position: absolute;
          top: 0;
          right: 0;
          width: 15vw;
          height: 10vw;
          text-align: center;
          font-size: 2vw;
          line-height: 10vw;
          border-radius: 0 0 0 1.5vw;
          cursor: pointer;
          border: none;
        }
        .rdv {
          position: absolute;
          left: 25vw;
          display: inline-block;
          width: 50vw;
          height: 5vw;
          border-radius: 2.5vw;
          border: #666 0.1vw solid;
          text-align: center;
          color: #666;
          font-size: 1.3vw;
        }
        .retour {
          position: absolute;
          top: 0;
          left: 0;
          width: 15vw;
          height: 10vw;
          text-align: center;
          font-size: 2vw;
          line-height: 10vw;
          border-radius: 0 0 1.5vw 0;
          cursor: pointer;
          border: none;
        }
        .submit-client {
          display: inline-block;
          width: 40vw;
          height: 5vw;
          text-align: center;
          line-height: 5vw;
          border-radius: 2.5vw;
          border: none;
          font-size: 1.5vw;
        }
        .titre {
          position: absolute;
          top: 5.7vw;
          left: 25vw;
          font-size: 1.5vw;
        }
        .vis-auto {
          display: inline-block;
          width: 25vw;
          height: 3vw;
          border-radius: 0.5vw;
          margin-top: 0.5vw;
          border: none;
          text-align: center;
        }
        #notif-cadre {
          position: absolute;
          top: 10vw;
          left: 14vw;
          width: 72vw;
          height: 65vh;
          overflow: scroll;
        }
        #nouveau-client {
          display: none;
          font-size: 1.5vw;
          text-align: center;
          height: 13.95vw;
          line-height: 13.95vw;
        }
        #plans-liste {
          position: absolute;
          top: 10vw;
          left: 15vw;
          width: 70vw;
          height: 80vh;
          overflow: scroll;
        }
        #plans-table {
          width: 70vw;
          text-align: center;
          border-spacing: 0;
          line-height: 2vw;
          font-size: 1.2vw;
          color: #666;
        }
        #plans-table td {
          line-height: 4vw;
        }
        #plans-table input {
          line-height: 3vw;
          font-size: 1.2vw;
          color: #666;
          background-color: #FFF;
          text-align: center;
          border: #666 0.1vw solid;
          border-radius: 1vw;
        }
        #rdv-client {
          top: 15vw;
        }
        #rdv-date {
          top: 23vw;
        }
        #rdv-fixer {
          top: 39vw;
          border-radius: 2.5vw;
          box-sizing: content-box;
          border: none;
        }
        #rdv-heure {
          top: 31vw;
          width: 50.5vw;
        }
        #submit-plans {
          position: relative;
          top: 1.5vw;
          left: 40.7vw;
          width: 28.1vw;
          height: 5vw;
          text-align: center;
          line-height: 5vw;
          border-radius: 2.5vw;
          border: none;
          font-size: 1.5vw;
        }
        #supprimer-client {
            position: absolute;
            top: 4.5vw;
            right: 34vw;
            width: 16vw;
            height: 4vw;
            text-align: center;
            font-size: 1vw;
            line-height: 4vw;
            border-radius: 1.5vw;
            cursor: pointer;
            border: none;
        }
        #supprimer-client:hover {
          background-color: red;
        }
      </style> -->

      <style>
        .ui-autocomplete {
          left: 27.3vw !important;
          width: 45.7vw !important;
        }
      </style>

    </head>

    <body>

        <?php if(isset($_SESSION['message']) && ($_SESSION['message'] != '')): ?>
          <script>
          $( document ).ready(function() {
            alert("<?php echo $_SESSION['message']; ?>");
          });
          </script>
        <?php unset($_SESSION['message']); endif; ?>

        <div class='couleurs logo'>
          GY<i class="fa-solid fa-dumbbell"></i><br>
          ARGENTÉ
        </div>

        <button id="quitter" class="couleurs quitter">
          QUITTER <i class="fa-solid fa-person-running"></i>
        </button>

        <form id="quitter-form" class="hidden" action="<?php echo URL; ?>" method="post">
          <input type="hidden" id="quitter-input" name="quitter" value="oui">
          <button id="quitter" class="couleurs quitter" type="submit" value="submit">
            QUITTER <i class="fa-solid fa-person-running"></i>
          </button>
        </form>

        <div class="name">
          <?php echo $prenom_utilisateur." ".$nom_utilisateur." - ".strtoupper($nom_specialite); ?>
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
