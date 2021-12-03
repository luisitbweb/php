<?php

// generating the checkboxes
$choices = ['eggs' => 'eggs benedict',
    'toast' => 'buttered toast with jam',
    'coffee' => 'piping hot coffee'];

foreach ($choices as $key => $choice) {
    echo "<input id='break' type='radio' name='food[]' value='$key'/><label for='break'>$choice </label></br >";
}

 // Then, later, validating the radio button submission
if (array_intersect($_POST['food'], array_keys($choices)) != $_POST['food']) {
    echo "You must select only valid choices.";
}

function is_valid_credit_cards($s){
    // remove non-digits and reverse
    $s = strrev(preg_replace('/[^\d]/', '', $s));
    // compute checksum
    $sum = 0;
    for ($i = 0, $j = strlen($s); $i < $j; $i++){
        // use even digits as-is
        if (($i % 2) == 0){
            $val = $s[$i];
        }  else {
            // double odd digits and subtract 9 of greater than 9
            $val = $s[$i] * 2;
            if ($val > 9){
                $val -= 9;
            }
            $sum += $val;
        }
        // number is valid if sum is a multiple of ten
        return (($sum % 10) == 0);
    }
    if (!is_valid_credit_cards($_POST['credit_card'])){
        print 'sorry, that aqrd number is invalid.';
    }
}

is_valid_credit_cards(4111311121110111);

$html = "<a href='Exercicio_capitulo2.html'>Stew's favorite movie.</a><br />";
print htmlspecialchars($html);
print htmlspecialchars($html, ENT_QUOTES);
print htmlspecialchars($html, ENT_QUOTES, ENT_NOQUOTES);
print htmlspecialchars($html, ENT_QUOTES, "BIG5");