<?php
//Local variables
$samplevar = 10;
function sumvars() {
       $a = 5;
      $b = 3;
       $samplevar = $a + $b;   //$samplevar is local variable inside this function
      echo "\$samplevar inside this function is $samplevar. <br />";
}
sumvars();
echo "\$samplevar outside the previous function is $samplevar. <br />";
//Function parameters
function phpfunction($parameter1,$parameter2)
{
      return ($parameter1 * $parameter2);
}
$funcval = phpfunction(6,3);
echo "Return value from phpfunction() is $funcval <br />";

//Global variables
$globalvar = 55;

function dividevalue() {
	GLOBAL $globalvar;
	$globalvar/= 11;
	echo "Division result $globalvar <br />";
}

dividevalue();

//Static variables
function countingsheeps()
{
   STATIC $sheepnumber = 0;
   $sheepnumber++;
   echo "Sheep number $sheepnumber <br />";
}

countingsheeps();
countingsheeps();
countingsheeps();
countingsheeps();
countingsheeps();

echo <<<eot
    <table border="1" style="text-align: left">
    <caption>Table 3: PHP Superglobals Summary</caption>
    <thead>
        <tr>
            <th colspan="2" style="text-align: center">PHP Superglobals</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>'\$GLOBALS'</td>
            <td>This array contains a reference to every global variable in the script. The name of every global variable is a key of this array.</td>
        </tr>
        <tr>
            <td>'\$_SERVER'</td>
            <td>This array contains information about the web server environment, such as headers, paths, and script locations. Since these values are created by the web server being used, some of them could not exist in some environments.</td>
        </tr>
        <tr>
            <td>'\$_GET'</td>
            <td>This array contains associations to all variables passed to the script via the HTTP GET method.</td>
        </tr>
        <tr>
            <td>'\$_POST'</td>
            <td>This array contains associations to all variables passed to the script via the HTTP POST method.</td>
        </tr>
        <tr>
            <td>'\$_FILES'</td>
            <td>This array contains associations to all items uploaded to the script via the HTTP POST method.</td>
        </tr>
        <tr>
            <td>'\$_COOKIE'</td>
            <td>This array contains associations to all variables passed to the script via HTTP cookies.</td>
        </tr>
        <tr>
            <td>'\$_REQUEST'</td>
            <td>This array contains associations to the contents of \$_GET, \$_POST, and \$_COOKIE</td>
        </tr>
        <tr>
            <td>'\$_SESSION'</td>
            <td>This array contains associations to all session variables available to the script.</td>
        </tr>
        <tr>
            <td>'\$_PHP_SELF'</td>
            <td>A string containing the script file name in which this variable is used.</td>
        </tr>
        <tr>
            <td>'\$php_errormsg'</td>
            <td>A string variable containing the last error message generated by PHP. The '\$php_errormsg' variable is not a true superglobal object, but it's closely related.</td>
        </tr>
    </tbody>
</table>
eot;