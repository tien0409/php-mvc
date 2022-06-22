$(document).ready(function () {
    $("#flipbook").turn({
        autoCenter: true
    });

    $('.first').click(function (e) {
        $('#flipbook').turn('page', 1)
    })

    $('.last').click(function (e) {
        $('#flipbook').turn('page', $('#flipbook').turn('pages'))
    })

    $('.next').click(function (e) {
        $('#flipbook').turn('next')
    })

    $('.prev').click(function (e) {
        $('#flipbook').turn('previous')
    })
})
