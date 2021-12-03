<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
            <META HTTP-EQUIV="Refresh" CONTENT="60">

                <title>.:: WEBMASTER.PT :: Redes de Computadores e o PHP ::.</title>

                <link rel="stylesheet" href="3col_rightNav.css" type="text/css">
                    </head>
                    <body>
                        <div id="masthead">
                            <h1 id="siteName">WEBMASTER.PT</h1>
                            <h2 id="pageName">Redes de Computadores e o PHP</h2>
                        </div>
                        <div id="content">

                            <h2>Monitoramento das estações / Servidores</h2>
                            <div class="story">
                                <?php
                                // altere a linha abaixo com seu email
                                $email_admin = "luis_itb@hotmail.com";

                                // inclui o ficheiro SERVIDOR.PHP
                                include "servidor.php";

                                if (isset($servidor)) {

                                    # inicio as variáveis
                                    $l = 0;
                                    $server_out = "";
                                    $f = 0;
                                    $alerta = "";

                                    for ($i = 0; $i < count($servidor); $i++) {

                                        $linha = explode(":", $servidor[$i]);
                                        $l++;

                                        # executo o ping e verifico se retornou algum byte
                                        $stream = shell_exec("ping -c 1 -t 1 " . $linha[0]);

                                        # se não retornou eu adiciono um contador, exibo na tela em vermelho os dados do servidor, impressoa ou roteador
                                        if (!ereg("bytes from", $stream)) {
                                            $a = "I";
                                            $f++;
                                            echo "

                                  <h2>" . $linha[1] . "</h2>
                                  IP: " . $linha[0] . "
                                  " . "Status:";

                                            $server_out .= "Nome: " . $linha[1] . "
                                  IP: " . $linha[0] . "

                                  ";

                                            # Adiciono mais uma tentativa ao meu contador, um arquivo texto desse servidor
                                            if (!file_exists("./" . $linha[0] . ".txt"))
                                                shell_exec('touch ' . $linha[0] . ".txt");

                                            $fp = fopen("./" . $linha[0] . ".txt", "r+");
                                            $t = fread($fp, 2);
                                            fclose($fp);

                                            # se já houve mais de 35 tentativas, envio um e-mail e zero o contador, lembrando que cada tentativa, tem um intervalo de 1 minuto
                                            if ($t >= 35) {
                                                $t = 3;
                                                $alerta = "ATENÇÃO, OUTROS ALERTAS JÁ FORAM EMITIDOS PARA ESSE(S) SERVIDOR(S):";
                                            } else
                                                $t++;

                                            # Caso seja o primeiro alerta (depois da 3ª tentativa ele envia um e-mail)
                                            if ($t == 4 && !$alerta)
                                                $alerta = "PRIMEIRO ALERTA! (3ª tentativa)";

                                            $fp = fopen("./" . $linha[0] . ".txt", "w");
                                            fwrite($fp, $t);

                                            fclose($fp);

                                            # Gravar Log Erro
                                            $fp2 = fopen("./ERR_" . date("d-m-Y") . ".txt", "a+");
                                            $txt = "\n" . date("d/m/Y - H:i:s") . "  \t\t" . $linha[0] . " \t\t" . $linha[1];
                                            fwrite($fp2, $txt);

                                            fclose($fp2);
                                        }

                                        # se não houve erro, ele exclui o arquivo de texto (contador) caso esteja criado pois o servidor voltou a responder, então exibo a tela com as informações normais como nome, ip, status e o desenho.
                                        else {
                                            echo "

                                  <h2>" . $linha[1] . "</h2>
                                  IP: " . $linha[0] . "
                                  " . "Status:";

                                            # Apaga o arquivo caso esteja pingando
                                            if (file_exists("./" . $linha[0] . ".txt"))
                                                unlink("./" . $linha[0] . ".txt");

                                            $a = "A";

                                            # gravo o acerto - só para ter um log
                                            # Gravar Log Acerto
                                            $fp2 = fopen("./OK_" . date("d-m-Y") . ".txt", "a+");
                                            $txt = "\n" . date("d/m/Y - H:i:s") . "  \t\t" . $linha[0] . " \t\t" . $linha[1];
                                            fwrite($fp2, $txt);

                                            fclose($fp2);
                                        }
                                        echo (ereg("bytes from", $stream)) ? " Ativo" : " Não responde ao ping";

                                        echo " ";

                                        if ($l == 4) {
                                            echo "

                                  ";
                                            $l = 0;
                                        }
                                    }

                                    # Preparando para o envio de e-mail

                                    if (isset($server_out) && $server_out && isset($alerta) && $alerta) {
                                        if ($f = 1)
                                            $server_out = "" . $alerta . "

                                  Os Servidores abaixo encontram-se indisponível:

                                  " . $server_out;
                                        if ($f > 1)
                                            $server_out = "" . $alerta . "

                                  Os Servidores abaixo encontram-se indisponíveis:

                                  " . $server_out;

                                        # formatando um e-mail, com uma tabela e as informações a serem enviadas
                                        $assunto = "ALERTA - Monitoramento de Servidores";
                                        $msg = "

                                  Alerta: " . date("d/m/Y - H:i:s") . "

                                  " . $server_out . "

                                  Sistema de Monitoramento<br>QSA Soluções Corporativas

                                  Este é um e-mail automático, por favor não responda essa mensagem.

                                  ";

                                        //adicionando o html no corpo do email
                                        echo "
                                  ";

                                        //enviando e retornando o status de envio
                                        if (mail($email_admin, $assunto, $msg))
                                            echo "Alerta Enviado para (Seu email)";
                                        else
                                            echo "Houve um erro ao  enviar o email! " . $mail->ErrorInfo;

                                        echo " ";
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </body>
                </html>