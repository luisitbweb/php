<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>Personalizando pagina de erros Apache!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <?php
            require 'source/vendor/autoload.php';

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

// Autenticação
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
                $mail->isSMTP();                       // Send using SMTP
                $mail->Host = 'smtp.office365.com';    // Set the SMTP server to send
                $mail->SMTPAuth = true;                // Enable SMTP authentication
                $mail->Username = 'luiscarlosss2018@outlook.com'; // SMTP username
                $mail->Password = 'duo41chiCuo';                  // SMTP password
                $mail->SMTPSecure = 'STARTTLS';                     // Enable TLS encrypt
                $mail->Port = 587;                            // TCP port to connect to
                $mail->setLanguage('br');
                $mail->CharSet = 'utf-8';
                $mail->isHTML(true);

                //Recipients
                $mail->setFrom('luiscarlosss2018@outlook.com', 'Luis Carlos');
                $mail->addAddress('luis_itb@hotmail.com', 'Luis Carlos');     // Add a recipient
                $mail->addAddress('d.luiscarlos92@gmail.com', 'Luis Carlos');               // Name is optional
                $mail->addReplyTo('ti1@pneusvisa.com.br', 'Information');
                $mail->addCC('luis_itb@hotmail.com');
                $mail->addBCC('d.luiscarlos92@gmail.com');

                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                // Content
                $mail->isHTML(true);                     // Set email format to HTML

                $now = (isset($_SERVER['REQUEST_TIME'])) ? $_SERVER['REQUEST_TIME'] : time();
                $page = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : 'Desconhecido';
                $msg = 'Um erro ' . wordwrap($_SERVER['QUERY_STRING'] . ' foi encontrado ' .
                                date('F d, Y', $now) . ' na ' . date('H:i:sa T', $now) .
                                ' <br />quando um visitante tentou visualizar <br />' . $page . '.');

                // Message
                $message = <<<MSG
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>Um Erro Foi Encontrado Servidor</title>
                    </head>
                    <body>
                        <p>Mensagem Personalizada...</p>
                        <table>
                            <tr>
                                <th>Pagina $page</th>
                            </tr>
                            <tr>
                                <td>$msg</td>
                            </tr>
                        </table>
                    </body>
                </html>
            MSG;
                $mail->Subject = 'E-mail teste automatico';
                $mail->Body = $message;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                switch ($_SERVER['QUERY_STRING']) {
                    case "No input file specified.":
                        echo '<h1>Requisição ruim!</h1>';
                        echo '<h2>Entrada diretorio proibida.</h2>';
                        echo '<p>O navegador tem feito um pedido invalido.</p>';
                        break;
                    case 400:
                        echo '<h1>Requisição ruim!</h1>';
                        echo '<h2>Codigo de erro 400.</h2>';
                        echo '<p>Essa resposta significa que o servidor não entendeu a requisição pois esta com uma sintaxe invalida.</p>';
                        break;
                    case 401:
                        echo '<h1>Autorização obrigatoria!</h1>';
                        echo '<h2>Codigo de erro 401.</h2>';
                        echo '<p>Embora o padrão HTTP especifique "unauthorized", semanticamente, essa resposta significa "unauthenticated". Ou seja, o cliente deve se autenticar para obter a resposta solicitada.</p>';
                        break;
                    case 402:
                        echo '<h1>Acesso proibido!</h1>';
                        echo '<h2>Codigo de erro 402.</h2>';
                        echo '<p>Este c�digo de resposta esta reservado para uso futuro. O objetivo inicial da criação deste codigo era usa-lo para sistemas digitais de pagamento porem ele não esta sendo usado atualmente.</p>';
                        break;
                    case 403:
                        echo '<h1>Acesso proibido!</h1>';
                        echo '<h2>Codigo de erro 403.</h2>';
                        echo '<p>O cliente não tem direitos de acesso ao conteudo portanto o servidor esta rejeitando dar a resposta</p>';
                        break;
                    case 404:
                        echo '<h1>Pagina não encontrada!</h1>';
                        echo '<h2>Codigo de erro 404.</h2>';
                        echo '<p>O servidor não pode encontrar o recurso solicitado. Este codigo de resposta talvez seja o mais famoso devido a frequencia com que acontece na web.</p>';
                        break;
                    case 500:
                        echo '<h1>Erro interno no servidor!</h1>';
                        echo '<h2>Codigo de erro 500.</h2>';
                        echo '<p>O servidor encontrou uma situação com a qual não sabe lidar.</p>';
                        break;
                    case 503:
                        echo '<h1>Erro interno no servidor!</h1>';
                        echo '<h2>Codigo de erro 503.</h2>';
                        echo '<p>O servidor não esta pronto para manipular a requisição. Causas comuns são um servidor em manutenção ou sobrecarregado.</p>';
                        break;
                    default :
                        echo '<h1>Pagina com erro!</h1>';
                        echo '<p>Essa e uma pagina de erro customizada.</p>';
                }
                echo '<p><a href="mailto:luiscarlosss2018@outlook">Contate</a> o administrador do sistema se voce sentir que este seja um erro.</p>';

                $mail->send();
                echo '<h1>Mensagem enviada com sucesso</h1>';
            } catch (Exception $exception) {
                echo 'Message could not be sent.';
                echo "Mailer Error:  {$mail->ErrorInfo}";
            }
            ?>
        </div>
    </body>
</html>