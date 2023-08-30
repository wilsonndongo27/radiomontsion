/********************* enregistrer une actualités *******************/ 
$(document).on('click','#newpartner', function (e) {
    e.preventDefault();
    $('#AddPatnerModal').modal({backdrop: 'static'});
});


/**mise a jour des informations du partenare */
$(document).on('click','#updatepartner', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var title = $(this).data('title');
    var label = $(this).data('label');
    var description = $(this).data('description');
    var cover = $(this).data('cover');
    $('#partnerid').val(id);
    $('#partnertitle').val(title);
    $('#partnerlabel').val(label);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-upate').val(description);

    $('#partnerdescription').val(description);
    $('#partnercover').attr('src', cover);
    $('#updatePartnerModal').modal({backdrop: 'static'});
});
