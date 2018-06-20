import tmplDefault from "IndexSenior/Templates/demandes.html";

export default Backbone.View.extend({

    events: {
        "click .btn_annuler": "act_delete"
    },
    act_delete: function (evt) {

        evt.preventDefault();
        let id = $(event.target).attr('data-id');
        let model = this.collection.get(id);
        let statut = "annulé";
        model.set({
           statut: statut
        });
        model.save();
    },

    initialize: function(attrs, options) {        
        this.template =  tmplDefault;  
        this.listenTo(this.collection, "all", this.render);              
    },
    render: function() {      
        this.$el.html(this.template({
            demandes: this.collection.toJSON(),
        }));
        return this.$el; 
    }
});