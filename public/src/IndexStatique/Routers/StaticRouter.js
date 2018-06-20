import ViewIndex from "IndexStatique/Views/ViewIndex.js";
import ViewFaq from "IndexStatique/Views/ViewFaq.js";
import ViewCgv from "IndexStatique/Views/ViewCgv.js";
import ViewContact from "IndexStatique/Views/ViewContact.js";
import ViewInscription from "IndexStatique/Views/ViewInscription.js";
import ViewJunior from "IndexStatique/Views/ViewJunior.js";
import ViewLogin from "IndexStatique/Views/ViewLogin.js";
import ViewMentions from "IndexStatique/Views/ViewMentions.js";
import ViewSenior from "IndexStatique/Views/ViewSenior.js";

import CollectionSeniors from "IndexStatique/Models/CollectionSeniors.js";
import CollectionJuniors from "IndexStatique/Models/CollectionJuniors.js";
import CollectionLogins from "IndexStatique/Models/CollectionLogins.js";


let seniorInscriptions = new CollectionSeniors();
let juniorInscriptions = new CollectionJuniors();

let collectionLogins = new CollectionLogins();


export default Backbone.Router.extend({
    initialize: function () {
    },
    routes: {
        "": "index",
        "index": "index", // #index
        "junior": "junior", //#junior
        "senior": "senior", //#senior
        "contact": "contact", //#contact
        "inscription": "inscription", //#inscription
        "faq": "faq", //#faq  
        "cgv": "cgv", //#cgv
        "mentions": "mentions", //#mentions
        "login": "login", //#login
    },
    index: function () {
        let viewIndex = new ViewIndex();
        $('.main').empty();
        viewIndex.render().appendTo(".main");
        $(window).scrollTop(0,0);
    },
    junior: function () {
        let viewJunior = new ViewJunior();
        $('.main').empty();
        viewJunior.render().appendTo(".main");
        $(window).scrollTop(0,0);
    },
    senior: function () {
        let viewSenior = new ViewSenior();
        $('.main').empty();
        viewSenior.render().appendTo(".main");
        $(window).scrollTop(0,0);
    },
    contact: function () {
        let viewContact = new ViewContact();
        $('.main').empty();
        viewContact.render().appendTo(".main");
        $(window).scrollTop(0,0);
    },
    inscription: function () {
        let viewInscription = new ViewInscription({collection: seniorInscriptions, jun: juniorInscriptions});
        $('.main').empty();
        viewInscription.render().appendTo(".main");
        $(window).scrollTop(0,0);
    },
    mentions: function () {
        let viewMentions = new ViewMentions();
        $('.main').empty();
        viewMentions.render().appendTo(".main");
        $(window).scrollTop(0,0);
    },
    cgv: function () {
        let viewCgv = new ViewCgv();
        $('.main').empty();
        viewCgv.render().appendTo(".main");
        $(window).scrollTop(0,0);
    },
    faq: function () {
        let viewFaq = new ViewFaq();
        $('.main').empty();
        viewFaq.render().appendTo(".main");
        $(window).scrollTop(0,0);
    },
    login: function () {
        let viewLogin = new ViewLogin({collection: collectionLogins });
        $('.main').empty();
        viewLogin.render().appendTo(".main");
        $(window).scrollTop(0,0);
    },
});
