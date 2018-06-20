import tmplDefault from "IndexJunior/Templates/rdv.html";

export default Backbone.View.extend({     
    initialize: function(attrs, options) {        
        this.template =  tmplDefault;                
    },
    render: function() {      
        this.$el.html(this.template());
        return this.$el; 
    }
});