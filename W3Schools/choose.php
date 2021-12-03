<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario Escolha</title>
    </head>
    <body>
        <form method="post" action="showratings.php">
            <table>
                <tr>
                    <td><label for="movie">Titulo Filme:</label></td>
                    <td><input type="text" name="movie" id="movie"/></td>
                </tr>
                <tr>
                    <td><label for="rating">Classificação:</label></td>
                    <td>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo '<input type="radio" id="rating" name="rating" value="' . $i . '">' . '<sup>' . $i . '</sup>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="comments">Comentario:</label></td>
                    <td><textarea name="comments" cols="40" id="comments" rows="10" style="resize: vertical;"></textarea></td>
                </tr>
            </table>
        </form>
        <form method="post" action="showratings.php">
            <table>
                <tr>
                    <td><label for="sval">Selecionar Opções:</label></td>
                    <td>
<?php
for ($i = 0; $i < 5; $i++) {
    echo '<input type="text" id="sval" name="sval[' . $i . ']" /></br>';
}
?>
                        <select>
                        <?php
                        for ($i = 0; $i < 5; $i++) {
                            echo '<option value="' . $_POST['sval'][$i] . '">' . $_POST['sval'][$i] . '</option>';
                        }
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
                            <?php
                            $num1 = (isset($_POST['num1'])) ? $_POST['num1'] : NULL;
                            $num2 = (isset($_POST['num2'])) ? $_POST['num2'] : NULL;
                            $operator = (isset($_POST['operator'])) ? $_POST['operator'] : '+';
                            ?>
        <form method="post" action="#">
            <div>
                <input type="text" name="num1" size="3" value="<?php echo $num1; ?>"/>
                <select name="operator">

                    <option value="+" 
                    <?php
                    if ($operator == '+') {
                        echo 'selected="selected"';
                    }
                    ?> > + </option>

                    <option value="-" 
                    <?php
                    if ($operator == '-') {
                        echo 'selected="selected"';
                    }
                    ?> > - </option>

                    <option value="*" 
                    <?php
                    if ($operator == '*') {
                        echo 'selected="selected"';
                    }
                    ?> > &times; </option>

                    <option value="/" 
                    <?php
                    if ($operator == '/') {
                        echo 'selected="selected"';
                    }
                    ?> > &divide; </option>
                </select>
                
                <input type="text" name="num2" size="3" value="<?php echo $num2; ?>"/>
                <input type="submit" value="=" />
                <strong>
                    <?php
                            if (!is_null($num1) && !is_null($num2)) {
                                if ($operator == '+') {
                                    echo $num1 + $num2;
                                } elseif ($operator == '-') {
                                    echo $num1 - $num2;
                                } elseif ($operator == '*') {
                                    echo $num1 * $num2;
                                } elseif ($operator == '/') {
                                    echo $num1 / $num2;
                                } else {
                                    echo 'NULO';
                                }
                            }
                            ?>
                </strong>
            </div>
        </form>
    </body>
</html>