import ViewIndex from "IndexSenior/Views/ViewIndex.js";
import ViewProfil from "IndexSenior/Views/ViewProfil.js";
import ViewNouvellesDemandes from "IndexSenior/Views/ViewNouvellesDemandes.js";
import ViewDemandes from "IndexSenior/Views/ViewDemandes.js";
import ViewRDV from "IndexSenior/Views/ViewRDV.js";
import ViewEvaluations from "IndexSenior/Views/ViewEvaluation.js";
import ViewSuggestions from "IndexSenior/Views/ViewSuggestion.js";
import InfosProfil from "IndexSenior/Collections/Senior.js";
import Competence from "IndexSenior/Collections/Competence.js";
import ViewCompetence from "IndexSenior/Views/ViewListeCompetence.js";




import ListeDemandes from "IndexSenior/Collections/Demandes.js";
import ViewListeDemandes from "IndexSenior/Views/ViewListeDemandes.js";
import ViewInfosProfil from "IndexSenior/Views/ViewProfilInfosPerso.js";


let competence = new Competence();
competence.fetch();

let viewCompetence = new ViewCompetence({
    collection: competence
});


// Création des collections partagées
let listeDemandes = new ListeDemandes();
listeDemandes.fetch();

// Vues utilisées dans plusieurs vues-parentes
let viewListeDemandes = new ViewListeDemandes({
    collection: listeDemandes
});

let infosProfil = new InfosProfil();
infosProfil.fetch();

let viewInfosProfil = new ViewInfosProfil({
    collection: infosProfil
});






export default Backbone.Router.extend({
    initialize: function () {
        console.log('Senior Dashboard');
    },
    routes: {
        "": "index",
        "index": "index", // #index
        "profil": "profil", //#junior
        "demandes": "demandes", //#senior
        "nouvellesdemandes": "nouvellesdemandes", //#nouvellesdemandes
        "rdv": "rdv", //#contact
        "evaluations": "evaluations", //#evaluations
        "suggestions": "suggestions", //#suggestions


    },
    index: function () {
        let viewIndex = new ViewIndex();
        $('.main').empty();
        viewIndex.render().appendTo(".main");
    },
    profil: function () {
        let viewProfil = new ViewProfil();
        $('.main').empty();
        viewProfil.render().appendTo(".main");

        // Vue enfant détails profil
        $('.infos-profil').empty();
        viewInfosProfil.render().appendTo('.infos-profil');
    },
    demandes: function () {
        let viewDemandes = new ViewDemandes({collection: listeDemandes});
        $('.main').empty();
        viewDemandes.render().appendTo(".main");

        // Vue enfant liste demandes
        $('.liste-demandes').empty();
        viewListeDemandes.render().appendTo(".liste-demandes");


    },
    nouvellesdemandes: function () {
        let viewNouvellesDemandes = new ViewNouvellesDemandes({
            collection: listeDemandes
        });
        $('.main').empty();
        viewNouvellesDemandes.render().appendTo(".main");

        // Vue enfant liste demandes
        $('.liste-competence').empty();
        viewCompetence.render().appendTo(".liste-competence");
    },
    rdv: function () {
        let viewRDV = new ViewRDV();
        $('.main').empty();
        viewRDV.render().appendTo(".main");
    },
    evaluations: function () {
        let viewEvaluations  = new ViewEvaluations();
        $('.main').empty();
        viewEvaluations.render().appendTo(".main");
    },
    suggestions: function () {
        let viewSuggestions  = new ViewSuggestions();
        $('.main').empty();
        viewSuggestions.render().appendTo(".main");
    }
});