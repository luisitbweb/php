<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.05 - Sintetizando e abstraindo");

require __DIR__ . "/source/autoload.php";

/*
 * [ synthesize ]
 */
fullStackPHPClassSession("synthesize", __LINE__);

$email = (new \Souce\Core\Email())->bootstrap(

    "Olá mundo, esse é meu e-mail!",
    "<h1>Olá mundo!</h1><p>Essa é uma mensagem via rotina da aplicação!</p>",
    "robsonvleite@gmail.com",
    "Luis Carlos"
);

$email->attach(__DIR__ . "path arquiv", "name arquivo");
$email->attach(__DIR__ . "path arquiv", "name arquivo");
$email->attach(__DIR__ . "path arquiv", "name arquivo");

if($mail->send()){
    echo message()->success("E-mail enviado com sucesso!");
}else{
    echo $email->message();
}