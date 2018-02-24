$(document).ready(function(){
    $('a.img-btn-gallery').colorbox({
        "rel"       : "parts",
        "width"     : "75%",
        "height"    : "75%",
        "current"   : "imagen {current} de {total}",
        "previous"  : "previa",
        "next"      : "próxima",
        "close"     : "cerrar",
        "imgError"  : "La imagen falló al cargar"
    });
});