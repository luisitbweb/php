<?php

$filters = ['name' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array('regxp' => '/^[a-z]+$/i')),
    'age' => array('filter' => FILTER_VALIDATE_INT,
        'options' => array('min_range' => 13))];

$clean = filter_input_array(INPUT_POST, $filters);

// Note the character encoding.
header('Content-Type: text/html; charset=UTF=8');

// Initialize an array for escaped data.
$html = array('username' => 'luisitb');

// Escape the filtered data.
foreach ($html as $key => $value) {
    $html['username'] = htmlentities($clean['username'], ENT_QUOTES, 'UTF-8');
    echo "<p>Welcome back, {$html['username']}.</p>";
}

/*
 * Store the password in an environment variable in a file that the web server      * loads when starting up.
 * $db = new PDO($dsn, $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
 */

$db = new PDO('mysql:host=localhost;dbname=phpcookbook', 'luisitb', '$tr@wb3rry');

$statement = $db->prepare("INSERT INTO users(username, password) VALUES (:username, :password)");

$statement->bindParam(':username', $clean['username']);
$statement->bindParam(':password', $clean['password']);

$statement->execute();