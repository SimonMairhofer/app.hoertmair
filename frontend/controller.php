<?php


class Controller{

private $context = array();

  public function run($aktion){
    $this->$aktion();
    $this->generatePage($aktion);
  }

  private function buchen(){
    $content = new Buchungsinfo(array("vorname"=>$_POST[field_0],"nachname"=>$_POST[field_1]),)
    $content->speichere();
    header("Location: index.php?aktion=buchung");
  }

  private function addContext($key,$value){
      $this->context[$key] = $value;
    }

  private function appartement1(){

  }
  private function appartement2(){

  }
  private function buchung(){

  }
  private function preise(){

  }
  private function umgebung(){

  }
  private function startseite(){

  }

  private function generatePage($template){
    extract($this->context);
    require_once 'views/'.$template.".tpl.html";
  }

}


 ?>
