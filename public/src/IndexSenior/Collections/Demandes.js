import ModelDemande from "IndexSenior/Models/Demande.js";

export default Backbone.Collection.extend({

    url:"http://pingouin.heig-vd.ch/jurazone/api/demandes",
    model:ModelDemande,


})