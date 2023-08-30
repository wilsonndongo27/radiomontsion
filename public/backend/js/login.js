/**********************************************Script de connexion des administrateurs au dashboard ******************** */
$(document).on('submit', '#loginadminform', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('#buttonlogin').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('#buttonlogin').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
        },
        success: function (json) {
            console.log(json, 'ddddddddddddddddddddddd')
            if (json.status == 200){
                setTimeout(toastr.success(json.message), 1000);
                window.location.assign('/dashboard');
            }else{
                toastr.error(json.message)
            }
        },
        complete: function () {
            $('#buttonlogin').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});


/*************************************SHOW PASSWORD WHEN LOGIN ***************************** */
$("#show_hide_password a").on('click', function(event) {
    event.preventDefault();
    if($('#show_hide_password input').attr("type") == "text"){
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass( "fa-eye-slash" );
        $('#show_hide_password i').removeClass( "fa-eye" );
    }else if($('#show_hide_password input').attr("type") == "password"){
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass( "fa-eye-slash" );
        $('#show_hide_password i').addClass( "fa-eye" );
    }
});
