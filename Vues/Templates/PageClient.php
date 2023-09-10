<?php declare(strict_types=1);
require_once "Controlleurs/fonctions_php.php";

class PageClient {

  public function __construct(Gestionnaire $obj, Client $obj_client, Plan $plan, array $plans) {

    $prenom_utilisateur = htmlentities($obj->get_prenom());
    $nom_utilisateur = htmlentities($obj->get_nom());

    $id_client = $obj_client->get_id();
    $prenom_client = htmlentities($obj_client->get_prenom());
    $nom_client = htmlentities($obj_client->get_nom());
    $adresse = htmlentities($obj_client->get_adresse());
    $telephone = $obj_client->get_telephone();
    if($telephone === 0) $telephone = '';
    $courriel = htmlentities($obj_client->get_courriel());
    $personne_client = $obj_client->get_personne();
    $adhesion = htmlentities($obj_client->get_adhesion());
    $plan_id = $obj_client->get_plan();
    $renouvellement = htmlentities($obj_client->get_renouvellement());
    $fin_abonnement = htmlentities($obj_client->get_fin_abonnement());
    $fin_acces_appareils = htmlentities($obj_client->get_fin_acces_appareils());
    $heures_specialistes = $obj_client->get_heures_specialistes();
    $heures_specialistes_utilise = $obj_client->get_heures_specialistes_utilise();
    $cours_groupe_semaine = $obj_client->get_cours_groupe_semaine();

    $plan_nom = htmlentities($plan->get_nom());
    $date = strtotime('now');

?>

    <!DOCTYPE HTML>
    <html lang='fr'>

    <head>

      <?php
        require "Composantes/head.html";
      ?>

      <script>
        // Pour insertion dans la base de données.
        var telephone_bd;
      </script>

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
          COMPTE CLIENT
        </div>

        <?php if($id_client > 0 && $personne_client === $id_client): ?>
          <form id="supprimer-form" class="hidden" action="<?php echo URL; ?>" method="post">
            <input type="hidden" id="formulaire-supprimer-client" name="formulaire-supprimer-client" value="oui">
            <input type="hidden" id="client-personne" name="client-personne" value="<?php echo $personne_client; ?>">
            <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button id="supprimer-client" title="Supprimer le compte client">
              <i class="fa-solid fa-trash"></i>
            </button>
          </form>
        <?php endif; ?>

          <div class="demi-gauche">
              <form id="formulaire-gauche" action="<?php echo URL; ?>" method="post">
                <?php if($id_client > 0): ?>
                  <input type="hidden" id="client-id" name="client-id" value="<?php echo $id_client; ?>">
                <?php endif; ?>
                <input class="input-client" type="text" id="client-prenom" name="client-prenom" placeholder="prénom" value="<?php echo $prenom_client; ?>">
                <input class="input-client" type="text" id="client-nom" name="client-nom" placeholder="nom" value="<?php echo $nom_client;?>">
                <input class="input-client" type="text" id="client-adresse" name="client-adresse" placeholder="adresse" value="<?php echo $adresse; ?>">
                <input class="input-client" type="text" id="client-telephone" name="client-telephone" placeholder="téléphone (xxx) xxx-xxxx" value="<?php echo $telephone; ?>">
                <input class="input-client" type="text" id="client-courriel" name="client-courriel" placeholder="courriel" value="<?php echo $courriel; ?>">
                <input type="hidden" id="formulaire-client-personne" name="formulaire-client-personne" value="oui">
                <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <input class="couleurs submit-client" id="maj-personne" type="submit" value="METTRE À JOUR" onclick="return false;">
              </form>
          </div>

          <div class="demi-droite">

            <?php if($id_client > 0): ?>
              <div id="info-plan" class="info-plan">
                <div>
                  Date d'adhésion: <span><?php echo date_francais($adhesion, "j F Y"); ?></span>
                </div>
                <div>
                  Plan: <span><?php echo $plan_nom; ?></span>
                </div>
                <div>
                  Date de renouvellement: <span><?php echo date_francais($renouvellement, "j F Y"); ?></span>
                </div>

                <?php if($date > strtotime($fin_abonnement)): ?>
                  <div>
                    Fin de l'abonnement: <span class="notif-date-ex"><?php echo date_francais($fin_abonnement, "j F Y"); ?></span>
                  </div>
                <?php elseif($date >= strtotime($fin_abonnement." -29 days") && $date <= strtotime($fin_abonnement)): ?>
                  <div>
                    Fin de l'abonnement: <span class="notif-date-30"><?php echo date_francais($fin_abonnement, "j F Y"); ?></span>
                  </div>
                <?php else: ?>
                  <div>
                    Fin de l'abonnement: <span class="notif-date-ok"><?php echo date_francais($fin_abonnement, "j F Y"); ?></span>
                  </div>
                <?php endif; ?>

                <?php if($date > strtotime($fin_acces_appareils)): ?>
                  <div>
                    Fin de l'accès aux appareils: <span class="notif-date-ex"><?php echo date_francais($fin_acces_appareils, "j F Y"); ?></span>
                  </div>
                <?php elseif($date >= strtotime($fin_acces_appareils." -29 days") && $date <= strtotime($fin_acces_appareils)): ?>
                  <div>
                    Fin de l'accès aux appareils: <span class="notif-date-30"><?php echo date_francais($fin_acces_appareils, "j F Y"); ?></span>
                  </div>
                <?php else: ?>
                  <div>
                    Fin de l'accès aux appareils: <span class="notif-date-ok"><?php echo date_francais($fin_acces_appareils, "j F Y"); ?></span>
                  </div>
                <?php endif; ?>

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


              <div class="modif-plan">
                <form id="formulaire-droite" action="<?php echo URL; ?>" method="post">
                  <?php if($id_client > 0 && $personne_client === $id_client): ?>
                    <input type="hidden" id="client-personne" name="client-personne" value="<?php echo $personne_client; ?>">
                  <?php endif; ?>
                  <select id="plan-id" name="plan-id">
                    <?php foreach ($plans as $p) {
                      $p_id = $p->get_id();
                      $p_nom = htmlentities($p->get_nom());
                      $p_prix = $p->get_prix();
                      $p_prix_cours_groupe = $p->get_prix_cours_groupe();
                      if($date < strtotime($fin_abonnement." -29 days") && strpos($p->get_nom(),"Spécialiste") == '') continue;
                    ?>
                      <option
                        data-prix="<?php echo $p_prix; ?>"
                        data-prix-groupe="<?php echo $p_prix_cours_groupe; ?>"
                        value="<?php echo $p_id; ?>"><?php echo $p_nom." ( "; ?>
                        <?php
                          if($p_prix > 0 && $p_prix_cours_groupe > 0) echo $p_prix."$ | ";
                          else if($p_prix == 0 && $p_prix_cours_groupe > 0) echo "";
                          else echo $p_prix."$";
                        ?>
                        <?php if($p_prix_cours_groupe > 0) echo "1 cours de groupe/sem: ".$p_prix_cours_groupe."$"; ?>
                        <?php echo " )"; ?>
                      </option>
                    <?php } ?>

                  </select>

                  <?php if($date < strtotime($fin_abonnement." -29 days")): ?>
                    <div id="options-texte">Les autre options seront disponible à moins de 30 jours du renouvellement.</div>
                  <?php else: ?>
                    <label id="client-groupes-label" for="client-groupes">
                      Nombre de cours de groupes par semaine:
                    </label>
                    <input type="text" class="input-plan" id="client-groupes" name="client-groupes">
                  <?php endif; ?>

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
                  <input class="nouveau-client" type="hidden" id="formulaire-nouveau-client" name="formulaire-nouveau-client" value="non" disabled>
                  <input type="hidden" id="formulaire-client-plan" name="formulaire-client-plan" value="oui">
                  <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                  <input id="bouton-ajouter" type="submit" class="couleurs submit-client" value="AJOUTER" onclick="return false;">
                </form>
              </div>
          </div>

          <script>
            $( document ).ready(function() {

              function afficher_heures_specialistes_seulement() {
                let nom = $("#plan-id option:selected").text();
                if (nom.indexOf("Spécialiste") >= 0){
                  $('#client-groupes, #client-groupes-label').css('visibility','hidden');
                  $('#client-groupes').val(0);
                }
                else $('#client-groupes, #client-groupes-label').css('visibility','visible');
              }

              // Pour vérifier si on affiche seulement les options spécialistes dans le cas ou on est a plus de 30 jours du renouvellement
              // lors du chargement initual de la page.
              afficher_heures_specialistes_seulement();

              $( document ).tooltip({
                 classes: {
                   "ui-tooltip": "ui-corner-all"
                 }
               });

              $('#supprimer-client').click(function(){
                confirm('Êtes-vous certain de vouloir supprimer ce compte client?');
              });

              // Active les champs hidden du formulaire pour les nouveaux clients et désactiver les hidden inputs
              // qui identifient les formulaires pour les clients existants.
              if($('#nouveau-client').length){
              	$('#maj-personne').css('visibility','hidden');
                $('#formulaire-client-personne').attr('disabled','disabled');
                $('#formulaire-client-personne').val('non');
                $('#formulaire-client-plan').attr('disabled','disabled');
                $('#formulaire-client-plan').val('non');
                $('.nouveau-client').removeAttr('disabled');
                $('#formulaire-nouveau-client').val('oui');
              }

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

              $('#client-courriel').change(function(){
        				if(!validateEmail($(this).val())) {
        					alert('Le format du courriel doit être valide.');
        					$(this).val('');
        				}
        			});

              // Change le format du numéro au chargement initial de la page.
              $('#client-telephone').val(formatTelephone($('#client-telephone').val())).change();

              // Cache l'option pour le nombre de cours de groupes lorsqu'un plan Spécialiste seulement est choisi.
              $('#plan-id').change(function(){
                afficher_heures_specialistes_seulement();
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
                let message_zero = "Svp vérifier le plan choisi, le nombre d'heures avec un spécialiste et le nombre de cours de groupe avant de poursuivre.";

                if($('#nouveau-client').length) {
                  $('input').each(function(){
                      if($(this).val() === '') {
                        validation = false;
                        $(this).css('background-color','orange');
                      }
                  });
                  if(validation === false) alert('Tous les champs doivent être remplis');
                  else {
                    if($('#client-payer').val() == 0) {
                      alert(message_zero);
                    }
                    else {
                      let nouveau_tel = $('#nouveau-telephone').val();
                      nouveau_tel = nouveau_tel.replace(' ','').replace('(','').replace(')','').replace('-','');
                      $('#nouveau-telephone').val(nouveau_tel);
                      $('#formulaire-droite').submit();
                    }
                  }
                }
                else {
                  $('#formulaire-droite :input').each(function(){
                      if($(this).val() === '' && $(this).prop('disabled') === false) {
                        validation = false;
                        //alert($(this).attr('id'));
                        $(this).css('background-color','orange');
                      }
                  });
                  if(validation === false) alert('Tous les champs concernant le plan doivent être remplis');
                  else {
                    if($('#client-payer').val() == 0) {
                      alert(message_zero);
                    }
                    else $('#formulaire-droite').submit();
                  }
                }
              });

              $('#maj-personne').click(function(){
                let validation = true;
                $("#formulaire-gauche :input").each(function(){
                    if($(this).val() === '') {
                      validation = false;
                      $(this).css('background-color','orange');
                    }
                });
                if(validation === false) alert('Les champs prénom, nom, adresse, téléphone et courriel doivent être remplis');
                else {
                  let nouveau_tel = $('#client-telephone').val();
                  nouveau_tel = nouveau_tel.replace(' ','').replace('(','').replace(')','').replace('-','');
                  $('#client-telephone').val(nouveau_tel);
                  $('#formulaire-gauche').submit();
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
