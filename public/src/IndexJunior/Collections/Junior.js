import ModelJunior from "IndexJunior/Models/Junior.js";
//import {LocalStorage} from 'backbone.localstorage';

export default Backbone.Collection.extend({
    url: "http://pingouin.heig-vd.ch/jurazone/api/juniors",
    model: ModelJunior,    
//    localStorage: new LocalStorage('listeDemandes'),
    /*comparator: function (model) {
        return -model.get("date")
    }*/
});