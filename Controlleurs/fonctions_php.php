<?php

function redirection() {
  // POST REDIRECT GET pattern
  header('Location: ' . URL . '', true, 303);
  exit;
}

// Conversion des dates en français.
function date_francais($date, $format)
{
    $anglais_jours = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $francais_jours = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $anglais_mois = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $francais_mois = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($anglais_mois, $francais_mois, str_replace($anglais_jours, $francais_jours, date($format, strtotime($date) ) ) );
}

?>
