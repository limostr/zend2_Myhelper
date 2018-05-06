<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 21/03/2018
 * Time: 11:05
 */

namespace Myhelper;
use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class MailSender
{

    public $MessageContent;

    public function sendMail($MessageContext){

       // $socket = fsockopen("ssl://smtp.gmail.com", 465, $errno,  $errstr, 10);



        try {
            $options = new Mail\Transport\SmtpOptions(array(
                'name' => 'smtp.gmail.com',
                'host' => 'smtp.gmail.com',
                'port' => 587,
                'connection_class' => 'login',
                'connection_config' => array(
                    'username' => 'inscriptionuvt@gmail.com',
                    'password' => 'uvt_scolarite(125)',
                    'ssl' => 'tls',
                ),
            ));


            $content = \Myhelper\Template::GenView("Mail/invite", 'layouts/adminlte/map_template.php',
                $MessageContext
               /* array('nom' => "Oussama"
                , "prenom" => "Limam"
                , "link" => "www.uvt.rnu.tn"
                , "contextMail" => "Test contextMail"
                , "EmailText" => "Test EmailText"
                , "textToGetLink" => "Test Link url"
                )*/);
 //           echo $content;

// make a header as html
            $html = new MimePart($content);
            $html->type = "text/html";
            $body = new MimeMessage();
            $body->setParts(array($html));
// instance mail
            $mail = new Mail\Message();
            $mail->setBody($body); // will generate our code html from template.phtml
            //sender email, sender name
            $mail->setFrom('oussama.limam@gmail.com', 'Oussama Limam Sender');
            $mail->setTo('oussama.limam@gmail.com');
            $mail->setSubject('Test sujet');
           echo "sending  <br>$content";
            $transport = new Mail\Transport\Smtp($options);
            $v=$transport->send($mail);
            echo "sending OK";
            echo "ce mail à été envoyé : <br>$content";
        }catch (\Exception $e){
            echo  $e->getMessage();
        }
    }

}