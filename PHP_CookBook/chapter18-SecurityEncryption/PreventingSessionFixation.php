<?php

session_start();
$_SESSION['token'] = md5(uniqid(mt_rand(), true));

?>
<form action="buy.php" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
    <p>Stock Symbol: <input type="text" name="symbol" /></p>
    <p>Quantity <input type="text" name="quantity" /></p>
    <p> <input type="submit" name="Buy Stocks" /></p>
</form>

echo "<a href='http://example.org/login.php?PHPSESSID=1234'>Click Here!</a>";