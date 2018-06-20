import ModelDemande from "IndexAdmin/Models/ModelDemande.js";
//import {LocalStorage} from 'backbone.localstorage';

export default Backbone.Collection.extend({
    url: "http://pingouin.heig-vd.ch/jurazone/api/demandes",
    model: ModelDemande,    
//    localStorage: new LocalStorage('listeDemandes'),
    /*comparator: function (model) {
        return -model.get("date")
    }*/
});