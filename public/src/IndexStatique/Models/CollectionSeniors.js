import ModelInscription from "IndexStatique/Models/ModelInscription";

export default Backbone.Collection.extend({
    model: ModelInscription,
    url: "http://pingouin.heig-vd.ch/jurazone/api/seniors"
})