import ModelSenior from "IndexSenior/Models/Senior.js";
//import {LocalStorage} from 'backbone.localstorage';

export default Backbone.Collection.extend({
    url: "http://pingouin.heig-vd.ch/jurazone/api/seniors",
    model: ModelSenior,
//    localStorage: new LocalStorage('listeDemandes'),
    /*comparator: function (model) {
        return -model.get("date")
    }*/
});