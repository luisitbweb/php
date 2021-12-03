<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Escreva sua propria legenda!</title>
    </head>
    <body>
        <h1>Escreva sua propria legenda!</h1>
        <img src="imagens/AVATAR_03.jpg" alt="captionless cartoon" width="70" height="70"/>
        
        <form method="post" action="caption.php">
            <table>
                <tr>
                    <td><label for="image_caption">Escrever um legenda para desenho animado:</label><br />
                        <em>Exemplo: Você falando comigo?</em></td>
                    <td><input id="image_caption" name="image_caption" type="text" size="25" maxlength="25"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Send my Caption"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>