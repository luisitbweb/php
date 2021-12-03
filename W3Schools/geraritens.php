<?php
// INICIA SESSÃO
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
            Gerando itens...  
        </body>
    </html>
    <?php
    // CONEXÃO COM O BANCO
    require('../../Connections/cba.php');
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

    // SELECIONA A CONTAGEM ATUAL
    mysql_select_db($database_pneusvisa, $pneusvisa);
    $query_contagem = sprintf("SELECT id, id_estab, data, contagem FROM contagem "
            . "WHERE id_estab = " . $_GET['e'] . " AND data = %s AND dataa = %s AND "
            . "contagem = %s", GetSQLValueString($_GET['d'], "date"), GetSQLValueString($_GET['d2'], 
                    "date"), GetSQLValueString($_GET['c'], "int"));
    $contagem = mysql_query($query_contagem, $pneusvisa) or die(mysql_error());
    $row_contagem = mysql_fetch_assoc($contagem);
    $totalRows_contagem = mysql_num_rows($contagem);

    /// SE FOR A PRIMEIRA CONTAGEM
    if ($_GET['p'] == 0) {
        echo 'primeira';

        // CRIA TABELA TEMPORARIA
        $query = "CREATE TABLE #tt_sr0051 (
						f0125iditem int, 
						f0125nome varchar(50), 
						f0125locacao varchar(20), 
						f0125sublocacao varchar(20), 
						f0125multiplodeestoque float, 
						f0126sigla char(2), 
						f0125codfabricacao varchar(20),
						f0130nome varchar(20), 
						f0179nome varchar(20), 
						quantidadeentradas float,
						quantidadesaidas float, 
						movimentodiversosentrada float, 
						movimentodiversossaida float,
						diferencacontagem float,
						estoqueatual float,
						estoquereservado float)
					";
        $resp = odbc_exec($conexao, $query);

        // VERIFICA DEPOSITO E LINHA
        $dep = 1;

        // SE NÃO FOR RECAPAGEM
        if ($_GET['e'] != 19) {

            // EXECUTA PROCEDURE
            $query = "INSERT INTO #tt_sr0051 
						EXEC sr0051 
							1,
							NULL,
							" . $_GET['e'] . ",
							" . $dep . ",
							NULL,
							NULL,
							NULL,
							NULL,
							NULL,
							NULL,
							NULL,
							NULL,
							1,
							'',
							1,
							1,
							'" . $_GET['d'] . "',
							'" . $_GET['d2'] . "',
							1,
							'" . $_GET['d'] . "',
							'" . $_GET['d2'] . "',
							0,
							0,
							0
						";
            $resp = odbc_exec($conexao, $query);
            $query = "SELECT 
							#tt_sr0051.f0125iditem, 
							#tt_sr0051.f0125nome, 
							#tt_sr0051.f0125locacao, 
							#tt_sr0051.f0125sublocacao, 
							#tt_sr0051.f0125codfabricacao,
							#tt_sr0051.estoqueatual,
							t0125.f0109idgrupoitens,
							t0109.f0109nome
						FROM #tt_sr0051
						LEFT JOIN t0125
						ON #tt_sr0051.f0125iditem = t0125.f0125iditem
						LEFT JOIN t0109
						ON t0125.f0109idgrupoitens = t0109.f0109idgrupoitens
						";
            $resp = odbc_exec($conexao, $query);
            $row = odbc_fetch_array($resp);
            $total = odbc_num_rows($resp);

            do {
                if ($row['f0109idgrupoitens'] != 136) {
                    // INSERE CADA PRODUTO LOCALIZADO NA TABELA DE ITEM
                    $insertSQL = sprintf("INSERT INTO contagemitens (id_contagem, "
                            . "coditem, codfab, nomeitem, grupo, nomegrupo, locacao, "
                            . "depositoitem, saldoitem) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", 
                            GetSQLValueString($row_contagem['id'], "int"), GetSQLValueString($row['f0125iditem'], 
                                    "int"), GetSQLValueString($row['f0125codfabricacao'], "text"), 
                            GetSQLValueString($row['f0125nome'], "text"), GetSQLValueString($row['f0109idgrupoitens'], 
                                    "int"), GetSQLValueString($row['f0109nome'], "text"), 
                            GetSQLValueString($row['f0125locacao'], "text"), GetSQLValueString($dep, "int"), 
                            GetSQLValueString($row['estoqueatual'], "double"));

                    mysql_select_db($database_pneusvisa, $pneusvisa);
                    $Result1 = mysql_query($insertSQL, $pneusvisa) or die(mysql_error());
                }
            } while ($row = odbc_fetch_array($resp));

            //$query ="DROP TABLE #tt_sr0051";
            //$resp = odbc_exec($conexao, $query);
            // SE FOR RECAPAGEM, REALIZA O PROCEDIMENTO PARA DEPOSITO 2
        } else {
            // SELECIONA TODAS AS LINHAS
            $querylinha = "SELECT 
				f0146idlinhaitens
			FROM t0146
			WHERE f0146ativo = 1";
            $resplinha = odbc_exec($conexao, $querylinha);
            $rowlinha = odbc_fetch_array($resplinha);
            $totallinha = odbc_num_rows($resplinha);

            // VERIFICA TODAS AS LINHAS
            do {
                // VERIFICA SESSÃO LINHA 6 (materia prima)
                if ($rowlinha['f0146idlinhaitens'] == '6') {
                    $dep = 2;
                } else {
                    $dep = 1;
                }

                // Executa STORED PROCEDURE ---------- MUDEI AQUI
                /*
                  $query = "CREATE TABLE #tt_sr0051 (
                  f0125iditem int,
                  f0125nome varchar(50),
                  f0125locacao varchar(20),
                  f0125sublocacao varchar(20),
                  f0125multiplodeestoque float,
                  f0126sigla char(2),
                  f0125codfabricacao varchar(20),
                  f0130nome varchar(20),
                  f0179nome varchar(20),
                  quantidadeentradas float,
                  quantidadesaidas float,
                  movimentodiversosentrada float,
                  movimentodiversossaida float,
                  diferencacontagem float,
                  estoqueatual float,
                  estoquereservado float)";

                  $resp = odbc_exec($conexao, $query);
                 */
                $query = "INSERT INTO #tt_sr0051 
							EXEC sr0051 
								1,
								NULL,
								" . $_GET['e'] . ",
								" . $dep . ",
								NULL,
								NULL,
								" . $rowlinha['f0146idlinhaitens'] . ",
								NULL,
								NULL,
								NULL,
								NULL,
								NULL,
								1,
								'',
								1,
								1,
								'" . $_GET['d'] . "',
								'" . $_GET['d2'] . "',
								1,
								'" . $_GET['d'] . "',
								'" . $_GET['d2'] . "',
								0,
								0,
								0
							";
                $resp = odbc_exec($conexao, $query);
            } while ($rowlinha = odbc_fetch_array($resplinha)); // FIM DO VERIFICA LINHA

            $query = "SELECT 
							#tt_sr0051.f0125iditem, 
							#tt_sr0051.f0125nome, 
							#tt_sr0051.f0125locacao, 
							#tt_sr0051.f0125sublocacao, 
							#tt_sr0051.f0125codfabricacao,
							#tt_sr0051.estoqueatual,
							t0125.f0109idgrupoitens,
							t0109.f0109nome
						FROM #tt_sr0051
						LEFT JOIN t0125
						ON #tt_sr0051.f0125iditem = t0125.f0125iditem
						LEFT JOIN t0109
						ON t0125.f0109idgrupoitens = t0109.f0109idgrupoitens
						";
            $resp = odbc_exec($conexao, $query);
            $row = odbc_fetch_array($resp);
            $total = odbc_num_rows($resp);

            // SE HOUVER REGISTRO
            if ($total > 0) {
                do {
                    if ($row['f0109idgrupoitens'] != 136) {
                        // INSERE CADA PRODUTO LOCALIZADO NA TABELA DE ITEM
                        $insertSQL = sprintf("INSERT INTO contagemitens (id_contagem, "
                                . "coditem, codfab, nomeitem, grupo, nomegrupo, locacao, "
                                . "depositoitem, saldoitem) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", 
                                GetSQLValueString($row_contagem['id'], "int"), GetSQLValueString($row['f0125iditem'], "int"), 
                                GetSQLValueString($row['f0125codfabricacao'], "text"), GetSQLValueString($row['f0125nome'], 
                                        "text"), GetSQLValueString($row['f0109idgrupoitens'], "int"), 
                                GetSQLValueString($row['f0109nome'], "text"), GetSQLValueString($row['f0125locacao'], "text"), 
                                GetSQLValueString($dep, "int"), GetSQLValueString($row['estoqueatual'], "double"));

                        mysql_select_db($database_pneusvisa, $pneusvisa);
                        $Result1 = mysql_query($insertSQL, $pneusvisa) or die(mysql_error());
                    }
                } while ($row = odbc_fetch_array($resp));
            }
        } // FIM DO VERIFICA SESSÃO RECAPAGEM
        // EXCLUI TABELA TEMPORARIA
        $query = "DROP TABLE #tt_sr0051";
        $resp = odbc_exec($conexao, $query);

        // GERA OS REGISTROS DO DEPOSITO DE GRANTIA
        // CRIA TABELA TEMPORARIA
        $query = "CREATE TABLE #tt_sr0051 (
						f0125iditem int, 
						f0125nome varchar(50), 
						f0125locacao varchar(20), 
						f0125sublocacao varchar(20), 
						f0125multiplodeestoque float, 
						f0126sigla char(2), 
						f0125codfabricacao varchar(20),
						f0130nome varchar(20), 
						f0179nome varchar(20), 
						quantidadeentradas float,
						quantidadesaidas float, 
						movimentodiversosentrada float, 
						movimentodiversossaida float,
						diferencacontagem float,
						estoqueatual float,
						estoquereservado float)
					";

        // VERIFICA DEPOSITO E LINHA
        $dep = 3;

        // EXECUTA PROCEDURE
        $resp = odbc_exec($conexao, $query);
        $query = "INSERT INTO #tt_sr0051 
					EXEC sr0051 
						1,
						NULL,
						" . $_GET['e'] . ",
						" . $dep . ",
						NULL,
						NULL,
						NULL,
						NULL,
						NULL,
						NULL,
						NULL,
						NULL,
						1,
						'',
						1,
						1,
						'" . $_GET['d'] . "',
						'" . $_GET['d2'] . "',
						1,
						'" . $_GET['d'] . "',
						'" . $_GET['d2'] . "',
						0,
						0,
						0
					";
        $resp = odbc_exec($conexao, $query);
        $query = "SELECT 
						#tt_sr0051.f0125iditem, 
						#tt_sr0051.f0125nome, 
						#tt_sr0051.f0125locacao, 
						#tt_sr0051.f0125sublocacao, 
						#tt_sr0051.f0125codfabricacao,
						#tt_sr0051.estoqueatual,
						t0125.f0109idgrupoitens,
						t0109.f0109nome
					FROM #tt_sr0051
					LEFT JOIN t0125
					ON #tt_sr0051.f0125iditem = t0125.f0125iditem
					LEFT JOIN t0109
					ON t0125.f0109idgrupoitens = t0109.f0109idgrupoitens
					";
        $resp = odbc_exec($conexao, $query);
        $row = odbc_fetch_array($resp);
        $total = odbc_num_rows($resp);

        // SE HOUVER REGISTRO
        if ($total > 0) {

            do {
                if ($row['f0109idgrupoitens'] != 136) {
                    // INSERE CADA PRODUTO LOCALIZADO NA TABELA DE ITEM
                    $insertSQL = sprintf("INSERT INTO contagemitens (id_contagem, "
                            . "coditem, codfab, nomeitem, grupo, nomegrupo, locacao, "
                            . "depositoitem, saldoitem) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", 
                            GetSQLValueString($row_contagem['id'], "int"), GetSQLValueString($row['f0125iditem'], 
                                    "int"), GetSQLValueString($row['f0125codfabricacao'], "text"), 
                            GetSQLValueString($row['f0125nome'], "text"), GetSQLValueString($row['f0109idgrupoitens'], 
                                    "int"), GetSQLValueString($row['f0109nome'], "text"), GetSQLValueString($row['f0125locacao'], 
                                    "text"), GetSQLValueString($dep, "int"), GetSQLValueString($row['estoqueatual'], "double"));

                    mysql_select_db($database_pneusvisa, $pneusvisa);
                    $Result1 = mysql_query($insertSQL, $pneusvisa) or die(mysql_error());
                }
            } while ($row = odbc_fetch_array($resp));
        }

        $query = "DROP TABLE #tt_sr0051";
        $resp = odbc_exec($conexao, $query);

        // SE FOR SEGUNDA CONTAGEM OU MAIS
    } else {
        echo '> segunda';

        // SELECIONA A CONTAGEM ANTERIOR, SOMENTE ITENS COM DIFERENÇA DE ESTOQUE
        mysql_select_db($database_pneusvisa, $pneusvisa);
        $query_relatorio = sprintf("SELECT 
								   	id_contagem, 
									coditem, 
									codfab, 
									nomeitem,
									grupo, 
									nomegrupo, 
									locacao, 
									depositoitem, 
									saldoitem, 
									reservaitem, 
									saldocont, 
									situacao 
								FROM contagemitens 
								WHERE id_contagem = " . 
                $_GET['p'] . " AND situacao = 'S'");
        $relatorio = mysql_query($query_relatorio, $pneusvisa) or die(mysql_error());
        $row_relatorio = mysql_fetch_assoc($relatorio);
        $totalRows_relatorio = mysql_num_rows($relatorio);

        // INSERE CADA PRODUTO LOCALIZADO NA TABELA DE ITEM
        do {
            $insertSQL = sprintf("INSERT INTO contagemitens (id_contagem, coditem, "
                    . "codfab, nomeitem, grupo, nomegrupo, locacao, depositoitem, saldoitem) "
                    . "VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", GetSQLValueString($row_contagem['id'], "int"), 
                    GetSQLValueString($row_relatorio['coditem'], "int"), GetSQLValueString($row_relatorio['codfab'], 
                            "text"), GetSQLValueString($row_relatorio['nomeitem'], "text"), 
                    GetSQLValueString($row_relatorio['grupo'], "int"), GetSQLValueString($row_relatorio['nomegrupo'], 
                            "text"), GetSQLValueString($row_relatorio['locacao'], "text"), 
                    GetSQLValueString($row_relatorio['depositoitem'], "int"), 
                    GetSQLValueString($row_relatorio['saldoitem'], "double"));

            mysql_select_db($database_pneusvisa, $pneusvisa);
            $Result1 = mysql_query($insertSQL, $pneusvisa) or die(mysql_error());
        } while ($row_relatorio = mysql_fetch_assoc($relatorio));
    }

    // REDIRECIONA PARA A TELA DE LISTAGEM DOS ITENS
    if ($_GET['c'] != 4) {
        echo "<script>window.location.href='vercont.php?id=" . $row_contagem['id'] . "&tipo=" . $_GET['tipo'] . "'</script>";
    } else {
        echo "<script>window.location.href='vercontjusti.php?id=" . $row_contagem['id'] . "&tipo=" . $_GET['tipo'] . "'</script>";
    }
    mysql_free_result($contagem);
}// fim do verifica sessao