import ModelCompetence from "IndexSenior/Models/Competence.js";

export default Backbone.Collection.extend({

    url:"http://pingouin.heig-vd.ch/jurazone/api/competences",
    model:ModelCompetence,


})