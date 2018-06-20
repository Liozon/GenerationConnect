import backbone from "backbone";

import adminRouteur from "IndexAdmin/Routers/AdminRouter.js";

$(function () {
    let AdminRouteur = new adminRouteur();
     Backbone.history.start();
    var url = window.location.hash;
    if (!Backbone.history.navigate(url, true)) {
        Backbone.history.loadUrl();
    }
   
})