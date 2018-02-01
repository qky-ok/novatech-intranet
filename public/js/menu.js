$(document).ready(function(){
    $(document).on('click', '.dropdown-toggle', function(){
        var menuElement = $('.dropdown-menu');
        if(menuElement.is(':visible')){
            menuElement.hide();
        }else{
            menuElement.show();
        }
    });
});