<?php
if(isset($_GET['n'])){
    $N = $_GET['n'];
}  else {
    $N = 3;
}
define('CHARMAX', 2 * $N + 3);
define('DISC_CHAR', '#');

$passo = 0;

$postes = [1 => [], 2 => [], 3 => []];

$colores = ['red', 'blue', 'green', 'magenta', 'purple', 'cyan', '#006699', 'orange'];

for ($i = 1; $i <= $N; $i++){
    $postes[1][] = $N - $i;
}
function hanoi($n, $origem, $trabalho, $destino){
    if($n > 0){
        hanoi($n - 1, $origem, $destino, $trabalho);
        mover($origem, $trabalho);
        mostrar();
        hanoi($n - 1, $destino, $trabalho, $origem);
    }
}
function mover($origem, $trabalho){
    global $postes;
    $elemento = array_pop($postes[$origem]);
    $postes[$trabalho][] = $elemento;
}
function mostrarDisco($n){
	global $colores;
	$espaco =( CHARMAX-(2 * $n + 1))/2;
	$color = $colores[$n % count($colores)];
	$str ="<span style='color: ".$color."'>".str_repeat("&nbsp;",$espaco);
	$str.= str_repeat(DISC_CHAR, $n * 2 + 1);
	$str.= str_repeat("&nbsp;",$espaco)."</span>";
	return $str;
}
function mostrarPoste($poste){
	global $postes;
	global $N;

	$espaco = (CHARMAX-1)/2;
	$coluna = str_repeat("&nbsp;",$espaco);
	$coluna.= "|".str_repeat("&nbsp;",$espaco);

	$str = $coluna."\n";

	$n_discos = count($postes[$poste]);
	if($n_discos){
		if($n_discos < $N){
			$n_aux=$N-$n_discos;
			while($n_aux--!=0){
				$str.= $coluna."\n";
			}
		}
		for($i = $n_discos-1; $i >= 0; $i--){
			$str.= mostrarDisco($postes[$poste][$i])."\n";
		}
	}else{
		for($i = 0; $i < $N; $i++){
			$str.= $coluna."\n";
		}
	}
	return $str;
}
function mostrar(){
    global $passo;
    $str = "<div class='solucao' id='passo_' .$passo. ><a name='passo_' .$passo. ></a>"; 
    $str .= "<table border='0' cellpadding='0' cellspacing='0'>";
    $str .= "<tr>";
    for($i = 1; $i <=3; $i++){
        $str .= "<td><pre>";
        $str .= mostrarPoste($i);
        $str .= "</pre></td>";
    }
    $str .= "</tr>";
    $str .= "<tr><td colspan='3'><pre>" .str_repeat("-", CHARMAX * 3). "</pre></td></tr>";
    $str .= "</table></div>";
    echo $str;
}
if(isset($_GET["n"])){
	mostrar();
	hanoi($N,1,3,2);
}
if(!isset($_GET["mostrar"])){?>
<a href="javascript:void(0)" onClick="anterior()" id="anterior">Anterior</a>
<a href="javascript:void(0)" onClick="pausaf()" id="pausa_link"><span id="pausa_span">Pausa</span><span id="play_span" style="display: none">Continuar</span></a>
<a href="javascript:void(0)" id="reiniciar_link" style="display: none" onClick="reiniciar()">Reiniciar</a>
<a href="javascript:void(0)" onClick="seguinte()" id="siguiente">Seguinte</a> 
<link href="include/css/TorreHanoi.css" type="text/css" rel='stylesheet'/>
<script src="include/js/TorreHanoi.js" type="text/javascript"></script>
<?php }