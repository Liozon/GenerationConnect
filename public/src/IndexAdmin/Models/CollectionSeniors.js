import ModelUser from "IndexAdmin/Models/ModelUser";

export default Backbone.Collection.extend({
    model: ModelUser,
    url: "http://pingouin.heig-vd.ch/jurazone/api/seniors",
    comparator: function(model){
        let user = model.get('user');
        return user.nom;
    }
})