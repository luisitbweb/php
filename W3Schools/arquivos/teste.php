<?php
session_start();
//check to see if user has logged in with a valid password
if ($_SESSION['authuser'] != 1) {
    echo "Sorry, but you do not have permission to view this
page, you loser!";
    exit();
}
?>
<html>
    <head>
        <title>My Movie Site</title>
    </head>
    <body>
        <?php include "header.php"; ?>
        <?php
        $favmovies = array("Life of Brian",
            "Stripes",
            "Office Space",
            "The Holy Grail",
            "Matrix",
            "Terminator 2",
            "Star Wars",
            "Close Encounters of the Third Kind",
            "Sixteen Candles",
            "Caddyshack");

//delete these lines:
        function listmovies_1() {
            echo "1. Life of Brian<br>";
            echo "2. Stripes<br>";
            echo "3. Office Space<br>";
            echo "4. The Holy Grail<br>";
            echo "5. Matrix<br>";
        }

        function listmovies_2() {
            echo "6. Terminator 2<br>";
            echo "7. Star Wars<br>";
            echo "8. Close Encounters of the Third Kind<br>";
            echo "9. Sixteen Candles<br>";
            echo "10. Caddyshack<br>";
        }

//end of deleted lines
        if (isset($_REQUEST['favmovie'])) {
            echo "Welcome to our site, ";
            echo $_SESSION['username'];
            echo "! <br>";
            echo "My favorite movie is ";
            echo $_REQUEST['favmovie'];
            echo "<br>";
            $movierate = 5;
            echo "My movie rating for this movie is: ";
            echo $movierate;
        } else {
            echo "My top 10 movies are:<br>";
            if (isset($_REQUEST['sorted'])) {
                sort($favmovies);
            }
//delete these lines
            echo $_REQUEST['movienum'];
            echo " movies are:";
            echo "<br>";
            listmovies_1();
            if ($_REQUEST['movienum'] == 10)
                listmovies_2();
//end of deleted lines
            foreach ($favmovies as $currentvalue) {
                echo $currentvalue;
                echo "<br>\n";
            }
        }
        ?>
    </body>
</html>