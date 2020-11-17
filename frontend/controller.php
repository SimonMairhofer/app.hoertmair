<?php


class Controller{


  public function run($aktion){
    $this->$aktion();
    $this->generatePage($aktion);
  }

  private function generatePage($template){
    extract($this->context);
    require_once 'views/'.$template.".tpl.html";
  }


}


 ?>
