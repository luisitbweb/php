<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Criar seu proprio animal!</title>
    </head>
    <body>
        <p>Final, você deve escolher um cauda para seu novo animal.</p>
        
        <form method="post" action="animal4.php">
            <table>
                <tr>
                    <td><input id="tail_1" name="tail" type="radio" value="cowtail"/></td>
                    <td><label for="tail_1"><img alt="imagem" width="70" height="70" src="imagens/1.jpg"/></label></td>
                </tr>
                <tr>
                    <td><input id="tail_2" name="tail" type="radio" value="elephanttail"/></td>
                    <td><label for="tail_2"><img alt="imagem" width="70" height="70" src="imagens/2.jpg"/></label></td>
                </tr>
                <tr>
                    <td><input id="tail_3" name="tail" type="radio" value="girafftail"/></td>
                    <td><label for="tail_3"><img alt="imagem" width="70" height="70" src="imagens/3.jpg"/></label></td>
                </tr>
                <tr>
                    <td><input id="tail_4" name="tail" type="radio" value="pigtail"/></td>
                    <td><label for="tail_4"><img alt="imagem" width="70" height="70" src="imagens/4.jpg"/></label></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="tail" value="<?php echo $_POST['tail']; ?>"/>
                        <input type="submit" name="Submit" value="Make the Animal!"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>