<?php

// generating the menu
/* $choices = ['eggs' => 'eggs benedict', 'toast' => 'buttered toast with jam', 'coffee' => 'piping hot coffee'];
  echo "<select name='food'> <br />";
  foreach ($choices as $key => $choice){
  echo "<option value='$key'>$choice</option></br />";
  }
  foreach ($choices as $key1 => $choice1){
  echo "<br /><input type='radio' name='food' value='$key1'/>$choice1 <br />";
  }
  echo '</select>';

  // then, later, validating the menu
  if (@!array_key_exists($_POST['food'], $choices)){
  echo 'you must select a valid choice.';
  } */

// Defaults
$defaults['food'] = 'toast';
// Generating the radio buttons
$choices = array('eggs' => 'Eggs Benedict',
    'toast' => 'Buttered Toast with Jam',
    'coffee' => 'Piping Hot Coffee');
foreach ($choices as $key => $choice) {
    echo "<input type='radio' name='food' id='food' value='$key'";
    if ($key == $defaults['food']) {
        echo "checked='checked'";
    }
    echo "/>$choice<br />";
}
// Then, later, validating the radio button submission
if (@!array_key_exists($_POST['food'], $choices)) {
    echo "You must select a valid choice.";
}