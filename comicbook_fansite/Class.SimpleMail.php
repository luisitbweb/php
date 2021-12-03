<?php
class SimpleMail{
    // classe propriedade parte de uma mensagem
    private $toAddress;
    private $CCAddress;
    private $BCCAddress;
    private $fromAddress;
    private $subject;
    private $sendText;
    private $textBody;
    private $sendHTML;
    private $HTMLBody;
    
    // inicializar a parte mensagem com espaco em branco ou valor padrao
    public function __construct(){
        $this->toAddress = '';
        $this->CCAddress = '';
        $this->BCCAddress = '';
        $this->fromAddress = '';
        $this->subject = '';
        $this->sendText = TRUE;
        $this->textBody = '';
        $this->sendHTML = FALSE;
        $this->HTMLBody = '';
    }
    
    // definir To enderoço
    public  function setToAddress($value){
        $this->toAddress = $value;
    }
    
    // defina CC endereço
    public function setCCAddress($value){
        $this->CCAddress = $value;
    }
    
    // defina BCC endereço
    public function setBCCAddress($value){
        $this->BCCAddress = $value;
    }
    
    // defina from endereço
    public function setFromAddress($value){
        $this->FromAddress = $value;
    }
    
    // defina mensagem subject
    public function setSubject($value){
        $this->subject = $value;
    }
    
    // defina outro envio email para text
    public function setSentText($value){
        $this->sendText = $value;
    }
    
    // defina Text email mensagem body
    public function setTextBody($value){
        $this->sendText = TRUE;
        $this->textBody = $value;
    }
    
    // defina outro envio de email para HTML
    public function setSendHTML($value){
        $this->sendHTML = $value;
    }
    
    // defina text HTML mensagem body
    public function setHTMLBody($value){
        $this->sendHTML = TRUE;
        $this->HTMLBody = $value;
    }
    
    // envio email
    public function send($to = NULL, $subject = NULL, $message = NULL, $headers = NULL){
        
        $success = FALSE;
        if(!is_null($to) && !is_null($subject) && !is_null($message)){
            $success = mail($to, $subject, $message, $headers);
            return $success;
        }else {
            $headers = array();
            if(!empty($this->fromAddress)){
                $headers[] = 'From: ' . $this->fromAddress;
            }
            if(!empty($this->CCAddress)){
                $headers[] = 'CC: ' . $this->CCAddress;
            }
            if (!empty($this->BCCAddress)){
                $headers[] = 'BCC: ' . $this->BCCAddress;
            }
            if (!empty($this->sendText && !$this->sendHTML)){
                $message = $this->textBody;
            }elseif (!$this->sendText && $this->sendHTML) {
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset="UTF-8"';
                $headers[] = 'Content-Transfer-Encoding: 7bit';
                $headers   = $this->HTMLBody;
            }elseif ($this->sendText && $this->sendHTML) {
                $boundary  = '==MP_Bound_xyccr948x==';
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: multipart/alternative; boundary="' . $boundary . '"';
                $message   = 'This is a Multipart Message in MIME format.' . "\n";
                $message  .= '__' . $boundary . "\n";       
                $message  .= 'Content-type: text/plain; charset="UTF-8"' . "\n";
                $message  .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
                $message  .= $this->textBody . "\n";
                $message  .= '__' . $boundary . "\n";
                $message  .= 'Content-type: text/html; charset="UTF-8"' . "\n";
                $message  .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
                $message  .= $this->HTMLBody . "\n";
                $message  .= '__' . $boundary . '__';
            }
            
            $success = mail($this->toAddress, $this->subject, $message, join("\r\n", $headers));
            return $success;
        }
    }
}