<?php

function redirection() {
  // POST REDIRECT GET pattern
  header('Location: http://10.0.1.18', true, 303);
  exit;
}

?>
