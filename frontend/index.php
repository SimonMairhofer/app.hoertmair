<?php

    require_once('controller.php');
    require_once('../entities/db.php');
    require_once('../entities/buchungsinfo.php');

    $aktion = isset($_GET['aktion'])?$_GET['aktion']:'startseite';

    $controller = new Controller();

   if(method_exists($controller, $aktion)){
      $controller->run($aktion);
   }

?>
