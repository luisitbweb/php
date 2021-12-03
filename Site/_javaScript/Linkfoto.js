/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function mudaFace (foto){
	document.getElementById("face").onmousemove = foto;
}

function mudaTwitter (link){
    document.getElementById("twitter").src = link;
}
function ola(x){
    if(x.checked === true){
        document.getElementById("ola").style.WebkitBackfaceVisibility = "visible";
        document.getElementById("ola").style.backfaceVisibility = "visible";
    }else{
        document.getElementById("ola").style.WebkitBackfaceVisibility = "hidden";
        document.getElementById("ola").style.backfaceVisibility = "hidden";
    }
}