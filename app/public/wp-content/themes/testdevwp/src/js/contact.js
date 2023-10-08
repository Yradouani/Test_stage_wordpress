import $ from 'jquery';
var ajaxUrl = ajaxRequest.ajaxUrl;
console.log(ajaxUrl)

$('form').on('submit', function (e) {
    e.preventDefault();

    var name = $('#name').val();
    var firstname = $('#firstname').val();
    var email = $('#email').val();
    var subject = $('#subject').val();
    var message = $('#message').val();

    var regexName = /^[\p{L}-]{3,20}$/u;
    var regexEmail = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var regexText = /[-a-zA-Z0-9@:%._\+~#=]{3,256}(\s|$)/;

    // Test name
    if (!regexName.test(name)) {
        $('#error-name').text('Veuillez entrer un nom valide');
        return;
    } else {
        $('#error-name').text('');
    }
    // Test lastname
    if (!regexName.test(firstname)) {
        $('#error-firstname').text('Veuillez entrer un prénom valide');
        return;
    } else {
        $('#error-firstname').text('');
    }
    // Test email
    if (!regexEmail.test(email)) {
        $('#error-email').text('Veuillez entrer un email valide');
        return;
    } else {
        $('#error-email').text('');
    }
    // Test subject
    if (!regexText.test(subject)) {
        $('#error-subject').text('Veuillez entrer un objet valide');
        return;
    } else {
        $('#error-subject').text('');
    }
    // Test message
    if (!regexText.test(message)) {
        $('#error-message').text('Veuillez entrer un message valide');
        return;
    } else {
        $('#error-message').text('');
    }

    var formData = new FormData();
    formData.append('firstname', firstname);
    formData.append('lastname', name);
    formData.append('email', email);
    formData.append('subject', subject);
    formData.append('message', message);
    formData.append('action', 'send_message');

    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.success) {
                // console.log(response.data.data)
                window.location.href = response.data.redirect
            }

        },
        error: function (xhr, status, error) {
            console.log("XHR : ", xhr);
            console.log("Status : ", status);
            console.log("Error : ", error);
        }
    });


});


