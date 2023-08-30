/**
 * Global Js Script
 */
/** Gestion de la Deconnexion */
$('.Logout').on('click', function(){
    var url = $(this).data('url');
    swal({
            title: "Êtes vous sûr?",
            text: "Vous serez déconnecter du système!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#00457E",
            closeOnConfirm: false,
            closeOnCancel: true 
        }, 
        function(isConfirm){   
        if (isConfirm){     
            action_function(url); 
        }
    })
    function action_function(url){
        window.location.assign(url);
    }
})

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

/**
 * Global Creation Form
 */
$(document).on('submit', '.createform', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('.buttomcreate').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('.buttomcreate').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
        },
        success: function (json) {
            if (json.status == 200){
                setTimeout(toastr.success(json.message), 1000);
                window.location.reload();
            }else{
                toastr.error(json.message)
            }
        },
        complete: function () {
            $('.buttomcreate').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});

/**
 * Global Update Form
 */
$(document).on('submit', '.updateform', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var form = $(this);
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    var valBtn = $('.buttonupdate').text();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: false,
        processData: false,
        datatype: 'json',
        beforeSend: function () {
            $('.buttonupdate').text('en cours...').prop('disabled',true);
            $(document.body).css({'cursor' : 'wait'});
            form.find('*').prop('disabled', true);
        },
        success: function (json) {
            if (json.status == 200){
                setTimeout(toastr.success(json.message), 1000);
                window.location.reload();
            }else{
                toastr.error(json.message)
            }
        },
        complete: function () {
            $('.buttonupdate').text(valBtn).prop('disabled',false);
            $(document.body).css({'cursor' : 'default'});
            form.find('*').prop('disabled', false);
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
});

/** 
 * Global Delete Form
 */
$('.deleteForm').on('click', function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    var token = $(this).data('token');
    var message = $(this).data('message');
    var type = $(this).data('type');
    swal({
        title: "Êtes vous sûr?",
        text: message,
        type: type,
        showCancelButton: true,
        confirmButtonColor: "#00457E",
        closeOnConfirm: false,   
        closeOnCancel: true 
        }, function(isConfirm){   
        if (isConfirm) {     
            action_function(url, id, token); 
        }
    })
    function action_function(url, id, token){
        $.ajax({    
            type: 'post',
            url: url,
            data: {
                id: id,
                _token: token
            },
            dataType: 'json',
            beforeSend: function () {
                $(document.body).css({'cursor' : 'wait'});
                $(this).find('*').prop('disabled', true);
            },
            success: function (json) {
                if (json.status == 200){
                    setTimeout(toastr.success(json.message), 1000);
                    window.location.reload();
                }else{
                    toastr.error(json.message)
                }
            },
            complete: function () {
                $(document.body).css({'cursor' : 'default'});
                $(this).find('*').prop('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown){}
        });
    }
})

/** 
 * Global Status Form
 */
$('.statusForm').on('click', function(){
    var url = $(this).data('url');
    var id = $(this).data('id');
    var token = $(this).data('token');
    var message = $(this).data('message');
    var type = $(this).data('type');
    swal({
        title: "Êtes vous sûr?",
        text: message,
        type: type,
        showCancelButton: true,
        confirmButtonColor: "#00457E",
        closeOnConfirm: false,   
        closeOnCancel: true 
        }, function(isConfirm){   
        if (isConfirm) {     
            action_function(url, id, token); 
        }
    })
    function action_function(url, id, token){
        console.log(url, id, token);
        $.ajax({    
            type: 'post',
            url: url,
            data: {
                id: id,
                _token: token
            },
            dataType: 'json',
            beforeSend: function () {
                $(document.body).css({'cursor' : 'wait'});
                $(this).find('*').prop('disabled', true);
            },
            success: function (json) {
                if (json.status == 200){
                    setTimeout(toastr.success(json.message), 5000);
                    window.location.reload();
                }else{
                    toastr.error(json.message)
                }
            },
            complete: function () {
                $(document.body).css({'cursor' : 'default'});
                $(this).find('*').prop('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown){}
        });
    }
})

/** gestion des tables list */
$(document).ready(function() {
    $('.global-data-table').DataTable({
        language : {
            url : 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
        }
    });

});


/**
* END BLOCK
*/

/**EDITOR QUILL */
var quill;

$(document).ready(function(){
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
      
        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
      
        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
    
        ['clean'],                                         // remove formatting button
        ['image'],
        ['link']
    ];
    
    quill = new Quill('.editor', {
    theme: 'snow',
    modules: { 
            toolbar: {
                container: toolbarOptions,
            }
        },
        imageHandler: imageHandler
    });

    quill = new Quill('.editorupdate', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: toolbarOptions,
            }
        },
        imageHandler: imageHandler
    });

    function imageHandler(image, callback) {
        var data = new FormData();
        data.append('image', image);
    
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 200 && response.success) {
                callback(response.data.link);
            } else {
                var reader = new FileReader();
                reader.onload = function(e) {
                callback(e.target.result);
                };
                reader.readAsDataURL(image);
            }
            }
        }
        xhr.send(data);
    }
    
 
})

var postSubmission = function(){
    editor = document.querySelector(".editor");
    contentInput = document.querySelector(".post-content");
    contentInput.value = editor.innerHTML;
}

var postSubmissionUpdate = function(){
    editor = document.querySelector(".editorupdate");
    contentInput = document.querySelector(".post-content-update");
    contentInput.value = editor.innerHTML;
}


/**
 * Manage Country State City
 */

/*------------------------------------------
--------------------------------------------
Country Dropdown Change Event
--------------------------------------------
--------------------------------------------*/
$('#country-dropdown').on('change', function () {
    var idCountry = this.value;
    var url = this.getAttribute('url');
    var token = this.getAttribute('token');
    $("#state-dropdown").html('');
    $.ajax({
        url: url,
        type: "POST",
        data: {
            country_id: idCountry,
            _token: token
        },
        dataType: 'json',
        success: function (result) {
            $('#state-dropdown').html('<option value="">-- Selectionner la Région --</option>');
            $.each(result.states, function (key, value) {
                $("#state-dropdown").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
            $('#city-dropdown').html('<option value="">-- Selectionner le Pays --</option>');
        }
    });
});

/*------------------------------------------
--------------------------------------------
State Dropdown Change Event
--------------------------------------------
--------------------------------------------*/
$('#state-dropdown').on('change', function () {
    var idState = this.value;
    var url = this.getAttribute('url');
    var token = this.getAttribute('token');
    $("#city-dropdown").html('');
    $.ajax({
        url: url,
        type: "POST",
        data: {
            state_id: idState,
            _token: token
        },
        dataType: 'json',
        success: function (res) {
            $('#city-dropdown').html('<option value="">-- Select City --</option>');
            $.each(res.cities, function (key, value) {
                $("#city-dropdown").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
        }
    });
});


/**Form Update */
$('#country-dropdown-update').on('change', function () {
    var idCountry = this.value;
    var url = this.getAttribute('url');
    var token = this.getAttribute('token');
    $("#state-dropdown-update").html('');
    $.ajax({
        url: url,
        type: "POST",
        data: {
            country_id: idCountry,
            _token: token
        },
        dataType: 'json',
        success: function (result) {
            $('#state-dropdown-update').html('<option value="">-- Selectionner la Région --</option>');
            $.each(result.states, function (key, value) {
                $("#state-dropdown-update").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
            $('#city-dropdown-update').html('<option value="">-- Selectionner le Pays --</option>');
        }
    });
});

/*------------------------------------------
--------------------------------------------
State Dropdown Change Event
--------------------------------------------
--------------------------------------------*/
$('#state-dropdown-update').on('change', function () {
    var idState = this.value;
    var url = this.getAttribute('url');
    var token = this.getAttribute('token');
    $("#city-dropdown-update").html('');
    $.ajax({
        url: url,
        type: "POST",
        data: {
            state_id: idState,
            _token: token
        },
        dataType: 'json',
        success: function (res) {
            $('#city-dropdown-update').html('<option value="">-- Select City --</option>');
            $.each(res.cities, function (key, value) {
                $("#city-dropdown-update").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
        }
    });
});


