// for Admin
$(document).ready(function(){
    // router
    // var url = document.location.toString();
    // if (url.match('#')) {
    //     $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
    // }
    // // Change hash for page-reload
    // $('.nav-tabs a').on('shown.bs.tab', function (e) {
    //     window.location.hash = e.target.hash;
    // });

    $('[data-toggle=tooltip]').tooltip();
    $('.chosen-select').chosen();

    // Change hash for page-reload
    $('div.table-responsive').on('change', '[name=sorting]', function (e) {
        var val = $(e.target).val();
        var id = $(e.target).attr('id').split('_')[1];
        $.get(window.location.href, {id: id, sorting: val}, function(data){
            location.reload();
        });
    });

    $('#confirmDelete').on('show.bs.modal', function (e) {
        $(this).find('strong').text($(e.relatedTarget).data('id'));
        $(this).find('form').attr('action', $(e.relatedTarget).data('action'));
    });

    $('[data-toggle="modalEdit"]').on('click', function (event) {
        var modal = $('#modalEdit')
        var button = $(this);
        $.get(window.location.pathname+'/'+button.parents('tr').data('id')+'/edit', function(data){
            modal.find('form').attr('action', window.location.pathname+'/'+button.parents('tr').data('id'));
            modal.find('.modal-body').html(data);
            modal.modal('show');
        }).done(function(){
            $('.chosen-select').chosen();
        });
        return false;
    });

    $('[data-toggle="modalCreate"]').on('click', function (event) {
        var modal = $('#modalCreate')
        $.get(window.location.pathname+'/create', function(data){
            modal.find('form').attr('action', window.location.pathname);
            modal.find('.modal-body').html(data);
            modal.modal('show');
        });
        return false;
    });

    $('body>.container-fluid').on('click', '.table-hover>tbody td:not(.list-checkbox):not(.controls)', function(event){
        var modal = $('#modalEdit')
        var button = $(this);
        $.get(window.location.pathname+'/'+button.parents('tr').data('id')+'/edit', function(data){
            modal.find('form').attr('action', window.location.pathname+'/'+button.parents('tr').data('id'));
            modal.find('form').prepend($('<input type="hidden" name="from" value="'+window.location.href+'">'));    // back link
            modal.find('.modal-body').html(data);
            modal.modal('show');
        }).done(function(){
            $('.chosen-select').chosen({width:"100%"});
        });
        return false;
    });

    //$( document ).ajaxComplete(function( event,request, settings ) {});

    $('body>.container-fluid').on('change', '#checkAll', function(event){
        window.console.log($(this).attr('checked'));
        $(this).parents('table').find('tbody .list-checkbox input[type="checkbox"]').prop('checked', $(this).is(':checked') ? true : false);
        return false;
    });

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