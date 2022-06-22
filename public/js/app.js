const button = $("#searchButton").click(
    function (e) {
        e.preventDefault();
        const input = $("#searchContext").val();
        var url = "/find/" + input;
        window.location.replace(url);
    }
)