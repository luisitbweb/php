<?php

/*
  Boolean
 * 
  $alive = false; # $alive is false.
  $alive = 1;     # $alive is true.
  $alive = -1;    # $alive is true.
  $alive = 5;     # $alive is true.
  $alive = 0;     # $alive is false.
 * 
  Integer
 * 
  42      # decimal
  -678900 # decimal
  0755    # octal
  0xC4E   # hexadecimal
 * 
  Float
 * 
  4.5678
  4.0
  8.7e4
  1.23E+11
 * 
  String
 * 
  "whoop-de-do"
  'subway\n'
  "123$%^789"
 * 
  Array
 * 
  $state[0] = "Alabama";
  $state[1] = "Alaska";
  $state[2] = "Arizona";
  $state["Alabama"] = "Montgomery";
  $state["Alaska"] = "Juneau";
  $state["Arizona"] = "Phoenix";
 * 
  Object
 * 
  class appliance {
  private $power;
  function setPower($status) {
  $this->power = $status;
  }
  }
 * 
  Resource
 * 
  $fh = fopen("/home/jason/books.txt", "r");
 * 
  Null
 * 
  $default = Null;
 * 
  Type Casting
 * 
  Table 3-2. Type Casting Operators
  Cast Operators                  Conversion
  (array)                         Array
  (bool) or (boolean)             Boolean
  (int) or (integer)              Integer
  (object)                        Object
  (real) or (double) or (float)   Float
  (string)                        String

 *

  // Type Juggling

  $total = 5;
  $count = "15";
  $total += $count; // $total = 20;
  $total = "45 fire engines";
  $incoming = 10;
  $total = $incoming + $total; // $total = 55

  settype($incoming, $total);
  gettype($incoming);

 *
 * Type Identifier Functions
 * is_array(), is_bool(), is_float(), is_integer(), is_null(), is_numeric(), 
 * is_object(), is_resource(), is_scalar(), and is_string(), is_name()
 * 
 * Variable Scope
 * 
  • Local variables
  • Function parameters
  • Global variables
  • Static variables
 * 
 */

// Function Parameters
// multiply a value by 10 and return it to the caller
function x10($value) {
    $value2 = $value * 10;
    return $value2;
}

// Global Variables

$somevar = 15;

function addit() {
    GLOBAL $somevar;
    $somevar++;
    print "Somevar is $somevar";
}

addit();

// Static Variables

function keep_track() {
    STATIC $count = 0;
    $count++;
    print $count;
    print "<br>";
}
keep_track();

// PHP's Superglobal Variables

foreach ($_SERVER as $var => $value) {
    echo '<pre>';
echo "$var => $value <br />";
}

/*
 * $_SERVER
 * $_GET
 * $_POST
 * $_COOKIE
 * $_FILES
 * $_ENV
 * $_REQUEST
 * $_SESSION
 * $GLOBALS
 * 
 */

// Variable Variables

$recipe = "spaghetti";
$$recipe = "& meatballs";

// Constants
define("PI", 3.141592);

echo '<h2>Operators</h2>';

echo '<img src="imagens/operadores.jpg" width="660" height="584" alt="operadores"/>';
echo '<hr/>';
echo '<img src="imagens/RecognizedEscape.jpg" width="385" height="299" alt="RecognizedEscape"/>';
