import ViewIndex from "IndexJunior/Views/ViewIndex.js";
import ViewProfil from "IndexJunior/Views/ViewProfil.js";
import ViewDemandes from "IndexJunior/Views/ViewDemandes.js";
import ViewRDV from "IndexJunior/Views/ViewRDV.js";
import ViewRapports from "IndexJunior/Views/ViewRapports.js";

// Importation des collections et des vues partagées
import ListeDemandes from "IndexJunior/Collections/Demandes.js";
import InfosProfil from "IndexJunior/Collections/Junior.js";
import ViewListeDemandes from "IndexJunior/Views/ViewListeDemandes.js";
import ViewListeDemandesHistorique from "IndexJunior/Views/ViewListeDemandesHistorique.js";
import ViewListeProchainsRDV from "IndexJunior/Views/ViewListeDemandesAcceptees.js";
import ViewListeProchainsRDVDetails from "IndexJunior/Views/ViewListeDemandesAccepteesDetails.js";
import ViewInfosProfil from "IndexJunior/Views/ViewProfilInfosPerso.js";
import ViewProfilInfos from "IndexJunior/Views/ViewProfilInfos.js";
import ViewInfosBanque from "IndexJunior/Views/ViewProfilBanque.js";
import ViewInfosDisponibilites from "IndexJunior/Views/ViewProfilDisponibilites.js";

// Création des collections partagées
let listeDemandes = new ListeDemandes();
listeDemandes.fetch();

let infosProfil = new InfosProfil();
infosProfil.fetch();

// Vues utilisées dans plusieurs vues-parentes
let viewListeDemandes = new ViewListeDemandes({
    collection: listeDemandes
});

let viewListeDemandesHistorique = new ViewListeDemandesHistorique({
    collection: listeDemandes
});

let viewListeProchainsRDV = new ViewListeProchainsRDV({
    collection: listeDemandes
});

let viewListeProchainsRDVDetails = new ViewListeProchainsRDVDetails({
    collection: listeDemandes
});

let viewInfosProfil = new ViewInfosProfil({
    collection: infosProfil
});

let viewProfilInfos = new ViewProfilInfos({
    collection: infosProfil
});

let viewInfosBanque = new ViewInfosBanque({
    collection: infosProfil
});

let viewInfosDisponibilites = new ViewInfosDisponibilites({
    collection: infosProfil
});

// Initialisation du router
export default Backbone.Router.extend({
    initialize: function () {

    },
    routes: {
        "": "index", // #index
        "index": "index", // #index
        "profil": "profil", //#junior
        "demandes": "demandes", //#demandes
        "rdv": "rdv", //#rdv
        "rapports": "rapports", //#rapports
        "disconnect": "disconnect", //#disconnect
    },
    index: function () {
        // Vue parente
        let viewIndex = new ViewIndex();
        $('.main').empty();
        viewIndex.render().appendTo('.main');

        // Vue enfant demandes en attentes
        $('.liste-demandes').empty();
        viewListeDemandes.render().appendTo('.liste-demandes');
        viewListeDemandes.delegateEvents();

        // Vue enfant prochains RDV
        $('.liste-prochains-rdv').empty();
        viewListeProchainsRDV.render().appendTo('.liste-prochains-rdv');
        viewListeProchainsRDV.delegateEvents();
    },
    profil: function () {
        let viewProfil = new ViewProfil();
        $('.main').empty();
        viewProfil.render().appendTo('.main');

        // Vue enfant détails profil
        $('.infos-profil').empty();
        viewInfosProfil.render().appendTo('.infos-profil');
        viewInfosProfil.delegateEvents();

        // Vue enfant carte profil
        $('.infos-profil-card').empty();
        viewProfilInfos.render().appendTo('.infos-profil-card');
        viewProfilInfos.delegateEvents();

        // Vue enfant détails banque
        $('.infos-banque').empty();
        viewInfosBanque.render().appendTo('.infos-banque');
        viewInfosBanque.delegateEvents();
        
        // Vue enfant détails disponibilités
        $('.infos-disponibilites').empty();
        viewInfosDisponibilites.render().appendTo('.infos-disponibilites');
        viewInfosDisponibilites.delegateEvents();
    },
    demandes: function () {
        // Vue parente
        let viewDemandes = new ViewDemandes();
        $('.main').empty();
        viewDemandes.render().appendTo('.main');

        // Vue enfant
        $('.liste-demandes').empty();
        viewListeDemandes.render().appendTo('.liste-demandes');
        viewListeDemandes.delegateEvents();

        // Vue enfant
        $('.liste-historique').empty();
        viewListeDemandesHistorique.render().appendTo('.liste-historique');
        viewListeDemandesHistorique.delegateEvents();
    },
    rdv: function () {
        let viewRDV = new ViewRDV();
        $('.main').empty();
        viewRDV.render().appendTo('.main');

        // Vue enfant prochains RDV
        $('.liste-prochains-rdv').empty();
        viewListeProchainsRDVDetails.render().appendTo('.liste-prochains-rdv');
        viewListeProchainsRDVDetails.delegateEvents();
    },
    rapports: function () {
        let viewRapports = new ViewRapports();
        $('.main').empty();
        viewRapports.render().appendTo('.main');
        
        // Vue enfant
        $('.liste-historique').empty();
        viewListeDemandesHistorique.render().appendTo('.liste-historique');
        viewListeDemandesHistorique.delegateEvents();
    },
    disconnect: function () {
        window.location.href = '../';
    }
});