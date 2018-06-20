import ModelLogin from "IndexStatique/Models/ModelLogin";

export default Backbone.Collection.extend({
    model: ModelLogin,
    url: "http://pingouin.heig-vd.ch/jurazone/auth/login",
    
})