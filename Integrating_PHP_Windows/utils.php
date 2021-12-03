<?php

/**
 * End program, return SQL Server error message
 * @param string $txt Description of the error context
 */
function exitWithSQLError($txt) {
    $errors = sqlsrv_errors();
    echo '<h1>Database error</h1>';
    echo "<p>Error: $txt</p>";
    foreach ($errors as $error) {
        echo '<p><b>SQL-Status:</b> ', htmlspecialchars($error['SQLSTATE']), '<br />',
        '<b>Code:</b> ', htmlspecialchars($error['code']), '<br />',
        '<b>Message</b>: ',
        // Error messages are transferred in ISO-8859-1 format
        htmlspecialchars(iconv('ISO-8859-1', 'UTF-8', $error['message'])),
        '</p>';
    }
    echo '<p>Program ended with errors.</p>';
    exit;
}

//SELECT SYSTEM_USER AS CurrentUser, DB_NAME() AS CurrentDatabase

// connect via SQL server authentication
$server = 'SERVERWEB\SQLEXPRESS';
$connectionInfo = ['UID' => 'sa', // SQL server user name
                   'PWD' => '$tr@wb3rry', // Password
                   'Database' => 'AdventureWorks2008R2',
                   'CharacterSet' => 'UTF-8'];
$db = sqlsrv_connect($server, $connectionInfo);