<?php

/*
 * 
  setcookie('flavor','chocolate chip', 1417608000,'/products/');
  setcookie('flavor','chocolate chip', 1417608000, 'Cookie.php');

  if (isset($_COOKIE['flavor'])){
  print "You ate a {$_COOKIE['flavor']} cookie.";
  }

  foreach ($_COOKIE as $cookie_name => $cookie_value){
  print "$cookie_name = $cookie_value <br />";
  }
 * 
 */

$vars = array('name' => 'Oscar the Grouch',
    'color' => 'green',
    'favorite_punctuation' => '#');
$query_string = http_build_query($vars);
$url = '/muppet/select.php?' . $query_string;

print $url;

function validate($user, $pass) {
    // replace with appropriate username and password checking such as checking a database
    $users = ['david' => 'fadj&35', 'adam' => '8HEj838'];
    $realm = 'My website';

    $username = validate($realm, $users);

    // execution never reches this point if invalid auth data is provided
    print "Hello, " . htmlentities($username);

    function validate_digest($realm, $users) {
        // fail if no digest has been provided by the client
        if (!isset($_SERVER['PHP_AUTH_DIGEST'])) {
            send_digest($realm);
        }
        // fail if digest can't be parsed
        $username = parse_digest($_SERVER['PHP_AUTH_DIGEST'], $realm, $users);
        if ($username === FALSE) {
            send_digest($realm);
        }
        // valid username was specified in the digest
        return $username;
    }

    function send_digest($realm) {
        http_response_code(401);
        $nonce = md5(uniqid());
        $opaque = md5($realm);
        header("WWW-Authenticate: Digest realm=\"$realm\" qop=\"auth\" nonce=\"$nonce\" opaque=\"$opaque\"");
        echo "You need to enter a valid username and password.";
        exit();
    }

    function parse_digest($digest, $realm, $users) {
        /*
         * we need find the following values in the digest header;
         * username, uri, qop, cnonce, nc and response
         */
        $digest_info = array();
        foreach (array('username', 'url', 'nonce', 'cnonce', 'response') as $part) {
            // delimiter can either ve or or nothing for qop and nc
            if (preg_match('/' . $part . '=([\'"]?)(.*?)\1/', $digest, $match)) {
                // the part was found, save it for calculation
                $digest_info[$part] = $match[2];
            } else {
                // if the part is missing the digest can't be validated
                return FALSE;
            }
        }
        // make sure the right qop has been provided
        if (preg_match('/qop-auth(,|$)/', $digest)) {
            $digest_info['qop'] = 'auth';
        } else {
            return FALSE;
        }
        // make sure a valid nonce count has been provided
        if (preg_match('/nc=([0-9a-f]{8})(,|$)/', $digest, $match)) {
            $digest_info['nc'] = $match[1];
        } else {
            return FALSE;
        }
        // Now that all the necessary values have been slurped out of the
// digest header, do the algorithmic computations necessary to
// make sure that the right information was provided.
//
// These calculations are described in sections 3.2.2, 3.2.2.1,
// and 3.2.2.2 of RFC 2617.
// Algorithm is MD5
        $A1 = $digest_info['username'] . ':' . $realm . ':' .
                $users[$digest_info['username']];
// qop is 'auth'
        $A2 = $_SERVER['REQUEST_METHOD'] . ':' . $digest_info['uri'];
        $request_digest = md5(implode(':', array(md5($A1), $digest_info['nonce'],
            $digest_info['nc'],
            $digest_info['cnonce'], $digest_info['qop'], md5($A2))));
// Did what was sent match what we computed?
        if ($request_digest != $digest_info['response']) {
            return false;
        }
        // everything's ok return the username
        return $digest_info['unsername'];
    }

    if (isset($users[$user]) && ($users[$user] === $pass)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

if (@!validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    $realm = 'My website for ' . date('Y-m-d');
    http_response_code(401);
    header('WWW-Authenticate: Basic realm="' . $realm . '"');
    echo "<p>you need to enter a valid username and password.</p>";
    exit();
}

unset($users);
