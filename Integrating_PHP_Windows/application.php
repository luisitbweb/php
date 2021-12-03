<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Game Guessing numbers</title>
    </head>
    <body>
        <?php

        // generate random number and return help text
        function startGame() {
            $_SESSION['number'] = rand(1, 100);
            echo "<P> Can you guess the number? It's between 1 and 100.</p>";
        }

        // first call -> start game
        if (!isset($_SESSION['number'])) {
            startGame();
        }
        // guess
        elseif (isset($_POST['guessed']) && is_numeric($_POST['guessed'])) {
            if ($_SESSION['number'] == $_POST['guessed']){
                echo '<p>Great! You guessed the correct number. Would you like to play again?</p>';
                startGame();
            }elseif ($_SESSION['number'] < $_POST['guessed']) {
                echo "<p>Sorry, you're wrong! the number is smaller.<br /> Try again.</p>";
            }else{
                echo "<p>Sorry, you're wrong! the number is larger.<br /> Try again.</p>";
            }
        }
        // invalid or missing entry
        else{
            echo '<P>Please enter a number.<br /> The number you are trying to guess is between 1 and 100.</p>';
        }
        ?>
        <form action="" method="post">
            <p>Number: <input name="guessed"/></p>
            <p><input type="submit" value="Guess number"/></p>
        </form>
    </body>
</html>
