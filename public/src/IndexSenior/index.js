import backbone from "backbone";

import SeniorRouteur from "IndexSenior/Routers/SeniorRouter.js";

$(function () {
    let seniorRouteur = new SeniorRouteur();
    Backbone.history.start();
    var url = window.location.hash;
    if (!Backbone.history.navigate(url, true)) {
        Backbone.history.loadUrl();
    }
   
})