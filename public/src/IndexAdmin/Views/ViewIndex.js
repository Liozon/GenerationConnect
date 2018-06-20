import tmplDefault from "IndexAdmin/Templates/index.html";

import CollectionJuniors from "IndexAdmin/Models/CollectionJuniorsDispo.js";

import ViewChoixJuniors from "IndexAdmin/Views/ViewChoixJuniors.js";

let collectionJuniors = new CollectionJuniors();

collectionJuniors.fetch();

export default Backbone.View.extend({
    events: {
        "click .choisirjun": "choisirjun",
        "click .choisirjunior": "act_set",
        "click .close-pop": "hide",
        "click .fermerprof": "switch"
        //"click .validerrdv": "act_set"
    },
    hide: function (evt) {
        $('#popup1').addClass('hidden');
    },
    switch: function (evt) {
        $('#popup2').addClass('hidden');
        $('#popup1').removeClass('hidden');
    },
    act_set: function (evt) {
        evt.preventDefault();
        let id = $(event.target).attr('data-id');
        
        let model = this.collection.get(id);
        console.log(model);
        let viewChoixJunior = new ViewChoixJuniors({
            collection: collectionJuniors,
            model: model
        });
        $('#popup1').removeClass('hidden');
        $('.popup').empty();
        viewChoixJunior.render().appendTo(".popup");
        viewChoixJunior.delegateEvents();
    },

    choisirjun: function (evt) {
        let idjun = $(event.target).attr('data-id');
        let idDemande = $(event.target).attr('demande-id');
        console.log(idDemande);
        let model = this.collection.get(idDemande);
        let statut = "reçu";
        model.set({
            junior_id: idjun,
            statut: statut
        });
        console.log(model);
        model.save();

    },
    initialize: function (attrs, options) {
        this.template = tmplDefault;
        this.listenTo(this.collection, "all", this.render);
    },
    render: function () {
        this.$el.html(this.template({
            collectionDemandes: this.collection.toJSON()
        }));
        return this.$el;
    }
});
