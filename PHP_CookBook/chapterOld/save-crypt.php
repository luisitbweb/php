<?php

function show_form(){
    $html = array();
    $html['action'] = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8');
    
    print <<<FORM
    <form method="POST" action = "{$html['action']}">
    Enter data to be encrypted here.<br />
    <textarea name="data" rows="10" cols="40" style="resize: vertical"> </textarea>
        <br />
    Encryption key: <input type="text" name="key" />
        <br />
    <input name="submit" type="submit" value="Save"/>
    </form>
FORM;
}

function save_form(){

 /*
 * Encrypt the data.
 */

$algorithm = mcrypt_cfb;
    $mode = mcrypt_cbc;

$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);
$ciphertext = mcrypt_encrypt($algorithm, $_POST['key'], $_POST['data'], $mode, $iv);

/*
 * Save encrypted data.
 */

$filename = tempnam('/tmp', 'enc') or exit($php_errormsg);
$file = fopen($filename, 'w') or exit($php_errormsg);
    if(false === fwrite($file, $iv.$ciphertext)){
        fclose($file);
        exit($php_errormsg);
    }
fclose($file) or exit($php_errormsg);
return $filename;
}

if(isset($_POST['submit'])){
    $file = save_form();
    echo "Encrypted data saved to file: $file";
}else{
    show_form();
}

/*
 * Store the encrypted data.
 *
$st = $db->prepare('INSERT INTO noc_lict (algorithm, mode, iv, data) VALUES '
        . '?, ?, ?, ?');
$st->execute(array($algorithm, $mode, $iv, $ciphertext));

$row = $db->query('SELECT * FROM noc_list WHERE id = 37')->fetch();
$plaintext = mcrypt_descrypt($row['algorithm'], $_POST['key'], $row['data'],
        $row['mode'], $row['iv']);
 * 
 */