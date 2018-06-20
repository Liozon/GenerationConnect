import tmplDefault from "IndexSenior/Templates/profil.html";

export default Backbone.View.extend({
    events: {
        "click  td.disponibility ": "showDisponibility"
    },



/*//    // "bypassEmptyValues" permet de switcher entre suppression ou non des valeurs vides. True = suppression / False = pas de suppression
  //  var bypassEmptyValues = false;
    //var html = '<input type="text" name="juniorInputDisponibilities" id="disponibilities">';
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
},*/

showDisponibility: function(event) {
    var target = $(event.target);
    if (target.hasClass("available")) {
        target.removeClass("available");
        target.empty();
    } else {
        target.addClass("available");
        var id = target.attr("dispo-day");
        target.append(id);
    }
},

    test: function(event) {
        var elem = event.target();
        if (elem.hasClass("available")) {
            elem.removeClass("available");
            elem.empty();
        } else {
            elem.addClass("available");
            var id = elem.attr("dispo-day");
            elem.append(id);
        }
    },
    initialize: function (attrs, options) {
        this.template = tmplDefault;
    },
    render: function () {
        this.$el.html(this.template());
        return this.$el;
    }
});

