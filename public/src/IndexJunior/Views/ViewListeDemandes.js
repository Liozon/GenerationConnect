import tmplDefault from "IndexJunior/Templates/listeDemandes.html";

export default Backbone.View.extend({
    events: {
        "click .demande-accept": "act_accept_demand",
        "click .demande-reject": "act_reject_demand"
    },
    act_accept_demand: function (event) {
        let id = $(event.target).attr('data-id');
        let model = this.collection.get(id);
        let statut = "accepté";
        model.set({
            statut: statut
        });
        model.save();
    },
    act_reject_demand: function (event) {
        let id = $(event.target).attr('data-id');
        let model = this.collection.get(id);
        let statut = "refusé";
        model.set({
            statut: statut
        });
        model.save();
    },
    initialize: function (attrs, options) {
        this.template = tmplDefault;
        this.listenTo(this.collection, "all", this.render);
    },
    render: function () {
        this.$el.html(this.template({
            demandes: this.collection.toJSON(),
        }));
        return this.$el;
    }
});