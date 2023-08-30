/********************* enregistrer un podcast *******************/ 
$(document).on('click','#newpodcast', function (e) {
    e.preventDefault();
    $('#AddPodcastModal').modal({backdrop: 'static'});
});


/**mise a jour des informations un podcast */
$(document).on('click','#updatepodcast', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var title = $(this).data('title');
    var label = $(this).data('label');
    var description = $(this).data('description');
    var cover = $(this).data('cover');
    var program = `<option value="`+$(this).data('programid')+`" selected>`+$(this).data('program')+`</option>`
    $('#podcastid').val(id);
    $('#podcasttitle').val(title);
    $('#podcastlabel').val(label);
    $('#podcastprogram').prepend(program);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-upate').val(description);

    $('#podcastdescription').val(description);
    $('#podcastcover').attr('src', cover);
    $('#updatePodcastModal').modal({backdrop: 'static'});
});
