<?php


class Controller{

private $context = array();

  public function run($aktion){
    $this->$aktion();
    $this->generatePage($aktion);
  }

  private function buchen(){
    if(isset($_POST["submit"])){
      $anfrage = array("vorname"=>$_POST["field_0"],"nachname"=>$_POST["field_1"],"strasse"=>$_POST["field_2"],"ortPLZ"=>$_POST["field_3"],"email"=>$_POST["field_4"],"telefon"=>$_POST["field_5"],
      "anreise"=>$_POST["field_6"],"abreise"=>$_POST["field_7"],"anzErwachsene"=>$_POST["field_8"],"anzKinder"=>$_POST["field_9"],"appartement"=>$_POST["field_10"],"anfragen"=>$_POST["textarea_1"])
     $content = new Buchungsinfo($anfrage);
     $content->speichere();
     //Function::send_email($anfrage);
   }
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
    $this->addContext("datum",Buchungsinfo::getDatum());
    $this->addContext("anreiseDatum",Buchungsinfo::getAnreiseDatum());
    $this->addContext("abreiseDatum",Buchungsinfo::getAbreiseDatum());
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
