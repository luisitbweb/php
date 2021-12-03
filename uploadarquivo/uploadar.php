<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method='POST' enctype='multipart/form-data'>
            Arquivo1: <input type='file' name='arquivo[]'><br>
            Arquivo2: <input type='file' name='arquivo[]'><br>
            Arquivo3: <input type='file' name='arquivo[]'><br>
            Arquivo4: <input type='file' name='arquivo[]'><br>
            <br>
            <input type='submit' value='Enviar' name='enviar'>
        </form>
        <?php
        if (isset($_POST['enviar'])) {

            $pathToSave = '/uploads/';

            // A variavel $_FILES é uma variável do PHP, e é ela a responsável
            // por tratar arquivos que sejam enviados em um formulário
            // Nesse caso agora, a nossa variável $_FILES é um array com 3 dimensoes
            // e teremos de trata-lo, para realizar o upload dos arquivos
            // Quando é definido o nome de um campo no form html, terminado por []
            // ele é tratado como se fosse um array, e por isso podemos ter varios
            // campos com o mesmo nome
            $i = 0;
            $msg = array();
            $arquivos = array(array());
            foreach ($_FILES as $key => $info) {
                foreach ($info as $key => $dados) {
                    for ($i = 0; $i < sizeof($dados); $i++) {
                        // Aqui, transformamos o array $_FILES de:
                        // $_FILES["arquivo"]["name"][0]
                        // $_FILES["arquivo"]["name"][1]
                        // $_FILES["arquivo"]["name"][2]
                        // $_FILES["arquivo"]["name"][3]
                        // para
                        // $arquivo[0]["name"]
                        // $arquivo[1]["name"]
                        // $arquivo[2]["name"]
                        // $arquivo[3]["name"]
                        // Dessa forma, fica mais facil trabalharmos o array depois, para salvar
                        // o arquivo
                        $arquivos[$i][$key] = $info[$key][$i];
                    }
                }
            }

            $i = 1;

            // Fazemos o upload normalmente, igual no exemplo anterior
            foreach ($arquivos as $file) {

                // Verificar se o campo do arquivo foi preenchido
                if ($file['name'] != '') {
                    $arquivoTmp = $file['tmp_name'];
                    $arquivo = $pathToSave . $file['name'];

                    if (!move_uploaded_file($arquivoTmp, $arquivo)) {
                        $msg[$i] = 'Erro no upload do arquivo ' . $i;
                    } else {
                        $msg[$i] = sprintf('Upload do arquivo %s foi um sucesso!', $i);
                    }
                } else {
                    $msg[$i] = sprintf('O arquivo %d nao foi preenchido', $i);
                }

                $i++;
            }

            // Imprimimos as mensagens geradas pelo sistema
            foreach ($msg as $e) {
                printf('%s<br>', $e);
            }
        }
        ?>
    </body>
</html>
