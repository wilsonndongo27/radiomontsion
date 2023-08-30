/**GESTION INFOS ENTRTEPRISE */
$(document).on('click','#addCompany', function (e) {
    e.preventDefault();
    $('#companyModal').modal({backdrop: 'static'});
});

/**mise a jour des informations de l'entreprise */
$(document).on('click','#updatecompany', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    var vision = $(this).data('vision');
    var objectif = $(this).data('objectif');
    var logo = $(this).data('logo');
    var cover = $(this).data('cover');
    var maplink = $(this).data('maplink');
    $('#companyid').val(id);
    $('#companyname').val(name);
    $('#companyvision').val(vision);
    $('#companymap').val(maplink);

    const delta = quill.clipboard.convert(objectif)
    quill.setContents(delta, 'silent')
    $('.post-content-update').val(objectif);

    $('#companyobjectif').val(objectif);
    $('#companylogo').attr('src', logo);
    $('#companycover').attr('src', cover);
    $('#updateCompanyModal').modal({backdrop: 'static'});
});