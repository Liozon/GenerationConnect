import tmplDefault from "IndexSenior/Templates/nouvellesdemandes.html";

export default Backbone.View.extend({




    events: {
        //"click .btn_delete": "act_delete",
        "click .btn-valide": "act_valide",
        "click  .btn_popup": "act_popup"
    },


    act_valide: function(event) {

        let id = $(event.target).attr("")

        console.log("salut");
        let titre = this.$el.find(".titre_safa").val();
        //let competence = this.$el.find.("[id-competence]").val();
        let description = this.$el.find(".description_safa").val();
        let date = this.$el.find(".date_safa").val();
        let competence= $(".checkbox_safa:checked").attr("value");
        let heure= this.$el.find(".heure_safa").val();
        let duree = this.$el.find(".duree_safa").val();
        let statut="envoyé";
        let senior_id=1;


        var newDemande = {
            titre: titre,
            description: description,
            date: date,
            heure:heure,
            competence: competence,
            statut: statut,
            senior_id: senior_id,
            duree: duree

        };


        var url='http://pingouin.heig-vd.ch/jurazone/api/demandes';
        $.ajax({
            url:url,
            type:'POST',
            dataType:"json",
            data: newDemande,
            success:function (data) {
                console.log(["Demande requete: ", data]);

                if(data=="correct") {  // If there is an error, show the error messages
                    window.location.replace('#login');
                    alert('Vous êtes bien inscrits ! Vous pouvez désormais vous connecter dans la page login !');
                }
                else { // If not, send them back to the home page
                    //window.location.replace('IndexJunior/index.php');
                    $('.alert-error').text(data).show();
                    $(window).scrollTop(0,0);
                };
            }
        });
        console.log(newDemande);
        // this.collection.create(newInscription.toJSON());

    },

    act_popup: function (event) {
        let titre = this.$el.find(".titre_safa").val();
        let description = this.$el.find(".description_safa").val();
        let date = this.$el.find(".date_safa").val();
        let comp = $(".checkbox_safa:checked").attr("data-id");
        let heure = this.$el.find(".heure_safa").val();
        let duree = this.$el.find(".duree_safa").val();

        console.log(description);
        console.log(comp)

        $(".titre_popup_safa").append(titre);
        $(".description_popup_safa").append(description);
        $(".date_popup_safa").append(date);
        $(".competence_popup_safa").append(comp);
        $(".heure_popup_safa").append(heure);
        $(".duree_popup_safa").append(duree);

    },

    initialize: function(attrs, options) {
        this.template =  tmplDefault;
    },
    render: function() {
        this.$el.html(this.template());
        return this.$el;
    }
});