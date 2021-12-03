<?php

// Generate new password.
$new_password = '';
for($i = 0; $i < 8; $i++){
    $new_password .= chr(mt_rand(33, 126));
}

// Hash new password.
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Save new hashed password to the database.
$st = $db->prepare('UPDATE users'
        . 'SET password   = ?'
        . 'WHERE username = ?');
$st->execute(array($hashed_password, $clean['username']));

// Email new plain text password to user.
mail($clean['email'], 'New Password', "Your new password is: $new_password");

$words = ['mother', 'basset', 'detain', 'sudden', 'fellow', 'logged',
          'remove', 'snails', 'direct', 'serves', 'daring', 'chirps',
          'reward', 'snakes', 'uphold', 'wiring', 'nurses', 'regent',
          'ornate', 'dogmas', 'mended', 'hinges', 'verbal', 'grimes',
          'ritual', 'drying', 'chests', 'newark', 'winged', 'hobbit'];

$words_count = count($words);
$password = sprintf('%s%02d%s', $words[mt_rand(0, $words_count - 1)],
        mt_rand(0, 99),
        $words[mt_rand(0, $words_count - 1)]);

echo $password;