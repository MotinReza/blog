// Slug create code
function string_to_slug(text){

    $("#slug").val(text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,''));

}

//Data base table code
$(document).ready(function () {
    $('#dataTable').DataTable();
});

CKEDITOR.replace( 'content2' );