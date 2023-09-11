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

        <button id="changer-mdp" class="couleurs quitter">
          CHANGER LE<br>
          MOT DE PASSE
        </button>

        <button id="annuler-mdp" class="couleurs quitter">
          ANNULER LE<br>
          CHANGEMENT
        </button>

        <div class="titre">
          SYSTÈME DE GESTION
        </div>

        <form id="auth-formulaire" action="<?php echo URL; ?>" method="post">
          <input class="auth auth-courriel" type="text" id="auth-email" name="auth-courriel" placeholder="courriel">
          <input class="auth auth-mdp" type="password" id="auth-mdp" name="auth-mdp" placeholder="mot de passe">
          <input class="auth auth-mdp-changer" type="password" id="auth-mdp-changer" name="auth-mdp-changer" placeholder="nouveau mot de passe" disabled>
          <!-- <input class="auth auth-mdp-confirmer" type="password" id="auth-mdp-confirmer" name="auth-mdp-confirmer" placeholder="confirmer le nouveau mot de passe" disabled> -->
          <input id="auth-soumettre" class="auth auth-submit couleurs" type="submit" value="OUVRIR UNE SESSION" onclick="return false;">
        </form>

        <script>
            $( document ).ready(function() {
              $( "#changer-mdp" ).click(function(){
                $('#changer-mdp').css('display','none');
                $('#annuler-mdp').css('display','inline-block');
                $('#auth-mdp-changer').css('display','inline-block');
                //$('#auth-mdp-confirmer').css('display','inline-block');
                $('#auth-mdp-changer').removeAttr('disabled');
                //$('#auth-mdp-confirmer').removeAttr('disabled');
                $('#auth-mdp-changer').val('');
                //$('#auth-mdp-confirmer').val('');
                $('#auth-soumettre').css('top','45vw');
                $('#auth-soumettre').val('CHANGER LE MOT DE PASSE');
              });

              $( "#annuler-mdp" ).click(function(){
                $('#annuler-mdp').css('display','none');
                $('#changer-mdp').css('display','inline-block');
                $('#auth-mdp-changer').css('display','none');
                //$('#auth-mdp-confirmer').css('display','none');
                $('#auth-mdp-changer').val('');
                //$('#auth-mdp-confirmer').val('');
                $('#auth-mdp-changer').prop('disabled','true');
                //$('#auth-mdp-confirmer').prop('disabled','true');
                $('#auth-soumettre').css('top','30vw');
                $('#auth-soumettre').val('OUVRIR UNE SESSION');
              });

              $('#auth-soumettre').click(function(){
                let validation = true;
                $("#auth-formulaire").children().each(function(){
                    if($(this).val() === '' && $(this).prop('disabled') === false) {
                      validation = false;
                      $(this).css('background-color','orange');
                    }
                });
                if(validation === false) alert('Tous les champs sont requis.');
                else {
                  /*if($('#auth-mdp-changer').prop('disabled') === false
                      && $('#auth-mdp-confirmer').prop('disabled') === false
                      && $('#auth-mdp-changer').val() !== $('#auth-mdp-confirmer').val()) {
                        $('#auth-mdp-changer').val('');
                        $('#auth-mdp-confirmer').val('');
                        alert('La confirmation du nouveau mot de passe ne correspond pas. Veuillez essayer de nouveau.');
                      }
                  else*/ if($('#auth-mdp-changer').prop('disabled') === false
                /*&& $('#auth-mdp-confirmer').prop('disabled') === false */) {

                      let confirmation = prompt('Veuillez confirmer le nouveau mot de passe:');
                      if(confirmation === $('#auth-mdp-changer').val()) {
                        let nombre = /([0-9])/;
                      	let minuscule = /([a-z])/;
                        let majuscule = /([A-Z])/;
                      	let caracteres = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
  	                    let mot_passe = $('#auth-mdp-changer').val().trim();

                        if (mot_passe.length < 8) {
                          $('#auth-mdp-changer').val('');
                          //$('#auth-mdp-confirmer').val('');
                      		alert('Le nouveau mot de passe doit contenir au moins 8 caractères.');
                      	} else {
                      		if (mot_passe.match(nombre) && mot_passe.match(minuscule) && mot_passe.match(majuscule) && mot_passe.match(caracteres)) {
                      			$( "#auth-formulaire" ).submit();
                      		}
                      		else {
                            $('#auth-mdp-changer').val('');
                            //$('#auth-mdp-confirmer').val('');
                      		  alert('Le nouveau mot de passe doit contenir au moins un chiffre, une lettre minuscule, une lettre majuscule et un caratère spécial.');
                      		}
                      	}
                      }
                    	else alert('La confirmation du nouveau mot de passe ne correspond pas. Veuillez essayer de nouveau.');
                  }
                  else {
                    $( "#auth-formulaire" ).submit();
                  }
                }
              });

              $('input, select').click(function(){
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
