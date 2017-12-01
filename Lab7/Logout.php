<?php
  session_start();

  session_unset($_SESSION['autentificado']);

  session_destroy();

  echo '<script type="text/javascript">window.location.assign("layout.php");</script>';
?>
