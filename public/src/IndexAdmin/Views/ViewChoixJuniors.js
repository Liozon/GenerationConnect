import tmplDefault from "IndexAdmin/Templates/ChoixJunior.html";

export default Backbone.View.extend({ 
    events: {
        "click .voirprof": "act_see",
        "click .fermerprof": "act_hi" 
    },    
    act_see: function (evt) {
        let idDemande = this.model.get('id');
        
        let id = $(event.target).attr('data-id');
        let model = this.collection.get(id);
        let user = model.get('user');
        $('#popup1').addClass('hidden');
        $('#popup2').removeClass('hidden');
        $('.modal-title').empty();
        $('.modal-title').append(user.prenom+" ");
        $('.modal-title').append(user.nom);
        $('.nomjun').empty();
        $('.nomjun').append(user.prenom +" "+ user.nom);
        $('.villejun').empty();
        $('.villejun').append(user.ville);
        $('.aboutme').empty();
        $('.aboutme').append(model.get('aProposDeMoi'));
        $('.adressejun').empty();
        $('.adressejun').append(user.adresse+"<br/>");
        $('.imgjun').attr("src", user.photo);
        $('.choisirjun').attr("data-id", id);
        $('.choisirjun').attr("demande-id", idDemande);
        //$('.datenaissjun').append(date_naissance);
        //let competences = model.get('competences');
        /*$.each(competences, function(){
            $('.menu_comp').append('<li>'+Object.values(Object.values(competences))+'</li>');
        })*/
    },
    act_hi: function (evt) {
        $('#popup1').show();
    },
    initialize: function(attrs, options) {        
        this.template =  tmplDefault;                
    },
    render: function() {      
       this.$el.html(this.template({
            collectionJuniors : this.collection.toJSON(), 
           idDemande: this.model.toJSON()
        }));
        return this.$el; 
    }
});