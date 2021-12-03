<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Criar seu proprio animal!</title>
    </head>
    <body>
        <p>Segundo, você deve escolher um corpo para seu novo animal.</p>
        
        <form method="post" action="animal3.php">
            <table>
                <tr>
                    <td><input id="body_1" name="body" type="radio" value="cowbody"/></td>
                    <td><label for="body_1"><img alt="imagem" width="70" height="70" src="imagens/1.jpg"/></label></td>
                </tr>
                <tr>
                    <td><input id="body_2" name="body" type="radio" value="elephantbody"/></td>
                    <td><label for="body_2"><img alt="imagem" width="70" height="70" src="imagens/2.jpg"/></label></td>
                </tr>
                <tr>
                    <td><input id="body_3" name="body" type="radio" value="giraffbody"/></td>
                    <td><label for="body_3"><img alt="imagem" width="70" height="70" src="imagens/3.jpg"/></label></td>
                </tr>
                <tr>
                    <td><input id="body_4" name="body" type="radio" value="pigbody"/></td>
                    <td><label for="body_4"><img alt="imagem" width="70" height="70" src="imagens/4.jpg"/></label></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="head" value="<?php echo $_POST['head']; ?>"/>
                        <input type="submit" name="Submit" value="Pick a Tail &DoubleRightArrow;"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>