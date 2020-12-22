<?php


class Controller{


  public function run($aktion){

    $this->generatePage($aktion);
  }

  private function generatePage($template){
    require_once 'views/'.$template.".tpl.html";
  }

  private function appartement1(){

  }

  private function startseite(){

  }

}


 ?>
