<?php

ob_start();

require "../vendor/autoload.php";

if (empty($_SESSION["userLogin"])){
    echo "<h1>Guest</h1>";
    
    /**
     * AUTH FACEBOOK
     */
    $facebook = new \League\OAuth2\Client\Provider\Facebook([
        'clientId' => FACEBOOK["app_id"],
        'clientSecret' => FACEBOOK["app_secret"],
        'redirectUri' => FACEBOOK["app_redirect"],
        'graphApiVersion' => FACEBOOK["app_version"],
    ]);
    
    $authUrl = $facebook->getAuthorizationUrl([
        "scope" => ["email"]
    ]);
    
    $error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED);
    if($error){
        echo "<h4>Você precisa autorizar para continuar!!!</h4>";
    }
    
    $code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED);
    if($code){
        $token = $facebook->getAccessToken("authorization_code", [
            "code" => $code
        ]);
        
        $_SESSION["userLogin"] = $facebook->getResourceOwner($token);
        header("Refresh: 0");
    }
    
    echo "<a title='FB Login' href='{$authUrl}'>Facebook Login</a>";
    
}else{
    /**
     * @var $user \League\OAuth2\Client\Provider\FacebookUser
     */
    $user = $_SESSION["userLogin"];
    echo "<img width='120' alt='' src='{$user->getPìctureUrl()}/><h1>Bem-Vindo(a) {$user->getFirstName()}</h1>";
        
    var_dump($user);
    
    echo "<a title='Sair' href='off=true'>Sair</a>";
    $off = filter_input(INPUT_GET, "off", FILTER_VALIDATE_BOOLEAN);
    if($off){
        unset($_SESSION["userLogin"]);
        header("Refresh: 0");
    }
}

ob_end_flush();