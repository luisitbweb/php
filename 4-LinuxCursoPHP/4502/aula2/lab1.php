<?php

class lab1 {

    public function calcular($hr_entrada, $hr_saida) {

        $retorno = ['entrada' => NULL, 'saida' => NULL, 'trabalhadas' => NULL];

        $retorno['entrada'] = $hr_entrada;

        $retorno['saida'] = $hr_saida;

        $entrada = new DateTime($hr_entrada);

        $saida = new DateTime($hr_saida);

        $trabalhadas = $saida->diff($entrada);

        $retorno['trabalhadas'] = $trabalhadas->format('%H:%I:%S');

        return $retorno;
    }

}

if ($_POST) {
    
    $obj_lab1 = new lab1();
    
    $resultado = $obj_lab1->calcular($_POST['hr_entrada'], $_POST['hr_saida']);
}

?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Lab1</title>
    </head>
    <body>
        <form action="" method="post">
            
            <div style="width: 340px;">
                
                <p>Horario Entrada:&nbsp;<input style="border-radius: 5px; height: 25px" type="text" placeholder="Insira Hora" name="hr_entrada"/></p>
                <p>Horario Saida:&nbsp;&nbsp;&nbsp;&nbsp;<input style="border-radius: 5px; height: 25px;" type="text" placeholder="Insira Hora" name="hr_saida"/></p>
                <p align="center"><input type="submit" name="calcular" value="Calcular"/></p>
                
                <?php
                    if (isset($resultado)):
                ?>
                
                <hr>
                <h4>Resultado</h4>
                <p>Entrada:<?php echo $resultado['entrada']; ?></p>
                <p>Saida:<?php echo $resultado['saida']; ?></p>
                <p>Horas Trabalhadas:<?php echo $resultado['trabalhadas']; ?></p>
                
                <?php
                    endif;
                ?>
                
            </div>
        </form>
    </body>
</html>
