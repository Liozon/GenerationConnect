import tmplDefault from "IndexSenior/Templates/profilPersonnel.html";

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