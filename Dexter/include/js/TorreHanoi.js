/* global $N*/
var passo = 0;
var pausa = false;

(function mostrar(){
	if(passo < pow(2,$N)-1 && !pausa){
		seguinte();
	}else{
        pausa=true;
    }
    if(passo == pow(2,$N)-1){
        document.getElementById("pausa_link").style.display = "none";
        document.getElementById("reiniciar_link").style.display = "inline";
    }
},500);

function reiniciar(){
    document.getElementById("passo_" + passo).style.display = "none";
    passo = 0;
    document.getElementById("passo_" + passo).style.display = "block";
    document.getElementById("pausa_link").style.display = "inline";
    document.getElementById("reiniciar_link").style.display = "none";
    document.getElementById("pausa_span").style.display = "none";
    document.getElementById("play_span").style.display = "inline";
}
function pausaf(){
    pausa = !pausa;
    if(pausa){
        document.getElementById("pausa_span").style.display = "none";
        document.getElementById("play_span").style.display = "inline";
    }else{
        document.getElementById("pausa_span").style.display = "inline";
        document.getElementById("play_span").style.display = "none";
    }
}
function seguinte(){
    if(passo < pow(2, $N) -1){
        document.getElementById("passo_" + passo).style.display = "none";
        passo++;
        document.getElementById("passo_" + passo).style.display = "block";
    }
}
function anterior(){
    if(passo > 0){
        document.getElementById("passo_" + passo).style.display = "none";
        passo--;
        document.getElementById("passo_" + passo).style.display = "block";
    }
}