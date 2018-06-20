import tmplDefault from "IndexJunior/Templates/rapports.html";

export default Backbone.View.extend({
    events: {
        "click a.rapport-btn": "changeBtnState"
    },
    changeBtnState: function (event) {
        var target = $(event.target);
        if (!target.hasClass("activated")) {
            target.addClass("activated");
        } else {
            target.removeClass("activated");
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