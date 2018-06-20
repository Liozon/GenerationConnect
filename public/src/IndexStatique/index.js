import backbone from "backbone";

import staticRouteur from "IndexStatique/Routers/StaticRouter.js";

$(function () {
    let StaticRouteur = new staticRouteur();
    Backbone.history.start();
    var url = window.location.hash;
    if (!Backbone.history.navigate(url, true)) {
        Backbone.history.loadUrl();
    }
})