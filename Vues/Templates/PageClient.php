<?php declare(strict_types=1);

class PageClient {

  public function __construct(Client $obj, array $plans) {

    $prenom = htmlentities($obj->get_prenom());
    $nom = htmlentities($obj->get_nom());
    $adresse = htmlentities($obj->get_adresse());
    $telephone = $obj->get_telephone();
    $courriel = htmlentities($obj->get_courriel());
    $adhesion = htmlentities($obj->get_adhesion());
    $plan = $obj->get_plan();
    $renouvellement = htmlentities($obj->get_renouvellement());
    $fin_abonnement = htmlentities($obj->get_fin_abonnement());
    $fin_acces_appareils = htmlentities($obj->get_fin_acces_appareils());
    $heures_specialistes = $obj->get_heures_specialistes();
    $heures_specialistes_utilise = $obj->get_heures_specialistes_utilise();
    $cours_groupe_semaine = $obj->get_cours_groupe_semaine();

?>

    <!DOCTYPE HTML>
    <html lang='fr'>

    <head>
      <title>Gym Argenté</title>

      <meta charset="UTF-8">

      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/cupertino/jquery-ui.css">

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

      <style>
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
          font-size: 1.5vw;
          text-align: center;
          height: 16.5vw;
          line-height: 16.5vw;
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
            top: 5vw;
            right: 57vw;
            width: 5vw;
            height: 3vw;
            text-align: center;
            font-size: 1vw;
            line-height: 3vw;
            border-radius: 1.5vw;
            cursor: pointer;
            border: none;
        }
        #supprimer-client:hover {
          background-color: red;
        }
      </style>

      <script>
      // Pour insertion dans la base de données.
      var telephone_bd;

      // Cette fonction ajuste la présentation visuelle du numéro de téléphone.
      function formatTelephone(phoneNumberString) {
        var cleaned = ('' + phoneNumberString).replace(/\D/g, '');
        var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
        if (match) {
          telephone_bd = phoneNumberString;
          return '(' + match[1] + ') ' + match[2] + '-' + match[3];
        }
        return '';
      }
      </script>
    </head>

    <body>
        <form id="retour-form" class="hidden" action="http://10.0.1.18" method="post">
          <input type="hidden" id="retour-input" name="retour" value="oui">
          <button id="retour-menu" class="couleurs retour" type="submit" value="submit">
            <i class="fa-solid fa-backward"></i> MENU<br>
          </button>
        </form>

        <form id="quitter-form" class="hidden" action="http://10.0.1.18" method="post">
          <input type="hidden" id="quitter-input" name="quitter" value="oui">
          <button id="quitter" class="couleurs quitter" type="submit" value="submit">
            QUITTER <i class="fa-solid fa-person-running"></i>
          </button>
        </form>

        <div class="name">
          Dominique Ducas - GESTIONNAIRE DE COMPTE
        </div>

        <div class="titre">
          COMPTE CLIENT
        </div>

        <button id="supprimer-client">
          <i class="fa-solid fa-trash"></i>
        </button>

          <div class="demi-gauche">
              <form id="formulaire-gauche" action="#" method="post">
                <input class="input-client" type="text" id="client-prenom" name="client-prenom" placeholder="prénom" value="<?php echo $prenom; ?>">
                <input class="input-client" type="text" id="client-nom" name="cient-nom" placeholder="nom" value="<?php echo $nom;?>">
                <input class="input-client" type="text" id="client-adresse" name="client-adresse" placeholder="adresse" value="<?php echo $adresse; ?>">
                <input class="input-client" type="text" id="client-telephone" name="client-telephone" placeholder="téléphone (xxx) xxx-xxxx" value="<?php echo $telephone; ?>">
                <input class="input-client" type="text" id="client-courriel" name="client-courriel" placeholder="courriel" value="<?php echo $courriel; ?>">
                <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <input class="couleurs submit-client" id="maj-personne" type="submit" value="METTRE À JOUR" disabled>
              </form>
          </div>

          <div class="demi-droite">

            <?php if($obj->get_id() > 0): ?>
              <div id="info-plan" class="info-plan">
                <div>
                  Date d'adhésion: <span><?php echo $adhesion; ?></span>
                </div>
                <div>
                  Plan: <span><?php echo $plan; ?></span>
                </div>
                <div>
                  Date de renouvellement: <span><?php echo $renouvellement; ?></span>
                </div>
                <div>
                  Fin de l'abonnement: <span><?php echo $fin_abonnement; ?></span>
                </div>
                <div>
                  Fin de l'accès aux appareils: <span><?php echo $fin_acces_appareils; ?></span>
                </div>
                <div>
                  Heures avec spécialistes achetées: <span><?php echo $heures_specialistes; ?></span>
                </div>
                <div>
                  Heures avec spécialistes utilisées: <span><?php echo $heures_specialistes_utilise; ?></span>
                </div>
                <div>
                  Nombre de cours de groupes par semaine: <span><?php echo $cours_groupe_semaine; ?></span>
                </div>
              </div>

            <?php else: ?>

              <div id="nouveau-client" class="info-plan">
                NOUVEAU CLIENT
              </div>

            <?php endif; ?>

              <hr>

  <!-- php if date renouvellement > now - 30 jours... else specialistes seulement-->
              <div class="modif-plan">
                <form id="formulaire-droite" action="http://10.0.1.18" method="post">
                  <select id="plan-id" name="plan-id">
                      <!-- AFFICHER L'OPTION POUR AJOUTER DES HEURES DE SPÉCIALISTES SEULEMENT SI L'ABONNEMENT EST BON POUR PLUS DE 30 JOURS -->
                    <?php foreach ($plans as $plan) {
                      $plan_id = $plan->get_id();
                      $plan_nom = htmlentities($plan->get_nom());
                      $plan_prix = $plan->get_prix();
                      $plan_prix_cours_groupe = $plan->get_prix_cours_groupe();
                    ?>
                      <option
                        data-prix="<?php echo $plan_prix; ?>"
                        data-prix-groupe="<?php echo $plan_prix_cours_groupe; ?>"
                        value="<?php echo $plan_id; ?>"><?php echo $plan_nom." ( "; ?>
                        <?php
                          if($plan_prix > 0 && $plan_prix_cours_groupe > 0) echo $plan_prix."$ | ";
                          else if($plan_prix == 0 && $plan_prix_cours_groupe > 0) echo "";
                          else echo $plan_prix."$";
                        ?>
                        <?php if($plan_prix_cours_groupe > 0) echo "1 cours de groupe/sem: ".$plan_prix_cours_groupe."$"; ?>
                        <?php echo " )"; ?>
                      </option>
                    <?php } ?>

                  </select>
                  <label id="client-groupes-label" for="client-groupes">
                    Nombre de cours de groupes par semaine:
                  </label>
                  <input type="text" class="input-plan" id="client-groupes" name="client-groupes">
                  <label for="client-spec">
                    Nombre d'heures avec un spécialiste:
                  </label>
                  <input type="text" class="input-plan" id="client-spec" name="client-spec">
                  <label for="client-payer">
                    TOTAL À PAYER:
                  </label>
                  <input type="text" class="input-plan input-paiement" id="client-payer" name="client-payer" disabled>
                  <input class="nouveau-client" type="hidden" id="nouveau-prenom" name="nouveau-prenom" value="" disabled>
                  <input class="nouveau-client" type="hidden" id="nouveau-nom" name="nouveau-nom" value="" disabled>
                  <input class="nouveau-client" type="hidden" id="nouveau-adresse" name="nouveau-adresse" value="" disabled>
                  <input class="nouveau-client" type="hidden" id="nouveau-telephone" name="nouveau-telephone" value="" disabled>
                  <input class="nouveau-client" type="hidden" id="nouveau-courriel" name="nouveau-courriel" value="" disabled>
                  <input class="nouveau-client" type="hidden" id="formulaire-nouveau-client" name="formulaire-nouveau-client" value="oui" disabled>
                  <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                  <input id="bouton-ajouter" type="submit" class="couleurs submit-client" value="AJOUTER" onclick="return false;">
                </form>
              </div>
          </div>

          <script>
            $( document ).ready(function() {

              $('#supprimer-client').click(function(){
                confirm('Êtes-vous certain de vouloir supprimer ce compte client?');
              });

              // Active les champs hidden du formulaire pour les nouveaux clients.
              if($('#nouveau-client').length){
              	$('#maj-personne').css('visibility','hidden');
                $('.nouveau-client').removeAttr('disabled');
                $('#formulaire-nouveau-client').val('oui');
              }
              else $('#formulaire-nouveau-client').val('non');

              // Envoi des valeur du formulaire de gauche dans les champs hidden du formulaire de droite.
              $('.input-client').change(function(){
                if($(this).attr('id') == 'client-prenom') $('#nouveau-prenom').val($('#client-prenom').val());
                else if($(this).attr('id') == 'client-nom') $('#nouveau-nom').val($('#client-nom').val());
                else if($(this).attr('id') == 'client-adresse') $('#nouveau-adresse').val($('#client-adresse').val());
                else if($(this).attr('id') == 'client-courriel') $('#nouveau-courriel').val($('#client-courriel').val());
              });

              // Change le format du numéro de téléphone
              $('#client-telephone').change(function(){
                let tel = formatTelephone($('#client-telephone').val());
                $('#client-telephone').val(tel);
                $('#nouveau-telephone').val(tel);
              });

              $('#client-telephone').change(function(){
                let tel = formatTelephone($('#client-telephone').val());
                $('#client-telephone').val(tel);
                $('#nouveau-telephone').val(tel);
              });

              // Change le format du numéro au chargement initial de la page.
              $('#client-telephone').val(formatTelephone($('#client-telephone').val())).change();

              // Cache l'option pour le nombre de cours de groupes lorsqu'un plan Spécialiste seulement est choisi.
              $('#plan-id').change(function(){
                let nom = $("#plan-id option:selected").text();
                if (nom.indexOf("Spécialiste") >= 0){
                  $('#client-groupes, #client-groupes-label').css('visibility','hidden');
                  $('#client-groupes').val('');
                }
                else $('#client-groupes, #client-groupes-label').css('visibility','visible');
              });

              // Validation des champs pour les cours de groupe et pour les heures specialistes.
              $('#client-groupes').change(function(){
                let val = parseInt($(this).val());
        				if(Number.isInteger(val) && val >= 0 && val <= 10 ){}
        				else {
        					alert('Le nombre de cours de groupe doit être de 0 à 10.');
        					$(this).val('');
        				}
              });
              $('#client-spec').change(function(){
                let val = parseInt($(this).val());
        				if(Number.isInteger(val) && val >= 0 && val <= 100 ){}
        				else {
        					alert('Le nombre de cours de groupe doit être de 0 à 100.');
        					$(this).val('');
        				}
              });

              // Calcul du total à payer
              $('#plan-id, #client-groupes, #client-spec').change(function(){
                if($('#client-groupes').val() != '' && $('#client-spec').val() != ''){
                  let prix = $("#plan-id option:selected").data('prix');
                  let cours_groupe = $('#client-groupes').val() * $("#plan-id option:selected").data('prix-groupe');
                  let heures_specialistes;
                  let total;

                  if($('#client-spec').val() >= 10) heures_specialistes = 65 * ($('#client-spec').val());
                  else heures_specialistes = 75 * ($('#client-spec').val());

                  let nom = $("#plan-id option:selected").text();
                  if (nom.indexOf("Spécialiste") >= 0){
                    total = heures_specialistes
                  }
                  else  {
                    total = prix + cours_groupe + heures_specialistes;
                  }

                  $('#client-payer').val(total.toFixed(2));
                }
                else $('#client-payer').val('');
              });

              $('#bouton-ajouter').click(function(){
                let validation = true;
                $('input').each(function(){
                    if($(this).val() === '') {
                      validation = false;
                      //alert($(this).attr('id'));
                    }
                });
                if(validation === false) alert('Tous les champs doivent être remplis');
                else {
                  let nouveau_tel = $('#nouveau-telephone').val();
                  nouveau_tel = nouveau_tel.replace(' ','').replace('(','').replace(')','').replace('-','');
                  $('#nouveau-telephone').val(nouveau_tel);
                  $('#formulaire-droite').submit();
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
