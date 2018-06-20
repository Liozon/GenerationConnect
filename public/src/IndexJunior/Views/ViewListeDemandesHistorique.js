import tmplDefault from "IndexJunior/Templates/listeDemandesHistorique.html";

export default Backbone.View.extend({
    initialize: function (attrs, options) {
        this.template = tmplDefault;
        this.listenTo(this.collection, "change add remove", this.render);
    },
    render: function () {
        this.$el.html(this.template({
            demandes: this.collection.toJSON(),
        }));
        return this.$el;
    }
});