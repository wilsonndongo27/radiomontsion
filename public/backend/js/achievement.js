/********************* enregistrer une réalisation *******************/ 
$(document).on('click','#newachievement', function (e) {
    e.preventDefault();
    $('#AddAchievementModal').modal({backdrop: 'static'});
});


/**mise a jour des informations des réalisation */
$(document).on('click','#updateachievement', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var title = $(this).data('title');
    var label = $(this).data('label');
    var description = $(this).data('description');
    var cover = $(this).data('cover');
    $('#achievementid').val(id);
    $('#achievementtitle').val(title);
    $('#achievementlabel').val(label);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-upate').val(description);

    $('#achievementdescription').val(description);
    $('#achievementcover').attr('src', cover);
    $('#updateAchievementModal').modal({backdrop: 'static'});
});
