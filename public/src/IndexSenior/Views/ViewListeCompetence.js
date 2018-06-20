import tmplDefault from "IndexSenior/Templates/ListeCompetence.html";


export default Backbone.View.extend({



    initialize: function(attrs, options) {
        this.template =  tmplDefault;
    },
    render: function() {
        this.$el.html(this.template({
            competence: this.collection.toJSON(),
        }));
        return this.$el;
    }
});