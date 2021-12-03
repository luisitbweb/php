<?php

// se estivermos utilizando IIS, precisamos configurar $PHP_AUTH_USER e $PHP_AUTH_PW

if (substr($SERVER_SOFTWARE, 0, 9) == 'Microsoft' && !isset($PHP_AUTH_USER) && !isset($PHP_AUTH_PW) && substr($HTTP_AUTHORIZATION, 0, 6) == 'Basic') {
    list($PHP_AUTH_USER, $PHP_AUTH_PW) = explode(':', base64_decode(substr($HTTP_AUTHORIZATION, 6)));
}
// substitua essa instrucao IF por uma consulta a banco de dados ou algo semelhante

if ($PHP_AUTH_USER != 'user' || $PHP_AUTH_PW != 'pass') {
    // o visitante ainda nao forneceu detalhes, ou sua combinacao de nome e senha nao esta correta.

    header('www-authenticate: Basic realm="Realm-Name"');

    if (substr($SERVER_SOFTWARE, 0, 9) == 'Microsoft') {
        header('Status: 401 Unauthorized');
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }

    echo '<h1> Go Away! </h1>';
    echo ' You are not authorized to view this resource.';
} else {
    // o visitante forneceu os detalhes corretos

    echo '<h1> Here it is! </h1>';
    echo '<p> I bet you are glad you can see this secret page. </p>';
}