<?php

namespace Source\Support;

use Source\Models\CreditCard;

/**
 * Description of Payment
 *
 * @author Administrator
 */
class Payment 
{
    private $apiUrl;
    private $apikey;
    private $endpoint;
    private $build;
    private $callback;
    
    public function __construct() {
        $this->apiUrl = "https://api.pagar.me/1";
        $this->apikey = PAGARME_API_KEY;
    }
    
    public function createCard(string $holder_name, string $card_number, string $expiration_date, int $cvv): Payment
    {
        $this->endpoint = "/cards";
        $this->build = [
            "holder_name" => $holder_name,
            "number" => $card_number,
            "expiration_date" => $expiration_date,
            "cvv" => $cvv
        ];
        
        $this->post();
        return $this;
    }
    
    public function withCard(int $orderId, CreditCard $card, string $amount, int $installments): Payment
    {
        $this->endpoint = "/transactions";
        $this->build = [
            "payment_type" => "credit_card",
            "amount" => ($amount * 100),
            "installments" => $installments,
            "card_id" => $card->hash,
            "metadata" => [
                "orderId" => $orderId
            ]
        ];
        
        $this->post();
        return $this;
    }
    
    public function callback()
    {
        return $this->callback;
    }
    
    private function post()
    {
        $url = $this->apiUrl . $this->endpoint;
        $api = ["api_key" => $this->apikey];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array_merge($this->build, $api)));
        curl_setopt($ch, CURLOPT_HTTPHEADER, []);
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }
}
