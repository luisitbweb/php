<?php require_once('../../Connections/pneusvisa.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }

}


//INICIA SESS�O
session_start("acesso");

// VERIFICA SE USUARIO EST� LOGADO
if ((isset($_SESSION['logado'])) and ( $_SESSION['logado'] == "Sim")) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8" />
            <title>Assinatura de E-mail Padrão</title>
            <link rel="stylesheet" type="text/css" href="../../stilos.css"/>
            <link href="../../img/logo_pneusvisa_ico.png" rel="icon" type="image/x-icon" />
            <!--[if IE]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
        </head>
        <body>
            <div id="pagina">
                <div id="topo"><header><a href="../index.php"><img src="../../img/systi.png" width="200" height="50" title="SYS TI" alt="SYS TI" border="0"><img src="../../img/logo_pneusvisa.jpg" alt="Pneus Visa" width="161" height="46" border="0" title="Pneus Visa" /></a></header>
                </div>
                <div id="menu">
    <?php echo $_SESSION['estab_nome'] . " - " . $_SESSION['nome']; ?> - <a href="../sair.php">SAIR</a>
                </div>
                <div id="conteudonovo">
                    <h1 class="h1">FORMUL&Aacute;RIO PARA GERA&Ccedil;&Atilde;O DE ASSINATURA DE E-MAIL PADR&Atilde;O.</h1>
                    <div id="meio">
                        <div id="voltar"><a href="../">IN&Iacute;CIO</a> &gt; ASSINATURA DE E-MAIL</div>
                        <div style="margin:0 auto;">
                            <form action="gera.php" target="_blank" method="post">
                                <table width="100%">
                                    <tr>
                                        <td><strong>Empresa:</strong></td>
                                        <td>
                                            <input name="radio" type="radio" id="radio" value="ac" <?php if ($_SESSION['sempresa'] == 'PNEUS VISA') {
        echo 'checked';
    } ?>>                                    Pneus Visa<br />
                                            <input type="radio" name="radio" id="radio" value="gb" <?php if ($_SESSION['sempresa'] == 'GOYAZ BRITAS') {
        echo 'checked';
    } ?>>Goyaz Britas
                                            <br />
                                            <input type="radio" name="radio" id="radio" value="c">Pneus Visa / Goyaz Britas
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%"><strong>Nome:</strong></td>
                                        <td width="85%">
                                            <input name="nome" type="text" value="<?php echo substr($_SESSION['nome'], 0, 41); ?>" size="50" maxlength="42" placeholder="Informe seu nome completo."  style="text-transform:uppercase" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fun&ccedil;&atilde;o:</strong></td>
                                        <td>
                                            <input name="cargo" type="text" size="40" placeholder="Ex.: Consultor de Vendas / Gerente Comercial"  style="text-transform:uppercase" required autofocus>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Telefone Fixo:</strong></td>
                                        <td>
                                            <input name="ddd" type="text" size="5" maxlength="2" placeholder="Ex.: 64" required>|<input name="tel1" type="text" size="15" maxlength="9" placeholder="Ex.: 3430-0800" required> 
                                            <span style="font-size:12px; color:#666">(informe o telefone fixo da empresa)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Celular:</strong></td>
                                        <td>
                                            <input name="ddd2" type="text" size="5" maxlength="2" placeholder="Ex.: 64" required>|<input name="cel" type="text" size="15" maxlength="10" placeholder="Ex.: 99999-9999" required>
                                            <span style="font-size:12px; color:#666">(informe o celular que voc&ecirc; usa na empresa)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>E-mail:</strong></td>
                                        <td><input name="email" type="email" size="50" placeholder="Ex.: email@pneusvisa.com.br" required></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Skype:</strong></td>
                                        <td><input name="skype" type="text" size="40" placeholder="Ex.: pneusvisa.itumbiara"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Endere&ccedil;o:</strong></td>
                                        <td>
                                            <select name="endereco">
                                                <option>--- PNEUS VISA ---</option>
                                                <option>Av. Washington Luiz, N. 1937 - Vila Santana - Ed&eacute;ia-GO</option>
                                                <option>Rua Manoel Vitorino da Silva, N. 500 - Jardim Santa Paula - Goiatuba-GO</option>
                                                <option>Av. Vicente Ferreira, N. 655 - Setor Centro - Vicentin&oacute;polis-GO</option>
                                                <option>Av. Presidente Vargas, N. 2222 - Setor Jardim Goi&aacute;s - Rio Verde-GO</option>
                                                <option>Av. Anhanguera, N. 566 - Setor Anhanguera - Itumbiara-GO </option>
                                                <option>Av. Pio XII, N. 805 - Vila Aurora Oeste - Goiania-GO </option>
                                                <option>Av. Rio Verde, N. 1232 - Setor dos Afonsos - Goiania-GO </option>
                                                <option>Av. Celso Maeda, N. 1.920 - Setor Santa Rita - Itumbiara-GO</option>
                                                <option>Rua Maring&aacute; s/n Quadra 02 Lote 13 - Castelo Branco - Catal&atilde;o-GO </option>
                                                <option>Av. Goi&aacute;s Quadra 03 Lote 12, N. 3262 - Lot Nossa Senhora D' Abadia - Gurupi-TO</option>
                                                <option></option>
                                                <option>--- GOYAZ BRITAS --- </option>
                                                <option>Rod. GO 210 KM 2,5, S/N - Zona Rural - Panam&aacute;-GO</option>
                                                <option>Rod. BR 452 KM 187,5 - Zona Rural - Itumbiara-GO</option>
                                                <option>Rod. BR 452 KM 37 - Zona Rural - Santa Helena-GO</option>
                                                <option>Rod. BR 050 KM 245,5 - Zona Rural - Catal&atilde;o-GO</option>
                                                <option>Rod. GO 010 KM 35 a Direita - Zona Rural - Silv&acirc;nia-GO </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><br /><input type="submit"value="Gerar Assinatura" id="button"></td>
                                    </tr>
                                </table>
                                <br />
                                <hr />
                                <p>Em caso de d&uacute;vidas ou problemas, abrir um chamado no <a href="http://200.146.202.82:9090/glpi" title="Acessar GLPI" target="_blank">GLPI</a>.</p>
                            </form>
                        </div>
                    </div>
                </div>
                <footer id="desenvolvido"><?php echo $_SESSION['footer']; ?></footer>
            </div>
        </body>
    </html>
    <?php
// SE N�O ESTIVER LOGADO ABRE TELA DE LOGIN
} else {
    echo "<script>window.location.href='../'</script>";
}
?>