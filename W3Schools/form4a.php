<?php
/*
 * Certifique-se de que o usuário selecionado um tipo de filme se eles estão adicionando uma
 * filme. Se não, então enviá-los de volta para a primeira forma.
 * 
 */
if ($_POST['submit'] == 'Adicionar') {
    if ($_POST['type'] == 'movie' && $_POST['movie_type'] == '') {
        header('Location: form4.php');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fomulario Universal</title>
        <style>
            td{vertical-align: top;}
        </style>
    </head>
    <body>
        <?php
        //Mostrar um formulário para coletar mais informações se o usuário está adicionando algo
        if ($_POST['submit'] == 'Adicionar') {
            echo '<h1> Adicionar' . ucfirst($_POST['type']) . '</h1>';
            ?>
            <form action="form4b.php" method="post">
                <input type="hidden" name="type" value="<?php echo $_POST['type']; ?>"/>
                <table>
                    <tr>
                        <td>Nome</td>
                        <td>
                            <?php echo $_POST['name']; ?>
                            <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>"/>
                        </td>
                    </tr>
                    <?php if ($_POST['type'] == 'movie') { ?>
                        <tr>
                            <td>Tipo Filme</td>
                            <td>
                                <?php echo $_POST['movie_type']; ?>
                                <input type="hidden" name="movie_type" value="<?php echo $_POST['movie_type']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Ano</td>
                            <td><input type="text" name="year"/></td>
                        </tr>
                        <tr>
                            <td>Descrição do Filme</td>
                            <?php
                        } else {
                            echo '<tr><td>Biografia</td>';
                        }
                        ?>
                        <td><textarea name="extra" rows="5" cols="60"></textarea> </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <?php
                            if (isset($_POST['debug'])) {
                                echo '<input type="hidden" name="debug" value="Ligado"/>';
                            }
                            ?>
                            <input type="submit" name="submit" value="Adicionar"/>
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            // O usuário está apenas à procura de algo
        } elseif ($_POST['submit'] == 'Pesquisa') {
            echo '<h1> Pesquisa para ' . ucfirst($_POST['type']) . '</h1>';
            echo '<p> Procurando para ' . $_POST['name'] . '...</p>';
        }
        if (isset($_POST['debug'])) {
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
        }
        ?>
        <a href="form4.php">Voltar</a>
    </body>
</html>