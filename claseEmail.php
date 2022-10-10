<?php

require $_SERVER['DOCUMENT_ROOT'] . "/wp-includes/class-phpmailer.php";

class send_mail {

    public $phpMailer;
    private $from = "pcs@pcspucv.cl";
    private $fromName = "Programa Calidad de Servicio";
    private $repliTo = array();
    private $sendTo = array();
    private $CC = array(); 
    public $enableSend = true;
    public $subject = "Titulo";
    public $body = "<div></div>";
    

    public function __construct() {

        $this->phpMailer = new PHPMailer();

        $this->phpMailer->CharSet = "UTF-8";
        $this->phpMailer->isHTML();
        $this->phpMailer->isSMTP();
        $this->phpMailer->SMTPAuth = false;
        $this->phpMailer->Host = "ftp.pcspucv.cl";
        $this->phpMailer->Mailer = "smtp";
        $this->phpMailer->Port = 25;
    }

    function sendEmail() {

        if (sizeof($this->CC) > 0) {
            $this->CC = array_unique($this->CC);
            foreach ($this->CC as $value) {
                $this->phpMailer->addCC($value);
            }
        }

        if (sizeof($this->sendTo) > 0) {
            $this->sendTo = array_unique($this->sendTo);
            foreach ($this->sendTo as $value) {
                $this->phpMailer->addAddress($value);
            }
        }

        if (sizeof($this->replyTo) > 0) {
            $this->replyTo = array_unique($this->replyTo);
            foreach ($this->replyTo as $value) {
                $this->phpMailer->addReplyTo($value);
            }
        }

        $this->phpMailer->From = $this->from;
        $this->phpMailer->FromName = $this->fromName;

        $this->phpMailer->Subject = $this->subject;
        $this->phpMailer->Body = $this->body;

        if ($this->enableSend) {
            $this->phpMailer->send();
        }
    }
    
    function prepareMail() {
        $this->phpMailer->setFrom("john.cerda@alumnos.upla.cl");
        $this->phpMailer->addReplyTo($address);
        
    }

}
?>
