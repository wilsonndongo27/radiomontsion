/********************* enregistrer une actualités *******************/ 
$(document).on('click','#newprofil', function (e) {
    e.preventDefault();
    $('#AddProfilModal').modal({backdrop: 'static'});
});


/**mise a jour des profils */
$(document).on('click','#updateprofil', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    $('#profilid').val(id);
    $('#profilname').val(name);
    $('#updateProfilModal').modal({backdrop: 'static'});
});
