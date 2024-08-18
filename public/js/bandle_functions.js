var TOKEN = $('meta[name="csrf-token"]').attr('content');

function bandle_items_load(type_view) {
    $.ajax({
        url: "/api",
        method: "post",
        dataType: "html",
        data: {_token: TOKEN, Type: 'Bandle', func: 'items_load', type_view: type_view}
    }).done(function(data){
        $("#bandle_container").html(data);
        let timeout = 0;
        let check = 0;
        $('.bundle_action').mousedown(function(e) {
            let id = $(e.currentTarget).attr('id').replaceAll('bandle_', '');
            check = 1;
            oneSecondTimer = setTimeout(function() {
                bandle_renew_item(id);
                check = 0;
            }, 500);

            return false;
        });

        $(".bundle_action").mouseup(function(e) {
            let id = $(e.currentTarget).attr('id').replaceAll('bandle_', '');
            if(check) {
                location.href = "/bandle/"+id;
            }
            clearTimeout(oneSecondTimer);
        });

    }).fail(function(data){
        console.log(data);
    });
}

function bandle_renew_item(id, Func = '') {
    
    $.ajax({
        url: "/api",
        method: "post",
        dataType: "html",
        data: {_token: TOKEN, Type: 'Bandle', func: 'renew_item', id: id, Func: Func}
    }).done(function(data){
        $("#modal").html(data);
    }).fail(function(data){
        console.log(data);
    });
}

function bandle_renew_item_send(id, Func = '') {
    let title = $('#title').val();
    let description = $('#description').val();
    $.ajax({
        url: "/api",
        method: "post",
        dataType: "html",
        data: {_token: TOKEN, Type: 'Bandle', func: 'renew_item_send', id: id, title: title, description: description}
    }).done(function(data){
        console.log(data);
        if(data > 0) {
            if(Func == "location") {
                location.reload();
            } else {
                bandle_items_load(0);
            }
            modal_hide();
        } else {
            input_error(data);
        }
    }).fail(function(data){
        console.log(data);
    });
}

function bandle_item_add() {
    $.ajax({
        url: "/api",
        method: "post",
        dataType: "html",
        data: {_token: TOKEN, Type: 'Bandle', func: 'item_add'}
    }).done(function(data){
        $("#modal").html(data);
    }).fail(function(data){
        console.log(data);
    });
}

function modal(func, id) {
        let modal = $('#'+id).parent()
        let id_modal = modal.attr('id');
    if(func == "show") {
        modal.show();
        if(id_modal == "modal") {
            $('#hover').show();

            $("#hover").on('click', function(e) {
                var container = $("#"+id);
                if(!container.is(e.target) && container.has(e.target).length === 0) {
                    $('#hover').hide();
                    $('#modal').hide();
        
                    $("#hover").off('click');
                }
            });
        } else if (id_modal == "modal_g") {
            $('#hover_g').show();
            $("#hover_g").on('click', function(e) {
                var container = $("#"+id);
                if(!container.is(e.target) && container.has(e.target).length === 0) {
                    $('#hover_g').hide();
                    $('#modal_g').hide();
        
                    $("#hover_g").off('click');
                }
            });
        }
    } else if(func == 'hide') {
        modal.hide();
        if(id_modal == "modal") {
            $('#hover').hide();
            $("#hover").off('click');
        } else if (id_modal == "modal_g") {
            $('#hover_g').hide();
            $("#hover_g").off('click');
        }
    }
}

function modal_hide() {
    if($('#hover_g').css('display') == "block") {
        $('#hover_g').click();
    } else {
        $('#hover').click();
    }
}

function bandle_item_add_send() {
    let title = $('#title').val();
    let description = $('#description').val();
    $.ajax({
        url: "/api",
        method: "post",
        dataType: "html",
        data: {_token: TOKEN, Type: 'Bandle', func: 'item_add_send', title: title, description: description}
    }).done(function(data){
        console.log(data);
        if(data > 0) {
            bandle_items_load(0);
            modal_hide();
        } else {
            input_error(data);
        }
    }).fail(function(data){
        console.log(data);
    });
}

function input_error(data) {
    let massages = data.split('|');
    $.each(massages, function (index, value) { 
        let massage = value.split(':');
        let block = $("#"+massage[0]+'_block');
        block.find("input").addClass('input_error');
        if(block.find("input").val()) {
            block.find("i").removeClass('icon_send').addClass('icon_error');
        }
        block.find(".error_text").show().text(massage[1]);
    });
}

function input_valid(e) {
    let val = $(e).val();
    let block = $(e).parent().parent();
    block.find(".error_text").hide().text("");
    block.find("input").removeClass('input_error');
    block.find("i").removeClass('icon_error');
    if(val != "") {
        block.find("i").addClass('icon_clear');
    } else {
        block.find("i").addClass('icon_send');
    }
}

function bandle_remove_item(id, Func = '') {
    $.ajax({
        url: "/api",
        method: "post",
        dataType: "html",
        data: {_token: TOKEN, Type: 'Bandle', func: 'remove_item', id: id, Func: Func}
    }).done(function(data){
        $("#modal_g").html(data);
    }).fail(function(data){
        console.log(data);
    });
}

function bandle_remove_item_send(id, Func = '') {
    $.ajax({
        url: "/api",
        method: "post",
        dataType: "html",
        data: {_token: TOKEN, Type: 'Bandle', func: 'remove_item_send', id: id}
    }).done(function(data){
        if(data > 0) {
            modal('hide', 'bandle_item_remove');
            modal('hide', 'bandle_item_renew');
            if(Func == "location") {
                location.reload();
            } else {
                bandle_items_load(0);
            }
            
        }
    }).fail(function(data){
        console.log(data);
    });
}
