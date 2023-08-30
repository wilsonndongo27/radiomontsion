/********************* enregistrer une radio *******************/ 
$(document).on('click','#newradio', function (e) {
    e.preventDefault();
    $('#AddRadioModal').modal({backdrop: 'static'});
});


/**mise a jour des informations des radio */
$(document).on('click','#updateradio', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var title = $(this).data('title');
    var flux = $(this).data('flux');
    var description = $(this).data('description');
    var cover = $(this).data('cover');
    $('#radioid').val(id);
    $('#radiotitle').val(title);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-upate').val(description);

    $('#radiodescription').val(description);
    $('#radioflux').val(flux);
    $('#radiocover').attr('src', cover);
    $('#updateRadioModal').modal({backdrop: 'static'});
});
