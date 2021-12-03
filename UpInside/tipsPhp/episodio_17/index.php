<?php

require __DIR__ . "/vendor/autoload.php";

use Source\Models\User;
use PagarMe\Client;
use Source\Models\CreditCard;
use Source\Support\Payment;

$client = (new User())->findById(1);
$pagarme = new Client(PAGARME_API_KEY);

$newCard = false;
if ($newCard) {
    $getCreditCard = $pagarme->cards()->create([
        'holder_name' => 'Yoda',
        'number' => '4024007106298036',
        'expiration_date' => '0221',
        'cvv' => '353'
    ]);
}

if (!$getCreditCard->valid) {
    echo "<h3>Cartão inválido!</h3>";
} else {
    $createCreditCard = new CreditCard();
    $createCreditCard->user = $client->id;
    $createCreditCard->hash = $getCreditCard->id;
    $createCreditCard->brand = $getCreditCard->brand;
    $createCreditCard->last_digits = $getCreditCard->last_digits;
    $createCreditCard->save();
}

$newTransaction = false;
if ($newTransaction) {
    $creditCard = (new CreditCard())->findById(1);
    $transaction = $pagarme->transactions()->create([
        "amount" => (55.80 * 100),
        "card_id" => $creditCard->hash,
        "metadata" => [
            "orderId" => 1555
        ]
    ]);

    var_dump($transaction);
}

$pay = new Payment();
$pay->createCard(
        "Yoda",
        "4024007106298036",
        "0221",
        "353",
);

if ($pay->callback()->valid) {
    echo "<h1>Cartão Obtido:</h1>";

    $pay->withCard(
            1250,
            (new CreditCard())->findById(1),
            1230.4,
            2
    );
    
    var_dump($pay->callback());
    if($pay->callback()->status == "paid"){
        echo "<h2>Liberar Pedido</h2>";
    }
}