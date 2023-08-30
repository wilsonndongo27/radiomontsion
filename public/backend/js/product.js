/********************* enregistrer une actualités *******************/ 
$(document).on('click','#newproduct', function (e) {
    e.preventDefault();
    $('#AddProductModal').modal({backdrop: 'static'});
});


/**mise a jour des informations des actualités */
$(document).on('click','#updateproduct', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var title = $(this).data('title');
    var label = $(this).data('label');
    var description = $(this).data('description');
    var cover = $(this).data('cover');
    $('#productid').val(id);
    $('#producttitle').val(title);
    $('#productlabel').val(label);

    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-upate').val(description);

    $('#productdescription').val(description);
    $('#productcover').attr('src', cover);
    $('#updateProductModal').modal({backdrop: 'static'});
});
