<?php
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    
    echo '<pre>';
    
    $cmd = escapeshellcmd($_POST['cmd']); // impedir inject
    
    $comando = system("dir C:", $retorno);

}
?>

<form method="POST">
    <input type="text" name="cmd"/>
    <button type="submit">Enviar</button>
</form>