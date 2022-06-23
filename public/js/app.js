const button = $("#searchButton").click(function (e) {
    e.preventDefault();
    const input = $("#searchContext").val();
    var url = "/find/" + input;
    window.location.replace(url);
})

const bs = new bootstrap.Toast($('.toast')[0], {
    animation: true, autohide: true, delay: 2000
})

bs.show()