$(function () {
    $("form").on("submit", convertData);
    $("#btnJuniorForm").on("click", showJuniorForm);
    $("#btnSeniorForm").on("click", showSeniorForm);
    $("td").on("click", showDisponibility);
    $("#reset_form").on("click", resetForm);
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

function showJuniorForm() {
    $(".formJunior").removeClass("hidden");
    $(".formSenior").addClass("hidden");
    $("#btnJuniorForm").addClass("btn-primary");
    $("#btnJuniorForm").removeClass("btn-secondary");
    $("#btnSeniorForm").removeClass("btn-primary");
    $("#btnSeniorForm").addClass("btn-secondary");
}

function showSeniorForm() {
    $(".formSenior").removeClass("hidden");
    $(".formJunior").addClass("hidden");
    $("#btnJuniorForm").removeClass("btn-primary");
    $("#btnJuniorForm").addClass("btn-secondary");
    $("#btnSeniorForm").addClass("btn-primary");
    $("#btnSeniorForm").removeClass("btn-secondary");
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

function resetForm() {
    $('#dispo_table td').each(function (i) {
        $(this).empty();
        $(this).removeClass("available");
    })
}

function test() {
    console.log("coucou");
}