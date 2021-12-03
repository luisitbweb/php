<html>
    <head>
        <title> Site submission results</title>
    </head>
    <body>
        <h1> Site submission results</h1>
        <?php
        // extrai campos de formulario

        $url = $HTTP_POST_VARS['url'];
        $email = $HTTP_POST_VARS['email'];

        // verifica o url

        $url = parse_url($url);
        $host = $url['host'];

        if (!($ip = gethostbyname($host))) {
            echo 'Host for url does not have valid IP';
            exit;
        }

        echo "Host is at IP $ip<br />";

        // verifica o endereco de email

        $email = explode('@', $email);
        $emailhost = $email[1];

// note que  funcao getmxrr() *nao e implementada* em versoes windows do php

        if (!getmxrr($emailhost, $mxhostsarr)) {
            echo 'Email address is not at valid host';
            exit;
        }

        echo 'Email is delivered via: ';
        foreach ($mxhostsarr as $mx)
            echo "$mx";

        // se chegou ate aqui esta tudo ok

        echo '<br /> All submitted details are ok. <,br />';
        echo 'Thank you for submitting your site. <br />'
        . 'It will be visited by one of our staff members soon.'

        // em um caso real, adiciona ao db de sites em espera...
        ?>
    </body>
</html>
