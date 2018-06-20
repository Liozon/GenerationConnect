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
    }
});