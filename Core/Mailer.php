<?php

class Mailer
{
    private $to;
    private $from;
    private $cc;
    private $mime = "1.0";
    private $contentType = "text/html";
    private $subject;
    private $body;


    public function __construct($to, $subject, $body, $from = 'no-reply@gsb.fr', $cc = null)
    {
        $this->to = $to;
        $this->from = $from;
        $this->cc = $cc;
        $this->subject = $subject;
        $this->body = $body;
        $this->subject = $subject;
    }

    private function getHeader()
    {
        $header = 'From:'.$this->from.' \r\n';
        if ($this->cc) {
            $header .= "Cc:'.$this->cc.' \r\n";
        }

        $header .= "MIME-Version: '.$this->mime.'\r\n";
        $header .= "Content-type: '.$this->contentType.'\r\n";

        return $header;
    }

    public function send()
    {
        ini_set('sendmail_from', 'bruno.avinint@gmail.com');
        $retval = mail ($this->to,$this->subject,$this->body,$this->getHeader());
        if( $retval == true ) {
            echo "Message sent successfully...";
            die();
        }else {
            echo "Message could not be sent...";
            die();
        }
    }
} 