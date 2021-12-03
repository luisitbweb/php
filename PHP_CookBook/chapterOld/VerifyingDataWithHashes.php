<?php

// Define a salt.
define('SALT', 'flyingturtle');

$name = 'Luis Carlos';
$namecheck = hash_hmac('sha1', $name, SALT);
setcookie('name', implode('|', array($name, $namecheck)));

$id = 1337;
$idcheck = hash_hmac('sha1', $id, SALT);

?>

<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<input type="hidden" name="idcheck" value="<?php echo $idcheck; ?>"/>

<?php

// Initialize an array for filtered data.
$clean = array();

list($cookie_value, $cookie_check) = explode('|', $_COOKIE['name'], 2);

if(hash_hmac('sha1', $cookie_value, SALT) === $cookie_check){
    $clean['name'] = $cookie_value;
}else{
    // ERROR
}

if(hash_hmac('sha1', $_POST['id'], SALT) === $_POST['idcheck']){
    $clean['id'] = $_POST['id'];
} else {
    // ERROR
}