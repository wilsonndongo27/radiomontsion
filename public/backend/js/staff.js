/********************* enregistrer un administrateur *******************/ 
$(document).on('click','#newstaff', function (e) {
    e.preventDefault();
    $('#AddStaffModal').modal({backdrop: 'static'});
});


/**mise a jour des informations de l'administrateur */
$(document).on('click','#updatestaff', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    var phone = $(this).data('phone');
    var email = $(this).data('email');
    var address = $(this).data('address');
    var description = $(this).data('description');
    var pp = $(this).data('pp');
    var country = `<option value="`+$(this).data('countryid')+`" selected>`+$(this).data('country')+`</option>`;
    var state = `<option value="`+$(this).data('stateid')+`" selected>`+$(this).data('state')+`</option>`;
    var city = `<option value="`+$(this).data('cityid')+`" selected>`+$(this).data('city')+`</option>`;
    var profil = `<option value="`+$(this).data('profilid')+`" selected>`+$(this).data('profil')+`</option>`;
    $('#staffid').val(id);
    $('#staffname').val(name);
    $('#staffphone').val(phone);
    $('#staffemail').val(email);
    $('#staffaddress').val(address);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-upate').val(description);

    $('#staffdescription').val(description);

    $('.staffcountry').append(country);  
    $('.staffstate').append(state);
    $('.staffcity').append(city);
    $('.staffprofil').append(profil);   
    $('#staffpp').attr('src', pp);
    $('#UpdateStaffModal').modal({backdrop: 'static'});
});

/**
* END BLOCK
*/