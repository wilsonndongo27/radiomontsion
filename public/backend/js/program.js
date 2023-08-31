/********************* enregistrer un programme *******************/ 
$(document).on('click','#newprogram', function (e) {
    e.preventDefault();
    $('#AddProgramModal').modal({backdrop: 'static'});
});


/**mise a jour des informations d'un programme */
$(document).on('click','#updateprogram', function (e) {
    e.preventDefault(); 
    var id = $(this).data('id');
    var title = $(this).data('title');
    var label = $(this).data('label');
    var day = $(this).data('day');
    var description = $(this).data('description');
    var date = $(this).data('date');
    var time_start = $(this).data('timestart');
    var time_end = $(this).data('timeend');
    var cover = $(this).data('cover');
    $('#programid').val(id);
    $('#programtitle').val(title);
    $('#programlabel').val(label);
    $('#programday').text(day);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-upate').val(description);

    $('#programdescription').val(description);
    $('#programdate').val(date);
    $('#programtimestart').val(time_start);
    $('#programtimeend').val(time_end);
    $('#programcover').attr('src', cover);
    $('#updateProgramModal').modal({backdrop: 'static'});
});
