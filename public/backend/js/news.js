/********************* enregistrer une actualités *******************/ 
$(document).on('click','#newnews', function (e) {
    e.preventDefault();
    $('#AddNewsModal').modal({backdrop: 'static'});
});


/**mise a jour des informations des actualités */
$(document).on('click','#updatenews', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var title = $(this).data('title');
    var label = $(this).data('label');
    var description = $(this).data('description');
    var cover = $(this).data('cover');
    $('#newsid').val(id);
    $('#newstitle').val(title);
    $('#newslabel').val(label);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-upate').val(description);

    $('#newsdescription').val(description);
    $('#newscover').attr('src', cover);
    $('#updateNewsModal').modal({backdrop: 'static'});
});
