<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Information about the HTTP Request</title>
    </head>
    <body>
        <h1>Information about the HTTP Request</h1>
        <h2>Binding specifications</h2>
        <ul>
            <?php
                function printServerVar($text, $parameter){
                    echo "<li>$text ($parameter): ";
                    if (isset($_SERVER[$parameter])){
                        echo '"', htmlspecialchars($_SERVER[$parameter]), '"';
                    }  else {
                        echo '--not specified--';
                    }
                    echo "</li><br />";
                }
                printServerVar('Server name', 'SERVER_NAME');
                printServerVar('Port', 'SERVER_PORT');
                printServerVar('Protocol', 'SERVER_PROTOCOL');
                printServerVar('Secure connection', 'HTTPs');
            ?>            
        </ul>
        <h2>URL specifications</h2>
        <ul>
            <?php 
                printServerVar('Request URL', ' REQUEST_URI');
                printServerVar('Query string', 'QUERY_STRING');
                printServerVar('URL-Scrip path incl. subpath', 'PHP_SELF');
                printServerVar('URL path of the script', 'SCRIPT_NAME');
                printServerVar('Subpath', 'PATH_INFO');
                printServerVar('Original path information', 'ORIG_PATH_INFO');
                printServerVar('Did a URL rewrite take place?', 'IIS_WasUrlRewritten');
                printServerVar('Original URL', 'HTTP_X_ORIGINAL_URL');
                printServerVar('unencoded URL', 'UNENCODED_URL');
            ?>
        </ul>
        <h2>Script specifications</h2>
        <ul>
            <?php
                printServerVar('Root folder', 'DOCUMENT_ROOT');
                printServerVar('Physical path of the IIS application', 'APPL_PHYSICAL_PATH');
                printServerVar('Physical path of the script', 'SCRIPT_FILENAME');
                printServerVar('Physical pat incl. subpath', 'PATH_TRANSLATED');
                
                echo '<li>__FILE__ constant: ', __FILE__, '</li>';
                echo '<li>__DIR__ constant: ', __DIR__, '</li>'; // only as of PHP 5.3
            ?>
        </ul>
    </body>
</html>