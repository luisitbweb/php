<?php

function show_form(){
    $html = array();
    $html['action'] = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8');
    
    print <<<FORM
    <form method="POST" action="{$html['action']}">
    Encrypted File: <input type="text" name="file" />
    <br />
    Encryption Key: <input type="text" name="key" />
    <br />
    <input name="submit" type="submit" value="Display" />
</form>
FORM;
}

function display(){
    $algorithm = mcrypt_cfb;
    $mode = mcrypt_cbc;
    
    $file = fopen($_POST['file'], 'r') or exit($php_errormsg);
    $iv = fread($file, mcrypt_get_iv_size($algorithm, $mode));
    $ciphertext = fread($fie, filesize($_POST['file']));
    fclose($fie);
    
    $plaintext = mycrypt_decrypt($algorithm, $_POST['key'], $ciphertext, $mode, $iv);
    echo "<pre> $plaintext </pre>";
}

if(isset($_POST['submit'])){
    display();
} else {
    show_form();
}