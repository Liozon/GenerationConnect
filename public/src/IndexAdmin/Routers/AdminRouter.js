import ViewIndex from "IndexAdmin/Views/ViewIndex.js";
import ViewDemandeRecep from "IndexAdmin/Views/ViewDemandeRecep.js";
import ViewComptesSeniors from "IndexAdmin/Views/ViewComptesSeniors.js";
import ViewInsererDemande from "IndexAdmin/Views/ViewInsererDemande.js";
import ViewComptesJuniors from "IndexAdmin/Views/ViewComptesJuniors.js";
import ViewRdvValider from "IndexAdmin/Views/ViewRdvValider.js";
import ViewPlanning from "IndexAdmin/Views/ViewPlanning.js";
import ViewChoixJunior from "IndexAdmin/Views/ViewChoixJuniors.js";

import CollectionJuniors from "IndexAdmin/Models/CollectionJuniors.js";
import CollectionSeniors from "IndexAdmin/Models/CollectionSeniors.js";
import CollectionDemandes from "IndexAdmin/Models/CollectionDemandes.js";

let collectionJuniors = new CollectionJuniors();
let collectionSeniors = new CollectionSeniors();
let collectionDemandes = new CollectionDemandes();

collectionJuniors.fetch();
collectionSeniors.fetch();
collectionDemandes.fetch();


let viewChoixJunior = new ViewChoixJunior({
    collection: collectionJuniors
});

export default Backbone.Router.extend({
    initialize: function () {
        console.log('Admin Dashboard');
    },
    routes: {
        "": "index",
        "index": "index", // #index
        "demanderecep": "demanderecep", //#junior
        "comptesseniors": "compteseniors", //#comptesseniors
        "insererdemande": "insererdemande", //#insererdemande
        "comptesjuniors": "comptesjuniors", //#comptesjuniors
        "rdvvalider": "rdvvalider", //#rdvvalider
        "planning": "planning", //#planing
        "disconnect": "disconnect", //#disconnect
    },
    index: function () {
        let viewIndex = new ViewIndex({
            collection: collectionDemandes
        });
        $('.main').empty();
        viewIndex.render().appendTo(".main");
        
        $(window).scrollTop(0, 0);
    },
    demanderecep: function () {
        let viewDemandeRecep = new ViewDemandeRecep({
            collection: collectionDemandes
        });
        $('.main').empty();
        viewDemandeRecep.render().appendTo(".main");
        $(window).scrollTop(0, 0);
    },
    compteseniors: function () {
        let viewComptesSeniors = new ViewComptesSeniors({
            collection: collectionSeniors
        });
        $('.main').empty();
        viewComptesSeniors.render().appendTo(".main");
        $(window).scrollTop(0, 0);
    },
    insererdemande: function () {
        let viewInsererDemande = new ViewInsererDemande();
        $('.main').empty();
        viewInsererDemande.render().appendTo(".main");
        $(window).scrollTop(0, 0);
    },
    comptesjuniors: function () {
        let viewComptesJuniors = new ViewComptesJuniors({
            collection: collectionJuniors
        });
        $('.main').empty();
        viewComptesJuniors.render().appendTo(".main");
        $(window).scrollTop(0, 0);
    },
    rdvvalider: function () {
        let viewRdvValider = new ViewRdvValider({
            collection: collectionDemandes
        });
        $('.main').empty();
        viewRdvValider.render().appendTo(".main");
        $(window).scrollTop(0, 0);
    },
    planning: function () {
        let viewPlanning = new ViewPlanning();
        $('.main').empty();
        viewPlanning.render().appendTo(".main");
        $(window).scrollTop(0, 0);
    },
    disconnect: function () {
        window.location.href = "../";
    }
});
