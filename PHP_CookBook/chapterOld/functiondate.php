<head>
    <style>
        input{
            width: 250px;
            height: 35px;
        }
        label{
            display: block;
            width: 300px;
            font-weight: bold;            
        }
    </style>
</head>

<form method="POST" action="login.php">
    <label for="name">Username:</label>
        <input type="text" name="username" id="name"/>
    <label for="password">Password:</label>
        <input type="password" name="password" id="password"/>
        <button type="submit" name="login">Log In</button>
</form>

<?php

function validate_date($user, $pass) {
    $db = new PDO('sqlite:/databases/users');

    // prepare and execute
    $st = $db->prepare('SELECT `password`, `last_access` FROM `users` WHERE `user` LIKE ?');

    $st->execute(array($user));

    if ($ob = $st->fetchObject()) {
        if ($ob->password === $pass) {
            $now = time();
            if (($now - $db->last_access) > (15 * 60)) {
                return FALSE;
            } else {
                // update the last access time
                $st2 = $db->prepare('UPDATE `users` SET `last_access` = "now" WHERE `user` LIKE ?');
                $st2->execute(array($user));
                return TRUE;
            }
        }
    }
    return FALSE;
}

unset($username);

if (isset($_COOKIE['login'])){
    list($c_username, $cookie_hash) = split(',', $_COOKIE['login']);
    if (md5($c_username.$secret_word) == $cookie_hash){
        $username = $c_username;
    }  else {
        print 'you have sent a bad cookie.';
    }
}

if (isset($username)){
    print "Welcome, $username.";
}  else {
    print 'Welcome, anonymous user.';
}

$secret_word = 'if i ate spinach';
if (validate($_POST['username'], $_POST['password'])){
    setcookie('login', $_POST['username'] . ',' . md5($_POST['username'] . $secret_word));
}