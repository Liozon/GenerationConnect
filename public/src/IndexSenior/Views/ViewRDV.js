import tmplDefault from "IndexSenior/Templates/rdv.html";

export default Backbone.View.extend({     
    initialize: function(attrs, options) {        
        this.template =  tmplDefault;                
    },
    render: function() {      
        this.$el.html(this.template({
            demandes: this.collection.toJSON(),
        }));
        return this.$el;
    }
});