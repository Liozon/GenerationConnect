$(function () {
    $("form").on("submit", convertData);
    $("td").on("click", showDisponibility);
});

function convertData() {
    // "bypassEmptyValues" permet de switcher entre suppression ou non des valeurs vides. True = suppression / False = pas de suppression
    var bypassEmptyValues = false;
    var html = '<input type="text" name="juniorInputDisponibilities" id="disponibilities">';
    var json = '{';
    var otArr = [];
    var tbl2 = $('#dispo_table tr').each(function (i) {
        x = $(this).children();
        var itArr = [];
        x.each(function () {
            if (bypassEmptyValues == true && $(this).text() != '') {
                itArr.push('"' + $(this).text() + '"');
            } else {
                itArr.push('"' + $(this).text() + '"');
            }
        });
        otArr.push('"' + i + '": [' + itArr.join(',') + ']');
    });
    json += otArr.join(",") + '}';
    $("#results_dispo").append(html);
    $("#disponibilities").val(json);
}

function showDisponibility() {
    if ($(this).hasClass("available")) {
        $(this).removeClass("available");
        $(this).empty();
    } else {
        $(this).addClass("available");
        var id = $(this).attr("dispo-day");
        $(this).append(id);
    }
}

function test() {
    console.log("coucou");
}