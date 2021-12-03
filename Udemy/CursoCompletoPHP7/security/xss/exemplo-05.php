<form method="POST">
    <input type="text" typy="text" name="busca">
    <button type="submit">Enviar</button>
</form>

<?php

if(isset($_POST['busca'])){
    echo strip_tags($_POST['busca'], '<strong>'); // permiti tag segundo parametro
}

$search_html = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
$search_url = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_ENCODED);
echo "You have searched for $search_html.\n";
echo "<a href='?search=$search_url'>Search again.</a>";

//Old Way
$name = trim(mysql_real_escape_string(htmlentities(strip_tags($_POST['name'],ENT_QUOTES))));
$address = trim(mysql_real_escape_string(htmlentities(strip_tags($_POST['address'],ENT_QUOTES))));

//New Way
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

$num = mysql_real_escape_string($_GET['num']);
$query = "UPDATE tbl SET something = '1' WHERE num  = '$num'";

$num = filter_input(INPUT_GET, 'num', FILTER_SANITIZE_STRING);
$query = "UPDATE tbl SET something = '1' WHERE num  = $num";