<?php if(isset($_SESSION['message']) && ($_SESSION['message'] != '')): ?>
  <script>
  $( document ).ready(function() {
    alert("<?php echo $_SESSION['message']; ?>");
  });
  </script>
<?php unset($_SESSION['message']); endif; ?>
