<?php

declare(strict_types=1);

/*
 * Store the sample set of text to use for the examples of regex
 */
$string = <<<TEST_DATA
            <h2>Regular Expression Testing</h2>
                <p>
                    In this document, there is a lot of text that can be matched
                    using regex. The benefit of using a regular expression is much
                    more flexible, albeit complex, syntax for text
                    pattern matching.
                </p>
                <p>
                    After you get the hang of regular expressions, also called
                    regexes, they will become a powerful tool for pattern matching.
                </p>
           <hr />
TEST_DATA;
/*
 * Use str_replace(), str_ireplace to highlight any occurrence of the word "regular"
 * $check1 = str_replace("regular", "<em>regular</em>", $string);
 */

/*
 * Use str_replace() again to highlight any capitalized occurrence
 * of the word "Regular"
 * 
 * Use regex to highlight any occurence of the letters a-c
 */
$pattern = "/(reg(ular\s)?ex(es)?)/i";
echo preg_replace($pattern, "<em>$1</em>", $string);

/*
 * Use preg_replace() to highlight any occurence of the word "regular"
 * Output the pattern you just used
 */
echo "\n<p>Pattern used: <strong>$pattern</strong></p>";

function doStuff(int $int = 0, string $str = "", float $flt = 0.0, bool $b = False): string {
    echo $int . "<br />";
    echo $flt . "<br />";
    echo $b . "<br />";
    return $str; // Oops! Supposed to be a string (such as $str).
}

try {
    $output = doStuff(1, "hi there", 2.34, True);
    echo $output . "<br/>";
} catch (TypeError $e) {
    echo $e;
}

define('ACTIONS', array(
'user_login' => array(
'object' => 'Admin',
'method' => 'processLoginForm',
'header' => 'Location: ../../'
),
'user_logout' => array(
'object' => 'Admin',
'method' => 'processLogout',
'header' => 'Location: ../../'
)
)
);
echo ACTIONS['user_logout']['method'] . "<hr />";
// ACTIONS['user_logout']['method'] = 'somethingElse'; // Not allowed!

function add($a, $b, $c) {
return $a + $b + $c;
}
$two_more = [2, 5];
echo add(1, ...$two_more) . "<hr />"; // Unpack the elements of $two_more.

$num = 11;
$den = 3;
$result = intdiv($num, $den);
echo $result . "<hr />";

$alpha = null;
$beta = null;
$gamma = "I'm not null!";
echo $alpha ?? 'this value' . "<br/>";
echo $alpha ?? $beta ?? $gamma ?? 'that value' . "<br/>"; // chainable

$values = ['Zebra', 'zed', 'apple', 'baseball', 'Angel'];
usort($values, function($a, $b) {
$x = strtolower($a);
$y = strtolower($b);
return ($x < $y) ? -1 : (($x > $y) ? 1 : 0);
});
var_dump($values);

echo "<hr />";

usort($values, function($a, $b) {
return strtolower($a) <=> strtolower($b); // spaceship!
});
var_dump($values);