<?php

class Lab2 {

    public function converterHorario($fuso) {

        $retorno = ['horario_brasil' => NULL, 'fuso_escolhido' => NULL, 'horario' => NULL];

        $timezone_brasil = new DateTimeZone('America/Sao_Paulo');

        $horario = new DateTime();
        $horario->setTimezone($timezone_brasil);

        $retorno['horario_brasil'] = $horario->format('d/m/Y H:i:s');

        $timezone_escolhido = new DateTimeZone($fuso);

        $retorno['fuso_escolhido'] = $fuso;

        $horario->setTimezone($timezone_escolhido);

        $retorno['horario'] = $horario->format('d/m/Y H:i:s');

        return $retorno;
    }

}

if ($_POST) {

    $obj_lab2 = new Lab2();

    $resultado = $obj_lab2->converterHorario($_POST['fuso']);
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Lab2</title>
    </head>
    <body>
        <form action="" method="post">
            <p>Selecione o fuso Horario:
                <select name="fuso">
                    <option value="America/Sao_Paulo">America São Paulo</option>
                    <option value="America/Recife">America Recife</option>
                    <option value="America/Noronha">America Noronha</option>
                    <option value="America/Manaus">America Manaus</option>
                    <option value="America/Argentina/Buenos_Aires">America Argentina Buenos Aires</option>
                </select>
            </p>
            <p><input type="submit" value="Converter Fuso" /></p>
        </form>

        <?php
        if (isset($resultado)):
            ?>

            <hr>
            <h4>Resultado</h4>
            <p>Horario Brasil:<?php echo $resultado['horario_brasil']; ?></p>
            <p>Fuso Escolhido:<?php echo $resultado['fuso_escolhido']; ?></p>
            <p>Horario Convertido:<?php echo $resultado['horario']; ?></p>

            <?php
        endif;
        ?>

    </body>
</html>
