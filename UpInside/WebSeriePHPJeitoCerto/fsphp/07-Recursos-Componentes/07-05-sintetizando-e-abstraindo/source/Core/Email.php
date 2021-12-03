<?php

namespace Source\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Description of Email
 *
 * @author luiscarlosss
 */
class Email {

    /**
     *
     * @var type arrya
     */
    private $data;

    /**
     *
     * @var type PHPMailer
     */
    private $mail;

    /**
     *
     * @var type Message
     */
    private $message;

    /**
     * Email Constructor
     */
    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->message = new Message();

        //setup
        $this->mail->isSMTP();
        $this->mail->setLanguage(       CONF_MAIL_OPTION_LANG);
        $this->mail->isHTML(CONF_MAIL_OPTION_HTML);
        $this->mail->SMTPAuth = CONF_MAIL_OPTION_AUTH;
        $this->mail->SMTPSecure = CONF_MAIL_OPTION_SECURE;
        $this->mail->CharSet = CONF_MAIL_OPTION_CHARSET;

        //auth
        $this->mail->Host = CONF_MAIL_HOST;
        $this->mail->Port = CONF_MAIL_PORT;
        $this->mail->Username = CONF_MAIL_USER;
        $this->mail->Password = CONF_MAIL_PASS;
    }

    /**
     *
     * @param string $subject
     * @param string $message
     * @param string $toEmail
     * @param string $toName
     * @return \Source\Core\Email
     */
    public function bootstrap(string $subject, string $message, string $toEmail, string $toName) : Email{

        $this->data = new \stdClass();
        $this->data->subject = $subject;
        $this->data->message = $message;
        $this->data->toEmail = $toEmail;
        $this->data->toName = $toName;
        return $this;
    }

    public function attach(string $filePath, string $fileName): Email{
        $this->data->attach[$filePath] = $fileName;
        return $this;
    }

    /**
     *
     * @param type $fromEmail
     * @param type $fromName
     * @return bool
     */
    public function send($fromEmail = CONF_MAIL_SENDER['address'], $fromName = CONF_MAIL_SENDER["name"]): bool{
        if(empty($this->data)){
            $this->message->error("Error ao enviar, favor verifique os dados!!");
            return false;
        }
        if(!is_mail($this->data->toEmail)){
            $this->message->warning("O e-mail de destinatário não é válido!!");
            return false;
        }
        if(!is_mail($fromEmail)){
            $this->message->warning("O e-mail do remetente não é válido!!");
            return false;
        }

        try {
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->message);
            $this->mail->addAddress($this->data->toEmail, $this->data->toname);
            $this->mail->setFrom($fromEmail, $fromName);

            if(!empty($this->data->attach)){
                foreach ($this->data->attach as $path => $name){
                    $this->mail->addAttachment($path, $name);
                }
            }

            $this->mail->send();
            return true;

        } catch (Exception $exception) {
            $this->message->error($exception->getMessage());
            return false;
        }
    }

    /**
     *
     * @return PHPMailer
     */
    public function mail(): PHPMailer{
        return $this->mail;
    }

    /**
     *
     * @return \Source\Core\Message
     */
    public function message(): Message{
    return $this->message;
    }
}
