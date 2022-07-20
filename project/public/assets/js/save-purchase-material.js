$(document).ready(function(){
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        searchResultLimit:5,
        renderChoiceLimit:5
    });

    $(".material_select").on('change', function (e) {
        $("#purchase_material").val($(".material_select").val());
    })

    $('#save-material').on('click', function (e) {
        var isSubmited = true;
        if ($('[name=customer_id]').val() === '') {
            alert('selectioner un client')
            isSubmited = false;
        }
        if ($('#purchase_material').val() === '') {
            alert('selectioner au moin un matériel');
            isSubmited = false;
        }
        if (isSubmited) {
            $('#material-form').submit();
        }

    })
});