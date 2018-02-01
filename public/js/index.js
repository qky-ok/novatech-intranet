$(document).ready(function(){
    var dataTableId = '#index-data-table';
    var dataTable   = $(dataTableId);
    var container   = dataTable.parent();

    $(document).on('click', '.search-service', function(e){
        searchService();
    });

    $(document).on('keypress', '.service-search-form .form-control', function(e){
        if(e.which == 13){
            searchService();
        }
    });

    function searchService(){
        var search = $('input[name=service_search]').val();

        if(search != ''){
            hideError(container);
            showLoading(container);

            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

            $.ajax({
                url         : '/services/search/'+search,
                type        : 'GET',
                dataType    : 'json',
                success     : function(response){
                    if(!response.hasOwnProperty('error')){
                        var htmlData =
                            '<tr><td>'  + response.purchase_order_num +
                            '</td><td>' + response.date_in +
                            '</td><td>' + response.state +
                            '</td></tr>';

                        dataTable.find('tbody').html(htmlData);
                        dataTable.fadeIn('fast');
                        hideLoading(container);
                    }else{
                        triggerError(container);
                    }
                },
                error       : function(e){
                    triggerError(container);
                }
            });
        }

        return false;
    }

    function triggerError(container){
        hideLoading(container);

        if(dataTable.is(':visible')){
            dataTable.fadeOut(function(){
                showError(container);
            });
        }else{
            showError(container);
        }
    }

    function showError(container){
        var errorClass  = 'service-not-found';
        var error       = '<span class="'+errorClass+'">No se encontraron resultados</span>';
        $(error).prependTo(container).hide().fadeIn();
    }

    function hideError(container){
        var error = 'service-not-found';
        container.find('.'+error).fadeOut(function(){
            $(this).remove();
        });
    }

    function showLoading(container){
        var loadingClass    = 'loading';
        var loading         = '<span class="'+loadingClass+'"><img src="/img/logo-novatech.gif" /></span>';
        $(loading).prependTo(container).hide().fadeIn();
    }

    function hideLoading(container){
        var loading = 'loading';
        container.find('.'+loading).fadeOut(function(){
            $(this).remove();
        });
    }
});