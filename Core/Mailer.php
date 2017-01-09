<?php

class Mailer
{
    private $message;

    // $from = 'no-reply@gsb.fr'
    public function __construct($to, $subject, $body, $from = "team.gsble@gmail.com", $options = array())
    {
        $this->message = Swift_Message::newInstance();
        $this->message->setTo($to);
        $this->message->setFrom($from);
        $this->message->setSubject($subject);
        $this->message->setBody($body);
        if(isset($options['cc'])) {
            $this->message->setCc($options['cc']);
        }
        if(isset($options['bcc'])) {
            $this->message->setBcc($options['bcc']);
        }
    }

    public function send()
    {
        $transport = Swift_SmtpTransport::newInstance("smtp.gmail.com", 465, 'ssl');
        $transport->setUsername("team.gsble@gmail.com");
        $transport->setPassword("riveton42");
        $mailer  = Swift_Mailer::newInstance($transport);
        $mailer->send($this->message);
    }
} 