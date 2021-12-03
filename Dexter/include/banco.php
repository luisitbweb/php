<?php

	function conectar(){
		//Conexão com o banco de dados;
            $user = 'luisitb';
            $pass = '$tr@wb3rry';
		return new PDO( 'mysql:host=localhost; dbname=db_dexter', $user, $pass);
	}

	function inserir($tabela, $dados){
		//insert into tabela(campo1,campo2,campo3....)values(valor1,valor2,valor3,valor4)
		foreach( $dados as $campo => $valor ){//Separa o post em campos e valores
			$campos[]  = $campo;//Monta um array somente com os campos
			$valores[] = "'$valor'"; //Monta um array somente como os valores
		}
		$campos  = implode( ",", $campos );//Converte o array em string separando por virgula (Campos)
		$valores = implode( ",", $valores );//Converte o array em string separando por virgula (Valores)
		$sql = "insert into $tabela ( $campos ) values ( $valores )";
		return pg_query( $sql );//Insere o registro no banco
	}

	function alterar($tabela, $dados, $onde){
		//update tabela set campo1 = 'valor1',campo2='valor2'.... where id=5
		foreach( $dados as $campo=>$valor ){
			$sets[] = "$campo = '$valor'";
		}
			$sets = implode( ",", $sets );
			$sql = "update $tabela set $sets where $onde ";
			//die($sql);
			return pg_query( $sql );
	}

	function excluir($tabela, $onde=null) {
		//delete from $tabela where condicao
		$sql = "delete from $tabela";
		if( $onde ){
			$sql .= " where $onde";
		}
		//die($sql);

		return pg_query( $sql );
	}

	function listar($tabela, $campos = "*", $onde=null, $filtro=null, $ordem=null, $limite=null){

		$sql = "select $campos from $tabela";


		if( $onde ){
			$sql .= " where $onde"; //exemplo  nome = maria;
		}elseif( $filtro ){
			$sql .= " where $filtro"; //exemplo nome like '%maria%'
		}

		if( $ordem ){
			$sql .= " order by $ordem";
		}

		if( $limite ){
			$sql .= " limit $limite";
		}

		$query = pg_query( $sql );

		return pg_fetch_all( $query );

	}

	function ver($tabela, $onde, $campos = "*"){
			$sql = "select $campos from $tabela where $onde";
			#die( $sql );
			$query = pg_query( $sql ); //prepara a consulta
			return pg_fetch_array( $query );//determina o tipo de retorno
	}