import tmplDefault from "IndexAdmin/Templates/RdvValider.html";

export default Backbone.View.extend({  
    events: {
        "click .validerrdv": "act_set"
    },    
    act_set: function (evt) {
        evt.preventDefault();
        let id = $(event.target).attr('data-id');
        let model = this.collection.get(id);
        let statut = "validé";
        model.set({
            statut: statut
        });
        console.log(model);
        model.save();
    },
    initialize: function(attrs, options) {        
        this.template =  tmplDefault; 
        this.listenTo(this.collection, "all", this.render);
    },
    render: function () {
        this.$el.html(this.template({
            collectionDemandes: this.collection.toJSON()
        }));
        return this.$el;
    }
});