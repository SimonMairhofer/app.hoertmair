<?php

    require_once('controller.php');

    $aktion = isset($_GET['aktion'])?$_GET['aktion']:'startseite';

    $controller = new Controller();

   if(method_exists($controller, $aktion)){
      $controller->run($aktion);
   }else{
     $controller->run($aktion);
   }

?>
