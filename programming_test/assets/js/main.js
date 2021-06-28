$("html").on('click', 'button.btn-show-card', function () {
    let elem = $(this);
    let id = elem.attr("id");

    $("#img-card-" + id).toggle("slow");
    elem.text(function (i, text) {
        return (text === "Hide the cards" ? "Show the cards" : "Hide the cards");
    });

    return false;
});