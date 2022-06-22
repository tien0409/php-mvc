$(document).ready(function () {
    let bookPages = []
    let bookBanner = null;
    const CLOUDINARY_URL = "https://api.cloudinary.com/v1_1/dspnu5m0h/upload";
    const CLOUDINARY_PRESET = 'php_mvc';

    // Select2 Multiple
    $('.select2-multiple').select2();

    $('.book__pages').first().on('click', function () {
        $('.input__pages').first().click();
    })

    $(".input__pages").first().change(function () {
        bookPages = []
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            const formData = new FormData();
            formData.append('file', $(this).get(0).files[i])
            formData.append('upload_preset', CLOUDINARY_PRESET)
            bookPages.push(formData);
        }
    });

    $('.book__banner').first().change(function (e) {
        const formData = new FormData();
        formData.append('file', e.target.files[0])
        formData.append('upload_preset', CLOUDINARY_PRESET)
        bookBanner = formData;
    })

    $('form').first().on('submit', async function (e) {
        e.preventDefault()
        const promiseArr = bookPages.map(page => (fetch(CLOUDINARY_URL, {
            method: 'POST', body: page
        })).then(res => res.json()))
        const banner = await fetch(CLOUDINARY_URL, {
            method: 'POST',
            body: bookBanner
        }).then(res => res.json());
        const res = await Promise.all(promiseArr);
        bookPages = []
        bookBanner = null;

        const response = await $.ajax('/admin/books/create/new', {
            method: 'POST', data: {
                page_link: res,
                book_banner: banner,
                name: $('#name').val(),
                price: $('#price').val(),
                description: $('#description').val(),
                overview: $('#overview').val()
            }
        })
        const data = await response.json()
    })
});