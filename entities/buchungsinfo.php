<?php

class Buchungsinfo{

protected $id = 0;
protected $vorname = "";
protected $nachname = "";
protected $strasse = "";
protected $ortPLZ = "";
protected $email = "";
protected $telefon = "";
protected $anreise = "";
protected $abreise = "";
protected $anzErwachsene = "";
protected $anzKinder = "";
protected $appartement = "";
protected $anfragen = " ";

public function __construct($daten = array())
{
    // wenn $daten nicht leer ist, rufe die passenden Setter auf
    if ($daten) {
        foreach ($daten as $k => $v) {
            $setterName = 'set' . ucfirst($k);
            // wenn ein ungültiges Attribut übergeben wurde
            // (ohne Setter), ignoriere es
            if (method_exists($this, $setterName)) {
                $this->$setterName($v);
            }
        }
    }
}

public function  __toString()
{
    return 'Id:'. $this->id .', Vorname: '.$this->vorname.', Nachname: '.$this->nachname.', Strasse: '.$this->strasse.', OrtPLZ: '.$this->ortPLZ.', Email: '.$this->email.', Telefon: '.$this->telefon.', Anreise:'.$this->anreise.', Abreise: '.
    $this->abreise.', AnzErwachsene: '.$this->anzErwachsene.', AnzKinder: '.$this->anzKinder.', Appartement: '.$this->appartement.', Anfragen: '.$this->anfragen;
}

public function toArray($mitId = true)
{
    $attribute = get_object_vars($this);
    if ($mitId === false) {
        // wenn $mitId false ist, entferne den Schlüssel id aus dem Ergebnis
        unset($attribute['id']);
    }
    return $attribute;
}

public function speichere()
{
    if ( $this->getId() > 0 ) {
        // wenn die ID eine Datenbank-ID ist, also größer 0, führe ein UPDATE durch
        $this->_update();
    } else {
        // ansonsten einen INSERT
        $this->_insert();
    }
}

private function _insert()
{
$sql = 'INSERT INTO buchungsinfo ( vorname, nachname, strasse, ortPLZ, email, telefon, anreise, abreise, anzErwachsene, anzKinder, appartement, anfragen)'
     . 'VALUES (:vorname, :nachname, :strasse, :ortPLZ, :email, :telefon, :anreise, :abreise, :anzErwachsene, :anzKinder, :appartement, :anfragen)';

    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute($this->toArray(false));
    // setze die ID auf den von der DB generierten Wert
    $this->id = DB::getDB()->lastInsertId();
}

private function _update()
{
    $sql = 'UPDATE buchungsinfo SET id=:id, vorname=:vorname, nachname=:nachname,alter=:alter,appartement=:appartement,strasse=:strasse,ortPLZ=:ortPLZ,email=:email,email=:email,telefon=:telefon,anreise=:anreise,abreise=:abreise,anzErwachsene=:anzErwachsene,anzKinder=:anzKinder,anfragen=:anfragen WHERE id=:id';
    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute($this->toArray());
}

public function loesche()
{
    //Eintrag löschen
    $sql = 'DELETE FROM buchungsinfo WHERE id=?';
    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute( array($this->getId()) );

    // Objekt existiert nicht mehr in der DB, also muss die ID zurückgesetzt werden
    $this->id = 0;
}

public static function findeAlle()
{
    $sql = 'SELECT * FROM buchungsinfo';
    $abfrage = DB::getDB()->query($sql);
    $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Buchungsinfo');
    return $abfrage->fetchAll();
}

public static function finde($id){
  $sql = 'SELECT * FROM buchungsinfo WHERE id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($id));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Buchungsinfo');
  return $abfrage->fetch();

}

/*
public function getAnreiseDatum(){
  $sql = 'SELECT anreise FROM buchungsinfo WHERE id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($this->getId()));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Buchungsinfo');
  return $abfrage->fetch();
}

public function getAbreiseDatum(){
  $sql = 'SELECT abreise FROM buchungsinfo WHERE id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($this->getId()));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Buchungsinfo');
  return $abfrage->fetch();
}
*/

public function getDatum(){
  $sql = 'SELECT anreise, abreise FROM buchungsinfo';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array());
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Buchungsinfo');
  return $abfrage->fetch();
}
public function getAnreiseDatum(){
  $sql = 'SELECT anreise FROM buchungsinfo';
  $abfrage = DB::getDB()->query($sql);
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Buchungsinfo');
  return $abfrage->fetchAll();
}

public function getAbreiseDatum(){
  $sql = 'SELECT abreise FROM buchungsinfo';
  $abfrage = DB::getDB()->query($sql);
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Buchungsinfo');
  return $abfrage->fetchAll();
}

public function setId($id){
  $this->id = $id;
}
public function getId(){
  return $this->id;
}
public function setVorname($vorname){
  $this->vorname = $vorname;
}
public function getVorname(){
  return $this->vorname;
}
public function setNachname($nachname){
  $this->nachname = $nachname;
}
public function getNachname(){
  return $this->nachname;
}
public function setAlter($alter){
  $this->alter = $alter;
}
public function getAlter(){
  return $this->alter;
}
public function setAppartement($appartement){
  $this->appartement = $appartement;
}
public function getAppartement(){
  return $this->appartement;
}
public function setStrasse($strasse){
  $this->strasse = $strasse;
}
public function getStrasse(){
  return $this->strasse;
}
public function setOrtPLZ($ortPLZ){
  $this->ortPLZ = $ortPLZ;
}
public function getOrtPLZ(){
  return $this->ortPLZ;
}
public function setEmail($email){
  $this->email = $email;
}
public function getEmail(){
  return $this->email;
}
public function setTelefon($telefon){
  $this->telefon = $telefon;
}
public function getTelefon(){
  return $this->telefon;
}
public function setAnreise($anreise){
  $this->anreise = $anreise;
}
public function getAnreise(){
  return $this->anreise;
}
public function setAbreise($abreise){
  $this->abreise = $abreise;
}
public function getAbreise(){
  return $this->abreise;
}
public function setAnzErwachsene($anzErwachsene){
  $this->anzErwachsene = $anzErwachsene;
}
public function getAnzErwachsene(){
  return $this->anzErwachsene;
}
public function setAnzKinder($anzKinder){
  $this->anzKinder = $anzKinder;
}
public function getAnzKinder(){
  return $this->anzKinder;
}
public function setAnfragen($anfragen){
  $this->anfragen = $anfragen;
}
public function getAnfragen(){
  return $this->anfragen;
}






}

?>
