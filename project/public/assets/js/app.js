$(document).ready(function(){

    $('#customer_save').on('click', function (e) {
        e.preventDefault();
        var regexPhone = RegExp('^(0|.33|0033)[1-9]([-.]?[0-9]{2}){4}$');
        var regexEmail = RegExp('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\\.[a-zA-Z0-9-.]+$');
        var isSubmitedCustomer = true;
        var firstName = $('#customer_firstName');
        var lastName = $('#customer_lastName');
        var phoneNumber = $('#customer_phoneNumber');
        var email = $('#customer_email')
        phoneNumber.removeClass('error');
        firstName.removeClass('error');
        lastName.removeClass('error');
        email.removeClass('error');
        $('.message').remove();
        if (firstName.val() === '') {
            firstName.addClass('error');
            errorMessage('la saisie de champs nom est obligatoire', firstName)
            isSubmitedCustomer = false;
        }
        if (lastName.val() === '') {
            lastName.addClass('error');
            errorMessage('la saisie de prenom de client est obligatoire',lastName );
            isSubmitedCustomer = false;
        }
        if (email.val() === '') {
            email.addClass('error');
            errorMessage('la saisie de mail de client est obligatoire', email);
            isSubmitedCustomer = false;
        }
        if (phoneNumber.val() === '') {
            phoneNumber.addClass('error');
            errorMessage('la saisie de numéro de téléphone de client est obligatoire', phoneNumber);
            isSubmitedCustomer = false;
        }
        if (!regexPhone.test(phoneNumber.val()) && phoneNumber.val() !== '') {
            phoneNumber.addClass('error');
            errorMessage('Numéro de téléphone invalide', phoneNumber);
            isSubmitedCustomer = false;
        }
        if (!regexEmail.test(email.val()) && phoneNumber.val() !== '') {
            email.addClass('error');
            errorMessage('le format de mail est invalide', email);
            isSubmitedCustomer = false;
        }
        if (isSubmitedCustomer) {
            $('[name=customer]').submit();
        }
    })

    $('#material_save').on('click', function (e) {
        e.preventDefault();
        var name = $('#material_name');
        var price = $('#material_price');
        var category = $('#material_category');
        var reference = $('#material_reference');
        var isSubmitedMaterial = true;
        name.removeClass('error');
        price.removeClass('error');
        category.removeClass('error');
        reference.removeClass('error');
        $('.message').remove();
        if (name.val() === '') {
            name.addClass('error');
            errorMessage('la saisie de champs nom est obligatoire', name)
            isSubmitedMaterial = false;
        }
        if (price.val() === '') {
            price.addClass('error');
            errorMessage('la saisie de prix est obligatoire', price)
            isSubmitedMaterial = false;
        }
        if (price.val() < 0 && price.val() !== '') {
            price.addClass('error');
            errorMessage('la valeur de prix ne doit pas étre négative', name)
            isSubmitedMaterial = false;
        }
        if (category.val() === '') {
            category.addClass('error');
            errorMessage('la saisie de catégorie est obligatoire', category)
            isSubmitedMaterial = false;
        }
        if (reference.val() === '') {
            reference.addClass('error');
            errorMessage('la saisie de réference est obligatoire', reference)
            isSubmitedMaterial = false;
        }
        if (isSubmitedMaterial) {
            $('[name=material]').submit();
        }
    })

    function errorMessage(msg, b)
    {
        var a = '<ul class="message" style="color: red"><li>' + msg + '</li></ul>';
        b.parent('div').append(a);
    }

});