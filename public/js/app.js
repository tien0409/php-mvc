const button = $("#searchButton").click(function (e) {
    e.preventDefault();
    const input = $("#searchContext").val();
    let url;
    if (input?.trim()) {
        url = "/find/" + input;
    } else {
        url = '/'
    }
    window.location.replace(url);
})

const bs = new bootstrap.Toast($('.toast')[0], {
    animation: true, autohide: true, delay: 2000
})

bs.show()