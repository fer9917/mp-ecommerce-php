<?php
// Mail plugin
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/autoload.php';

class Mail{
    // Mail vars
    private $host = 'smtp.gmail.com';
    private $pass = 'Gameofthrones1';
    private $user = 'importadorch@gmail.com';

    public function __construct() {
        $this->mail = new PHPMailer(true);

        // Init mail settings
        $this->mail->isSMTP();
        $this->mail->Port = 465;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Host = $this->host;
        $this->mail->Username = $this->user;
        $this->mail->Password = $this->pass;
        // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
    }

    public function send($data){
        try {
            // Validations
            if (empty($data['to'])) {
                return [
                    'error' => true,
                    'message' => 'Se necesita el destinatario [to]',
                ];
            }
            if (empty($data['message'])) {
                return [
                    'error' => true,
                    'message' => 'Se necesita el mensaje [message]',
                ];
            }
            if (empty($data['from'])) {
                $data['from'] = 'importadorch@gmail.com';
            }
            if (empty($data['from_name'])) {
                $data['from_name'] = 'Mercado';
            }

            // Recipients
            $this->mail->addAddress($data['from'], $data['from_name']);
            $this->mail->addAddress($data['to']);
            $this->mail->setFrom($data['from']);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = $data['tittle'];
            $this->mail->Body = $data['message'];

            $this->mail->send();
            
            return true;
        } catch (Exception $e) {
            $error = [
                'error' => true,
                'log' => $e->getMessage(),
                'message' => $this->mail->ErrorInfo,
                'file' => $e->getFile()." #".$e->getLine(),
            ];

            return $error;
        }
    }
}