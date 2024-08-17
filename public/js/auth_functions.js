var TOKEN = $('meta[name="csrf-token"]').attr('content');

function auth_via_bandle() {
    $('#inputs_zone').css('transform', 'translateY(-140px)');
    $('#btns_zone').css('transform', 'translateY(0)');

    $(document).on('click', function(e) {
        var container = $("#inputs_zone");
        if(!container.is(e.target) && container.has(e.target).length === 0) {
            $('#inputs_zone').css('transform', 'translateY(0)');
            $('#btns_zone').css('transform', 'translateY(-104px)');

            $(document).off('click');
        }
    });
}

function Registration() {
    $('#hover').show();
    $('#reg_modal').css('display', 'flex');

    $("#hover").on('click', function(e) {
        var container = $("#reg_modal");
        if(!container.is(e.target) && container.has(e.target).length === 0) {
            $('#hover').hide();
            $('#reg_modal').hide();

            $("#hover").off('click');
        }
    });
}

function Registration_send() {
    let email = $("#email").val();
    let password = $("#password").val();
    let password_confirmation = $("#password_confirmation").val();

    $.ajax({
        url: "/registration",
        method: "post",
        dataType: "html",
        data: {_token: TOKEN, email: email, password: password, password_confirmation: password_confirmation}
    }).done(function(data){
        if(data > 0) {
            location.reload();
        } else {
            let massages = data.split('|');
            $.each(massages, function (index, value) { 
                let massage = value.split(':');
                input_error(massage[0], massage[1]);
            });
            
        }
    }).fail(function(){
        
    });
}

function login() {
    let email = $("#login").val();
    let password = $("#login_password").val();

    $.ajax({
        url: "/login",
        method: "post",
        dataType: "html",
        data: {_token: TOKEN, email: email, password: password}
    }).done(function(data){
        console.log(data);
        if(data > 0) {
            location.reload();
        } else {
            let massages = data.split('|');
            $.each(massages, function (index, value) { 
                let massage = value.split(':');
                input_error(massage[0], massage[1]);
            });
            
        }
    }).fail(function(){
        
    });
}

function hide() {
    $('#hover').hide();
    $('#reg_modal').hide();

    $("#hover").off('click');
}

function input_error(id, text) {
    if(id == "password") {
        input_error("password_confirmation", "");
    }
    let block = $("#"+id+'_block');
    block.find("input").addClass('input_error');
    if(block.find("input").val()) {
        block.find("i").removeClass('icon_send').addClass('icon_error');
    }
    block.find(".error_text").show().text(text);
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

function input_action(e) {
    let icon = $(e).children();
    let parent = $(e).parent();
    
    if(icon.hasClass('icon_send')) {
        parent.find("input").trigger('change');
    }
    if(icon.hasClass('icon_clear') || icon.hasClass('input_error')) {
        parent.find("input").val('');
    }
    
}