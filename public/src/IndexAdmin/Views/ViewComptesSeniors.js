import tmplDefault from "IndexAdmin/Templates/ComptesSeniors.html";

export default Backbone.View.extend({ 
    events: {
        'click .modifier-affiche': 'affiche_modif',
        'click .savechange': 'save_modif'
    },
    affiche_modif: function (event) {  
        let id = $(event.target).attr('id');
        let model = this.collection.get(id);
        let user= model.get('user');
        $('#modifPseudo').attr('value', user.pseudo);
        $('#modifEmail').attr('value', user.email);
        $('#modifPrenom').attr('value', user.prenom);
        $('#modifNom').attr('value', user.nom);
        $('#modifAdresse').attr('value', user.adresse);
        $('#modifFloor').attr('value', model.get('etage'));
        $('#modifCity').attr('value', user.ville);
        $('#seniorInputNPA').attr('value', user.codePostal);
        $('#modifTel1').attr('value', user.telephone);
        $('#modifTel2').attr('value', user.telephone_2);
        $('.savechange').attr('data-id', id);
    },
    save_modif: function(evt){
        let pseudo=$('#modifPseudo').val();
        let email=$('#modifEmail').val();
        let nom=$('#modifNom').val();
        let prenom=$('#modifPrenom').val();
        let adresse=$('#modifAdresse').val();
        let floor=$('#modifFloor').val();
        let npa=$('#modifNPA').val();
        let city=$('#modifCity').val();
        let tel1=$('#modifTel1').val();
        let tel2=$('#modifTel2').val();
        let id = $(event.target).attr('data-id');
        let model = this.collection.get(id);
        model.set({pseudo: pseudo, email: email, prenom: prenom, nom: nom, adresse: adresse, etage: floor, ville: city, codePostal: npa, telephone: tel1, telephone_2: tel2});
        model.save();
        
    },
    initialize: function(attrs, options) {        
        this.template =  tmplDefault;                
    },
    render: function() {      
        this.$el.html(this.template({
            collectionSeniors : this.collection.toJSON()
        }));
        return this.$el; 
    }
});