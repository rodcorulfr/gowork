$(":input").inputmask();

$("#celular").inputmask({"mask": "(99) 99999-9999"});

$('#form-id').change(function() {
    if ($('#form1').prop('checked')) {
        $('#A').show();
        $('#B').hide();
    } else {
        $('#B').show();
        $('#A').hide();
    }
});