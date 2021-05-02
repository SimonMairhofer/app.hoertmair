<?php
class Funktionen{


    public static function send_email($anfrage)
    {
        require_once 'PHPMailer-master/src/PHPMailer.php';

        $subject = strip_tags('Anfrage für das Appartement: ' . $anfrage["appartement"]);
        $message = strip_tags($_POST['Id:'. $this->id .', Vorname: '.$this->vorname.', Nachname: '.$this->nachname.', Strasse: '.$this->strasse.', OrtPLZ: '.$this->ortPLZ.', Email: '.$this->email.', Telefon: '.$this->telefon.', Anreise:'.$this->anreise.', Abreise: '.
        $this->abreise.', AnzErwachsene: '.$this->anzErwachsene.', AnzKinder: '.$this->anzKinder.', Appartement: '.$this->appartement.', Anfragen: '.$this->anfragen]);//$_POST['message']

                $mailer = new \PHPMailer\PHPMailer\PHPMailer();
                $mail = "emailvonKlient";

                $to = strip_tags($mail);

                $mailer->From = $anfrage["email"];
                $mailer->FromName = $anfrage["vorname"]. " " .$anfrage["nachname"];
                $mailer->addAddress($to,  "Appartemet Hörtmair");
                $mailer->Subject = $subject;
                $mailer->CharSet = "UTF-8";
                $mailer->Body = $message;


                if (!$mailer->send()) {
                    $_SESSION["Info_mail"] = "Fehler beim versenden ihrer Email!";
                } else {
                    $_SESSION["Info_mail"] = "Deine Email wurde erfolgreich versendet!";
                }
    }

    public static function send_bestaetigungs_email($kursId, $token) {
        require_once 'PHPMailer-master/src/PHPMailer.php';

        error_reporting(E_ALL);
        $kurs = Kurs::finde($kursId);
        $teilnehmer = Teilnehmer::findeNachToken($token);

        $subject = strip_tags('Anmeldung bei: '.$kurs->getTitel());
        $message = strip_tags('Hiermit wird die Anmeldung zu '.$kurs->getTitel().' am '.$kurs->getDatum().' von '.$kurs->getVon().' bis '.$kurs->getBis().' im Raum/Ort '.$kurs->getOrt_raum().' bestätigt.');//$_POST['message']



        $mailer = new \PHPMailer\PHPMailer\PHPMailer();
        $mail = $teilnehmer->getEmail();

        $to = strip_tags($mail);

        $mailer->From = "sekretariat@berufsschule.bz";
        $mailer->FromName = "LBSHI Schule";
        $mailer->addAddress($to, $teilnehmer->getVorname()." ".$teilnehmer->getNachname());
        $mailer->Subject = $subject;
        $mailer->CharSet ="UTF-8";
        $mailer->Body = $message."\n \n Anmeldung ändern unter:\n ".M_URL."/".M_URLUNTERORDNER."/index.php?token=".$teilnehmer->getToken()."&aktion=login";

        if (!$mailer->send()) {
            $_SESSION["Info_mail"] = "Fehler beim versenden ihrer Email!";
        }else{
            $_SESSION["Info_mail"] = "Deine Email wurde erfolgreich versendet!";
        }
    }



}











 ?>
