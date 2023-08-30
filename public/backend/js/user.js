/********************* enregistrer un administrateur *******************/ 
$(document).on('click','#newuser', function (e) {
    e.preventDefault();
    $('#AddUserModal').modal({backdrop: 'static'});
});


/**mise a jour des informations de l'administrateur */
$(document).on('click','#updateadmin', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    var phone = $(this).data('phone');
    var email = $(this).data('email');
    var address = $(this).data('address');
    var pp = $(this).data('pp');
    var country = `<option value="`+$(this).data('countryid')+`" selected>`+$(this).data('country')+`</option>`;
    var state = `<option value="`+$(this).data('stateid')+`" selected>`+$(this).data('state')+`</option>`;
    var city = `<option value="`+$(this).data('cityid')+`" selected>`+$(this).data('city')+`</option>`;
    $('#userid').val(id);
    $('#username').val(name);
    $('#userphone').val(phone);
    $('#useremail').val(email);
    $('#useraddress').val(address);
    $('.usercountry').append(country);    
    $('.userstate').append(state);
    $('.usercity').append(city);
    $('#userpp').attr('src', pp);
    $('#UpdateUserModal').modal({backdrop: 'static'});
});

$(document).on('click','#newpassword', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#userpasswordid').val(id);
    $('#PasswordUserModal').modal({backdrop: 'static'});
});


/**
* END BLOCK
*/