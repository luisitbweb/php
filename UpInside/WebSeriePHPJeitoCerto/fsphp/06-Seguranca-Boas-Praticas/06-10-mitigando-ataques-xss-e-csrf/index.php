<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.10 - Mitigando ataques XSS e CSRF");

require __DIR__ . "/source/autoload.php";

/*
 * [ XSS ] Cross-site Scripting
 * https://pt.wikipedia.org/wiki/Cross-site_scripting
 */
fullStackPHPClassSession("xxs", __LINE__);

//$post = $_POST;
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
if($post){
    $data = (object)$post;
    var_dump($post);

    echo $data->first_name;
}

/*
 * [ CSRF ] Cross-Site Request Forgery
 * https://pt.wikipedia.org/wiki/Cross-site_request_forgery
 */
fullStackPHPClassSession("csrf", __LINE__);

var_dump($_REQUEST);

/*
 * [ form ]
 */
fullStackPHPClassSession("form", __LINE__);

require __DIR__ . "/form.php";