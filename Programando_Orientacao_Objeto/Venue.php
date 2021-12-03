<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Venue</title>
    </head>
    <body>
        <h1>Venues</h1>
        <?php
        foreach ($venues as $venue){
            print $venue->getName() . '<br />';
        }
        ?>
    </body>
</html>
