<?php

echo '<h1>Loops</h1>';

echo '<ol style="list-style-type: disc">'
 . '<li>for – Loops through a code block a specified number of times</li>'
 . '<li>while – Loops through a code block while a certain condition is met</li>'
 . '<li>do … while – Loops through a code block once, and repeats the execution as long as the condition stablished is true</li>'
 . '<li>foreach – Loops through a code block as many times as elements exist in an array</li>'
 . '</ol>';

echo '<h3>Loop For</h3><pre>';

for ($iteration = 0; $iteration <= 10; $iteration++) {
    echo "$iteration <br />";
}

echo '<h3>Loop While</h3>';

$sheepnumber = 0;
while ($sheepnumber < 11) {
    echo "Sheep number $sheepnumber <br />";
    $sheepnumber++;
}
echo '<br />';

$subtotal = 3.5;
while (true) {
    $taxrate = rand(0, 10);

    if ($taxrate == 10)
        break;

    if ($taxrate == 0)
        continue;
    $taxvalue = $subtotal * ($taxrate / 100);
    echo "Tax to be payed $taxvalue <br />";
}

echo '<h3>Loop do... While</h3>';

$sheep = 1;
do {
    echo "Sheep number $sheep <br />";
    $sheep++;
} while ($sheep < 11);
$totalsheeps = $sheep--;
echo "<br />We count only $sheep sheeps";

echo '<h3>Loop foreach</h3>';

$sheepsarray = [1, 2, 3, 4, 5, 6, 7, 8, 9];
foreach ($sheepsarray as $value) {
    echo "Sheep number $value <br />";
}

$sheepsarrayassoc = ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5];
foreach ($sheepsarrayassoc as $key => $value) {
    echo "Array key and value $key => $value <br />";
}

$arraymulti = [
    'level0' => ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4],
    'level1' => ['five' => 5, 'six' => 6, 'seven' => 7],
    'level2' => ['eight' => 8, 'nine' => 9, 'ten' => 10],
    'level3' => ['eleven' => 11, 'twelve' => 12, 'thirteen' => 13]
];
foreach ($arraymulti as $key => $values) {
    echo "<h4>Keys Array Multidimensional $key </h4>";
    echo "<strong>Layer Inner Array</strong><br />";

    foreach ($values as $key1 => $value) {
        echo "key inner <strong>$key1</strong> value inner $value <br />";
    }
}
echo '<h4>There are two special keywords that can be used within a loop: break and continue.</h4>';
echo '<p>The <strong>break</strong> keyword terminates the execution of a loop prematurely.</p>';
echo '<p>The <strong>continue</strong> keyword halts the execution of a loop and starts a new iteration.</p>';

$subtota = 3.5;
while (true) {
    $taxrate = rand(0, 10);
    if ($taxrate == 10)
        break;

    if ($taxrate == 0)
        continue;
    $taxvalue = $subtota * ($taxrate / 100);
    echo "<pre>Tax to be payed $taxvalue <br /></pre>";
}

echo '<p>Operator precedence is rather complicated. Common operators in an</p>';
echo '<p>expression are executed in the following order: increment and decrement, unary,</p>';
echo '<p>multiplicative and division, addition and subtraction, relational,</p>';
echo '<p>equality, bitwise, ternary, assignment, logical AND, logical XOR, logical OR.</p>';