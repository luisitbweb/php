window.onload = function () {
    // atribui change_postcard_image para campo selecionado
    var s = document.getElementById('postcard_select');
    s.onchange = change_postcard_image;
};

function change_postcard_image() {
    var s = document.getElementById('postcard_select');
    var i = document.getElementById('postcard');
    var x = s.options.selectedIndex;

    // atualiza image src e alt atributo
    i.src = s.options[x].value;
    i.alt = s.options[x].text;
}