$(document).ready(function () {

    // Select2 Multiple
    $('.select2-multiple').select2();

    $('.book__pages').first().on('click', function () {
        $('.input__pages').first().click();
    })

    $('form').first().on('submit', function (e) {
        e.preventDefault()

    })
});