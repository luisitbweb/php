<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            <?php echo 'Default Syntax'; ?>
        </title>
        <script language="php">
            print "This is another PHP example.";
            </script>
    </head>
    <body>
        <?php
        $date = date('Y-m-d \T H:i:s');

        $season = "summertime";
        print "<p>I love the " . $season . "</p>";

        $heavyweight = "Lennox Lewis";
        $lightweight = "Floyd Mayweather";
        echo $heavyweight, " and ", $lightweight, " are great fighters.";

        printf("$%01.2f", 43.2); // $43.20
        printf("%d beer %s", 100, "bottles"); // 100 beer bottles
        printf("%15s", "Some text"); // Some text
        printf("The %2\$s likes to %1\$s", "bark", "dog");
        // The dog likes to bark
        printf("The %1\$s says: %2\$s, %2\$s.", "dog", "bark");
        // The dog says: bark, bark.
        ?>
        <h3>Today's date is <?= $date; ?></h3>

        <pre>
            <h4>Table 3-1. Supported Type Specifiers</h4>
        Type        Description
         %b          Argument considered an integer; presented as a binary number
         %c          Argument considered an integer; presented as a character corresponding to that ASCII value
         %d          Argument considered an integer; presented as a signed decimal number
         %f          Argument considered a floating-point number; presented as a floating-point number
         %o          Argument considered an integer; presented as an octal number
         %s          Argument considered a string; presented as a string
         %u          Argument considered an integer; presented as an unsigned decimal number
         %x          Argument considered an integer; presented as a lowercase hexadecimal number
         %X          Argument considered an integer; presented as an uppercase hexadecimal number
        </pre>
    </body>
</html>