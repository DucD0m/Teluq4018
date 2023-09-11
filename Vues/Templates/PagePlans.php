<?php declare(strict_types=1);

class PagePlans {

  public function __construct(Gestionnaire $obj, array $plans) {

    $prenom_utilisateur = htmlentities($obj->get_prenom());
    $nom_utilisateur = htmlentities($obj->get_nom());
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
          require "Composantes/retour.php";
        ?>

        <?php
          require "Composantes/quitter.php";
        ?>

        <div class="name">
          <?php echo $prenom_utilisateur." ".$nom_utilisateur." - GESTIONNAIRE DE COMPTE"; ?>
        </div>

        <div class="titre">
          GESTION DES PLANS
        </div>

        <div id="plans-liste">
          <form id="formulaire-plans" action="<?php echo URL; ?>" method="post">
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
                  $p_id = intval($p->get_id());
                  $p_nom = htmlentities($p->get_nom());
                  $p_duree = intval($p->get_duree());
                  if(strpos($p->get_nom(),"Spécialiste") >= 0 && strpos($p->get_nom(),"Spécialiste") != '') {
                    if($p_duree > 1) $type_duree = "heures";
                    else $type_duree = "heure";
                  }
                  else {
                    $type_duree = "mois";
                  }

                  $p_prix = floatval($p->get_prix());
                  if($p_prix == 0) {
                    $p_prix = "N/A";
                    $disabled_prix = "disabled";
                  }
                  else {
                    $p_prix = number_format($p_prix,2)."$";
                    $disabled_prix = "";
                  }

                  $p_acces_appareils = intval($p->get_acces_appareils());
                  if($p_acces_appareils == 1) $p_acces_appareils = "OUI";
                  else $p_acces_appareils = "NON";

                  $p_acces_cours_groupe = intval($p->get_acces_cours_groupe());
                  if($p_acces_cours_groupe == 1) $p_acces_cours_groupe = "OUI";
                  else $p_acces_cours_groupe = "NON";

                  $p_prix_cours_groupe = floatval($p->get_prix_cours_groupe());
                  if($p_prix_cours_groupe == 0) {
                    $p_prix_cours_groupe = "N/A";
                    $disabled_prix_groupe = "disabled";
                  }
                  else {
                    $p_prix_cours_groupe = number_format($p_prix_cours_groupe,2)."$";
                    $disabled_prix_groupe = "";
                  }
                ?>
                <tr>
                  <td class="plans-tr-gauche"><?php echo $p_nom; ?></td>
                  <td><?php echo $p_duree." ".$type_duree; ?></td>
                  <td><?php echo $p_acces_appareils; ?></td>
                  <td><?php echo $p_acces_cours_groupe; ?></td>
                  <td>
                    <input type="hidden" class="plan-id" id="plan-id<?php echo $p_id; ?>" name="plan<?php echo $p_id; ?>[]" value="<?php echo $p_id; ?>">
                    <input class="<?php echo $disabled_prix_groupe; ?>" type="text" id="plan-prix-groupe<?php echo $p_id; ?>" name="plan<?php echo $p_id; ?>[]" value="<?php echo $p_prix_cours_groupe; ?>">
                  </td>
                  <td class="plans-tr-droite"><input type="text" class="<?php echo $disabled_prix; ?>" id="plan-prix<?php echo $p_id; ?>" name="plan<?php echo $p_id; ?>[]" value="<?php echo $p_prix; ?>"></td>
                </tr>
                <?php } ?>
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
                    else if(val == '$') {
                      validation = false;
                      $(this).css('background-color','orange');
                    }
                    else if(val.indexOf("$") >= 0) {
              				val = parseFloat(val.replace('$','')).toFixed(2);
              				if(Number.isFinite(parseFloat(val))) {
              					$(this).val(val);
              				}
                    }
                    else {
                      validation = false;
                      $(this).css('background-color','orange');
                    }
                });
                if(validation === true) {
                  $('html').css('visibility','hidden');
                  $('#formulaire-plans').submit();
                }
                else {
                  alert("Vous devez entrer un prix valide.");
                }
              }
            });
            $('input').click(function(){
              $(this).css('background-color','#FFF');
            });
          });
        </script>

    </body>
    </html>

<?php
  }
}
?>
