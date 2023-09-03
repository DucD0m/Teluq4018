<?php declare(strict_types=1);

class PagePlans {

  public function __construct(array $plans) {
?>

    <!DOCTYPE HTML>
    <html lang='fr'>

    <head>
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
        #modifier-plans {
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
    </head>

    <body>
      
        <?php if(isset($_SESSION['message']) && ($_SESSION['message'] != '')): ?>
          <script>
            alert("<?php echo $_SESSION['message']; ?>");
          </script>
        <?php unset($_SESSION['message']); endif; ?>

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
          GESTION DES PLANS
        </div>

        <div id="plans-liste">
          <form id="formulaire-plans" action="http://10.0.1.18" method="post">
            <table id="plans-table">
              <thead>
                <tr>
                  <th class="plans-th plans-tr-gauche">Nom</th>
                  <th class="plans-th">Durée</th>
                  <th class="plans-th">Accès<br>appareils</th>
                  <th class="plans-th">Accès cours<br>de groupe</th>
                  <th class="plans-th">Prix cours<br>de groupe</th>
                  <th class="plans-th plans-tr-droite">Prix du plan</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($plans as $p) {
                  $p_id = $p->get_id();

                  $p_nom = htmlentities($p->get_nom());
                  $p_duree = $p->get_duree();
                  if(strpos($p->get_nom(),"Spécialiste") >= 0 && strpos($p->get_nom(),"Spécialiste") != '') {
                    if($p_duree > 1) $type_duree = "heures";
                    else $type_duree = "heure";
                  }
                  else {
                    $type_duree = "mois";
                  }

                  $p_prix = $p->get_prix();
                  if($p_prix == 0) $p_prix = "N/A";
                  else $p_prix = number_format($p_prix,2)."$";

                  $p_acces_appareils = $p->get_acces_appareils();
                  if($p_acces_appareils == 1) $p_acces_appareils = "OUI";
                  else $p_acces_appareils = "NON";

                  $p_acces_cours_groupe = $p->get_acces_cours_groupe();
                  if($p_acces_cours_groupe == 1) $p_acces_cours_groupe = "OUI";
                  else $p_acces_cours_groupe = "NON";

                  $p_prix_cours_groupe = $p->get_prix_cours_groupe();
                  if($p_prix_cours_groupe == 0) $p_prix_cours_groupe = "N/A";
                  else $p_prix_cours_groupe = number_format($p_prix_cours_groupe,2)."$";
                ?>
                <tr>
                  <td class="plans-tr-gauche"><?php echo $p_nom; ?></td>
                  <td><?php echo $p_duree." ".$type_duree; ?></td>
                  <td><?php echo $p_acces_appareils; ?></td>
                  <td><?php echo $p_acces_cours_groupe; ?></td>
                  <td>
                    <input type="hidden" class="plan-id" id="plan-id<?php echo $p_id; ?>" name="plan<?php echo $p_id; ?>[]" value="<?php echo $p_id; ?>">
                    <input type="text" id="plan-prix-groupe<?php echo $p_id; ?>" name="plan<?php echo $p_id; ?>[]" value="<?php echo $p_prix_cours_groupe; ?>">
                  </td>
                  <td class="plans-tr-droite"><input type="text" id="plan-prix<?php echo $p_id; ?>" name="plan<?php echo $p_id; ?>[]" value="<?php echo $p_prix; ?>"></td>
                </tr>
                <?php } ?>


                <!-- <tr>
                  <td class="plans-tr-gauche">Mensuel sans appareils</td>
                  <td>1 mois</td>
                  <td>NON</td>
                  <td>OUI</td>
                  <td><input type="text" id="plan-prix-groupe2" name="plan-prix-groupe2" value="50.00$"></td>
                  <td class="plans-tr-droite"><input type="text" id="plan-prix2" name="plan-prix2" value="N/A" disabled></td>
                </tr>

                <tr>
                  <td class="plans-tr-gauche">Trimestriel avec appareils</td>
                  <td>3 mois</td>
                  <td>OUI</td>
                  <td>OUI</td>
                  <td><input type="text" id="plan-prix-groupe3" name="plan-prix-groupe3" value="60.00$"></td>
                  <td class="plans-tr-droite"><input type="text" id="plan-prix3" name="plan-prix3" value="220.00$"></td>
                </tr>

                <tr>
                  <td class="plans-tr-gauche">Trimestriel sans appareils</td>
                  <td>3 mois</td>
                  <td>NON</td>
                  <td>OUI</td>
                  <td><input type="text" id="plan-prix-groupe4" name="plan-prix-groupe4" value="135.00$"></td>
                  <td class="plans-tr-droite"><input type="text" id="plan-prix4" name="plan-prix4" value="N/A" disabled></td>
                </tr>

                <tr>
                  <td class="plans-tr-gauche">Annuel avec appareils</td>
                  <td>12 mois</td>
                  <td>OUI</td>
                  <td>OUI</td>
                  <td><input type="text" id="plan-prix-groupe5" name="plan-prix-groupe5" value="200.00$"></td>
                  <td class="plans-tr-droite"><input type="text" id="plan-prix5" name="plan-prix5" value="800.00$"></td>
                </tr>

                <tr>
                  <td class="plans-tr-gauche">Annuel sans appareils</td>
                  <td>12 mois</td>
                  <td>NON</td>
                  <td>OUI</td>
                  <td><input type="text" id="plan-prix-groupe6" name="plan-prix-groupe6" value="500.00$"></td>
                  <td class="plans-tr-droite"><input type="text" id="plan-prix6" name="plan-prix6" value="N/A" disabled></td>
                </tr>

                <tr>
                  <td class="plans-tr-gauche">Spécialistes 1 heure</td>
                  <td>1 heure</td>
                  <td>NON</td>
                  <td>NON</td>
                  <td><input type="text" id="plan-prix-groupe7" name="plan-prix-groupe7" value="N/A" disabled></td>
                  <td class="plans-tr-droite"><input type="text" id="plan-prix7" name="plan-prix7" value="75.00$"></td>
                </tr>

                <tr>
                  <td class="plans-tr-gauche">Spécialistes 10 heure ou plus</td>
                  <td>10 heures</td>
                  <td>NON</td>
                  <td>NON</td>
                  <td><input type="text" id="plan-prix-groupe8" name="plan-prix-groupe8" value="N/A" disabled></td>
                  <td class="plans-tr-droite"><input type="text" id="plan-prix8" name="plan-prix8" value="65.00$"></td>
                </tr> -->
              </tbody>
            </table>
            <input type="hidden" id="formulaire-modifier-plans" name="formulaire-modifier-plans" value="oui">
            <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="submit" id="modifier-plans" class="couleurs" value="METTRE À JOUR" onclick="return false;">
          </form>
        </div>

        <script>
          $( document ).ready(function() {
            $('#modifier-plans').click(function(){
              let validation = true;
              $('input').each(function(){
                  if($(this).val() === '') {
                    validation = false;
                    //alert($(this).attr('id'));
                  }
              });
              if(validation === false) alert('Tous les champs doivent être remplis');
              else {
                $('input[name^="plan"]').each(function(){
                    let val = $(this).val();
                    if(this.className == 'plan-id'){
                      // continue...
                    }
                    else if(val == 'N/A') {
                      $(this).val(parseFloat(0).toFixed(2));
                    }
                    else if(Number.isFinite(parseFloat(val))) {
                      $(this).val(parseFloat(val).toFixed(2));
                    }
                    else if(val.indexOf("$") >= 0) {
              				val = parseFloat(val.replace('$','')).toFixed(2);
              				if(Number.isFinite(parseFloat(val))) {
              					$(this).val(val);
              				}
                    }
                    else {
                      validation = false;
                      alert("Vous devez entrer un prix valide.");
                      location.href = "http://10.0.1.18";
                    }
                });
                if(validation === true) $('#formulaire-plans').submit();
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