/********************* enregistrer un administrateur *******************/ 
$(document).on('click','#newbanner', function (e) {
    e.preventDefault();
    $('#AddBannerModal').modal({backdrop: 'static'});
});


/**mise a jour des informations de l'administrateur */
$(document).on('click','#updatebanner', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var title = $(this).data('title');
    var label = $(this).data('label');
    var description = $(this).data('description');
    var cover = $(this).data('cover');
    $('#bannerid').val(id);
    $('#bannertitle').val(title);
    $('#bannerlabel').val(label);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-upate').val(description);

    $('#bannerdescription').val(description);
    $('#bannercover').attr('src', cover);
    $('#updateBannerModal').modal({backdrop: 'static'});
});
