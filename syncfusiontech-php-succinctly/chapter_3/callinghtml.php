<?php
  echo "<html>\n"
        . "<head>\n"
            . "<title>Calling HTML from PHP</title>\n"
              . "<style>
                table, th, td {
                  border: 2px solid black;
                  border-collapse: collapse;
                }
                th, td {
                  padding: 5px;
                  text-align: left;
                }
                </style>"
        . "</head>\n"
    . "<body>\n"
          . "<h1>Hello, calling HTML from PHP!</h1>\n"
            . "<table>
                <caption>Table 2: PHP Data Types</caption>
                <thead>
                    <tr>
                        <th>Data Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Integer</td>
                        <td>Whole numbers with no decimal point</td>
                    </tr>
                    <tr>
                        <td>Double</td>
                        <td>Floating point numbers such as 1.31313 or 34.5</td>
                    </tr>
                    <tr>
                        <td>Boolean</td>
                        <td>A type with two possible values, either true or false</td>
                    </tr>
                    <tr>
                        <td>NULL</td>
                        <td>The NULL value</td>
                    </tr>
                    <tr>
                        <td>String</td>
                        <td>Sequences of characters like 'Hello World' or 'Last Name'</td>
                    </tr>
                    <tr>
                        <td>Array</td>
                        <td>A named and indexed collection of values</td>
                    </tr>
                    <tr>
                        <td>Object</td>
                        <td>
                            instances of programmer-defined classes that package both attributes
                            (values) and methods (functions), specific to the class
                        </td>
                    </tr>
                    <tr>
                        <td>Resource</td>
                        <td>
                            Special data type that hold references to resources external to PHP,
                            such as database connections
                        </td>
                    </tr>
                </tbody>
            </table>"
    . "</body>\n"
. "</html>";

$var_double = 3 + 0.14159;
$var_integer = 4;
$var_string = 'This is a PHP variable';
$var_array = array('Array', 'An array element', 'Other element');
$var_boolean = TRUE;
$var_null = NULL;

echo '<br />';
echo 'Double ' . $var_double;
echo '<br />';
echo 'Integer ' .  $var_integer;
echo '<br />';
echo 'String ' .  $var_string;
echo '<br />';
echo 'NULL' .  $var_null;
echo '<br />';
echo 'Boolean ' . $var_boolean;
echo '<br />';
var_dump($var_array);