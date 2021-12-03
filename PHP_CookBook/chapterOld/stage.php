<?php

// turn on sessions
//session_start();

$ip = array(
    'REMOTE_ADDR' => null,
    'REMOTE_PROXY' => null,
    'HTTP_CF_CONNECTING_IP' => null
);
if (isset($_SERVER['REMOTE_ADDR'])) {
    $ip['REMOTE_ADDR'] = trim($_SERVER['REMOTE_ADDR']);
}
if (isset($_SERVER['REMOTE_PROXY'])) {
    $ip['REMOTE_PROXY'] = trim($_SERVER['REMOTE_PROXY']);
}
if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip['HTTP_CF_CONNECTING_IP'] = trim($_SERVER['HTTP_CF_CONNECTING_IP']);
}


/*
Aqui você decide qual desses valores deseja consultar.
Comece pelo proxy, pois é o que retorna o "IP real", caso a conexão esteja sendo feita via proxy. Quando um cliente usa um proxy, `REMOTE_ADDR` assume o IP do proxy. Se o proxy for transparente, `REMOTE_PROXY` retornará o IP real do cliente. Isso é também muito útil para pegar "hackerzinho" que usa qualquer proxy pensando estar protegido.
*/
if (!empty($_SERVER['REMOTE_PROXY'])) {
    $rs = $_SERVER['REMOTE_PROXY'];
} else if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $rs = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else {
    $rs = $_SERVER['REMOTE_ADDR'];
}

/*
As vezes o IP pode vir acompanhado de múltiplos IPs.
exemplo: 192.168.0.1, 127.0.0.1
Para detectar esses casos, é recomendado fazer uma verificação:
*/
if (strpos($rs, ', ')) {
    $ips = explode(', ', $rs);
    /*
    Você pode querer checar 1 por 1. Mas isso varia de acordo com a necessidade de cada caso.
    Aqui vamos pegar somente o primeiro do array para simplificar a didática
    */
    $rs = $ips[0];
}

/*
Faz um IP lookup reverse.
Obtém nome do domínio, caso exista.
*/
$dns = gethostbyaddr($rs);

/*
Imprime o IP e o dns
*/
echo $rs.'<br>'.$dns;