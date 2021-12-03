<?php
// INICIA SESSï¿½O
session_start("acesso");

// VERIFICA SE USUARIO ESTAÇÃO LOGADO
if ((isset($_SESSION['logado'])) and ( $_SESSION['logado'] == "Sim")) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <link href="../../img/logo_pneusvisa_ico.png" rel="icon" type="image/x-icon" />
            <title>Gerando...</title>
        </head>

        <body>
            Gerando contagem...
        </body>
    </html>
    <?php
    // CONECTA NO BANCO
    require_once('../../Connections/pneusvisa.php');

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

    $editFormAction = $_SERVER['PHP_SELF'];
    if (isset($_SERVER['QUERY_STRING'])) {
        $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
    }

    // CALCULA QUANTIDADE DE CONTAGENS E ADICION +1 SE NÃO FOR A PRIMEIRA
    $contagem = 1;
    if (isset($_GET['c'])) {
        $contagem = $_GET['c'] + 1;
    }

    // INSERE REGISTROS DE CONTAGEM
    $insertSQL = sprintf("INSERT INTO contagem (id_estab, id_usuario, tipo, `data`, "
            . "`dataa`, status, contagem, dif) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", 
            GetSQLValueString($_GET['e'], "int"), GetSQLValueString($_SESSION['id_usr'], "int"), 
            GetSQLValueString($_GET['tipo'], "text"), GetSQLValueString($_GET['d'], "date"), 
            GetSQLValueString($_GET['d2'], "date"), GetSQLValueString("A", "text"), 
            GetSQLValueString($contagem, "int"), GetSQLValueString("S", "text"));

    mysql_select_db($database_pneusvisa, $pneusvisa);
    $Result1 = mysql_query($insertSQL, $pneusvisa) or die(mysql_error());

    // REDIRECIONA PARA GERAÇÃO DOS ITENS
    echo "<script>window.location.href='geraritens.php?e=" . $_GET['e'] . "&d=" . 
            $_GET['d'] . "&d2=" . $_GET['d2'] . "&c=" . $contagem . "&p=" . $_GET['p'] . 
            "&tipo=" . $_GET['tipo'] . "'</script>";
} // fim verifica sessão