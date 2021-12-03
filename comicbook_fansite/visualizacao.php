<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>vezes visualizada</title>
    </head>
    <body>
        <form method="post" action="visualizacao.php">
            <table>
                <tr>
                    <td><label for="font">Selecionar Fonte:</label></td>
                    <td><select id="font" name="font">
                            <option value="Verdana">Verdana</option>
                            <option value="Arial">Arial</option>
                            <option value="Times New Roman">Times New Roman</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="size">Selecione Tamanho:</label></td>
                    <td><select id="size" name="size">
                            <option value="10px">10px</option>
                            <option value="12px">12px</option>
                            <option value="16px">16px</option>
                            <option value="20px">20px</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="color">Selecionar Cor:</label></td>
                    <td><select id="color" name="color">
                            <option value="black">black</option>
                            <option value="green">green</option>
                            <option value="purple">purple</option>
                            <option value="red">red</option>
                        </select>
                    </td>
                </tr>
            </table>
            <p><input type="submit" name="enviar" value="Enviar"/><br>
                <br><input checked="checked" type="checkbox" id="save_prefs" name="save_prefs"/>
                <label for="save_prefs">Guarde estas preferências para a próxima vez que fizer login.</label></p>
        </form>

        <?php
        if (isset($_POST['enviar']) && isset($_POST['font']) == $_SESSION['font'] = $_POST['font'] && isset($_POST['size']) == $_SESSION['size'] = $_POST['size'] && isset($_POST['color']) == $_SESSION['color'] = $_POST['color']) {

            $font = $_POST['font'];
            $size = $_POST['size'];
            $color = $_POST['color'];
            
            echo '<p style="font-family: ' . $font . '; font-size: ' . $size . '; color: ' . $color . ';">Texto para exibir!</p>';

        } else if (isset($_POST['save_prefs'])) {
            setcookie('font', $_POST['font'], time() + 60);
            setcookie('color', $_POST['color'], time() + 60);
            setcookie('color', $_POST['color'], time() + 60);
            
            echo $_COOKIE['font'];
        }
        function display_times($num){
            echo "<h1>Você tem visto essa pagina" . $num . ' time(s).</h1>';
        }
        // obiter o valor cookie e adicionar 1 para esse visitante
        $num_times = 1;
        if (isset($_COOKIE['num_times'])){
            $num_times = $_COOKIE['num_times'] + 1;
        }
        // definir o valor de volta para o cookie para proxima vez
        setcookie('num_times', $num_times, time() + 60);
        ?>
    </body>
</html>