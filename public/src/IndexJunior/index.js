import backbone from "backbone";

import juniorRouteur from "IndexJunior/Routers/JuniorRouter.js";

$(function () {
    let JuniorRouteur = new juniorRouteur();
    Backbone.history.start();
    var url = window.location.hash;
    if (!Backbone.history.navigate(url, true)) {
        Backbone.history.loadUrl();
    }
})