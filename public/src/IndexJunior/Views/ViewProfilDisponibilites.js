import tmplDefault from "IndexJunior/Templates/profilDisponibilites.html";

export default Backbone.View.extend({
    initialize: function (attrs, options) {
        this.template = tmplDefault;
        this.listenTo(this.collection, "change add remove", this.render);
    },
    render: function () {
        this.$el.html(this.template({
            junior: this.collection.toJSON(),
        }));
        return this.$el;
    }
});