export default Backbone.Model.extend({
    /*initialize: function (attrs, option) {
        console.log(this.toJSON());
        this.on("add remove change", function () {
            console.log("Modification in element: ");
            console.log(this.toJSON());
        })
    },*/
    defaults: {
        titre: '',
        description: ''
    }/*,
    validate: function (attrs, options) {
        if (!_.isString(attrs.titre) || attrs.titre.trim() == '' || !_.isString(attrs.description) || attrs.description.trim() == '') {
            return "Invalide";
        }
        if (!_.isDate(attrs.date)) {
            return "Date invalide";
        }
    }*/
});