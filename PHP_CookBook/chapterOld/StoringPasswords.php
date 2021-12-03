<?php

/* Initialize an array for filtered data. */
$clean = array();

/*
 * Generate an appropriate salt. '$2a$' tells cript() to
 * use the Blowfish algorithm, and the 08 tells to do 
 * 256 (2^8) rounds of hashing
 */
$salt = '$2a$08$';

/*
 * Blowfish hashes are 22 bytes long, each byte is
 * from 0-9, A-Z, a-z
 */
for($i = 0; $i < 22; $i++){
    $r = mt_rand(0, 61);
    if($r < 10){
        $c = ord('0') + $r;
    }elseif ($r < 36) {
        $c = ord('a') + $r - 10;
    }else{
        $c = ord('a') + $r - 36;
    }
    $salt .= chr($c);
}

/* Hash the password. */
$hashed_password = crypt($_POST['password'], $salt);

/* Allow alphanumeric usernames. */
if (ctype_alnum($_POST['username'])) {
    $clean['username'] = $_POST['username'];
} else {
    /* Error */
}

/* Store user in the database. */
$st = $db->prepare('INSERT
INTO users (username, password)
VALUES (?, ?)');
$st->execute(array($clean['username'], $hashed_password));

/* Initialize an array for filtered data. */
$clean = array();

/* Allow alphanumeric usernames. */
if (ctype_alnum($_POST['username'])) {
    $clean['username'] = $_POST['username'];
} else {
    /* Error */
}

$stmt = $db->prepare('SELECT password
        FROM users
        WHERE username = ?');

$stmt->execute(array($clean['username']));
$hashed_password = $stmt->fetchColumn();
$salt = substr($hashed_password, 0, strlen('$a$08$') + 22);

if (crypt($_POST['password'], $salt) === $hashed_password) {
    /* Login succeeds. */
    print "Login OK!";
} else {
    /* Login fails. */
}