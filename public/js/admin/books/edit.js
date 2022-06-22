$(document).ready(function () {
    $('.book__image').click(function () {
        $('.input__image').click();
    })

    $(".input__image").on('change', function (e) {
        $(".form").submit()
    })

    $('.form').on('submit', function (e) {
        e.preventDefault();
    })
})