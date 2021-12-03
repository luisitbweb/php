<?php

require_once('connect.php');

function inserir($tabela, $dados){
	foreach( $dados as $campo => $valor ){
		$campos[]  = "`$campo`";
		$valores[] = "'$valor'";
	}
	$campos  = implode( ",", $campos ); //login,senha
	$valores = implode( ",", $valores ); //'maria','123456'
	$sql = "INSERT INTO `$tabela` ($campos)VALUES($valores)";
	return mysql_query( $sql );
}

function alterar($tabela, $dados, $onde){
	foreach( $dados as $campo => $valor ):
		$sets[] = "$campo = '$valor'";
	endforeach;
	$sets = implode(",", $sets);// login = 'maria', senha = '123456'
	$sql = "UPDATE $tabela SET $sets WHERE id_prf=$onde";
	return mysql_query($sql);
}


function excluir($tabela, $onde) {
	$sql = "DELETE FROM `$tabela` WHERE id_prf=$onde";
	return mysql_query( $sql );
}

function listar($tabela, $onde = NULL){
	if($onde){
		$sql = "SELECT * FROM $tabela WHERE id_prf=$onde";
	} else {
		$sql = "SELECT * FROM $tabela";
	}
	$query = mysql_query($sql);
    return mysql_fetch_all($query);
}


function mysql_fetch_all ($result, $result_type = MYSQL_BOTH)
    {
        if (!is_resource($result) || get_resource_type($result) != 'mysql result')
        {
            trigger_error(__FUNCTION__ . '(): supplied argument is not a valid MySQL result resource', E_USER_WARNING);
            return false;
        }
        if (!in_array($result_type, array(MYSQL_ASSOC, MYSQL_BOTH, MYSQL_NUM), true))
        {
            trigger_error(__FUNCTION__ . '(): result type should be MYSQL_NUM, MYSQL_ASSOC, or MYSQL_BOTH', E_USER_WARNING);
            return false;
        }
        
		$rows = array();
        while ($row = mysql_fetch_array($result, $result_type))
        {
            $rows[] = $row;
        }
        return $rows;
    }