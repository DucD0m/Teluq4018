<?php

function redirection() {
  // POST REDIRECT GET pattern
  header('Location: ' . URL . '', true, 303);
  exit;
}

?>
