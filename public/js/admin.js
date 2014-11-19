// for Admin
$(document).ready(function(){
    // router
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
    }

    $('[tooltip]').tooltip();

    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    });

    // Change hash for page-reload
    $('div.table-responsive').on('change', '[name=sorting]', function (e) {
        var val = $(e.target).val();
        var id = $(e.target).attr('id').split('_')[1];
        $.get(window.location.href, {id: id, sorting: val}, function(data){
            location.reload();
        });
    });

    $('#confirm_delete').on('show.bs.modal', function (e) {
        $(this).find('strong').text($(e.relatedTarget).data('id'));
        $(this).find('form').attr('action', $(e.relatedTarget).data('action'));
    })
});

function delete_row(elem)
{
    $(elem).parents('.col-sm-7').remove();
    return false;
}

function clone_row(template)
{
    var t = $('#'+template);
    t.clone().removeAttr('id').insertAfter(t).fadeIn();
    return false;
}

function select_product(elem)
{
    $(elem).parents('.col-sm-7').find('input[type=number]').attr('name', 'contents['+$(elem).val()+'][quantity]');
    return false;
}

// angular code
(function() {
    var app = angular.module('admin');

    app.controller('IndexController', ['$http', function($http){
        var store = this;

        store.products = [];

        $http.get('/products.json').success(function(data){
            store.products = data;
        });
    }]);
})();