import tmplDefault from "IndexStatique/Templates/inscriptionTemp.html";
import ModelInscription from "IndexStatique/Models/ModelInscription";


export default Backbone.View.extend({
    events: {
        'click .btn-senior': 'sen_add',
        'click .btn-junior': 'jun_add',
        'form submit': 'convertData',
        'click #btnJuniorForm': 'showJuniorForm',
        'click #btnSeniorForm': 'showSeniorForm',
        'click td': 'showDisponibility',
        'click #reset_form': 'resetForm'
    },
    sen_add: function (evt) {
        event.preventDefault(); 
        let sexe = this.$el.find(".seniorInputSex").val();
        let prenom = this.$el.find("#seniorInputFirstName").val();
        let nom = this.$el.find("#seniorInputName").val();
        let pseudo = this.$el.find("#seniorInputPseudo").val();
        let motdepasse = this.$el.find("#seniorInputPassword").val();    
        let email = this.$el.find("#seniorInputEmail").val();    
        let adresse = this.$el.find("#seniorInputAddress").val();    
        let floor = this.$el.find("#seniorInputFloor").val();    
        let ville = this.$el.find("#seniorInputCity").val();    
        let canton = this.$el.find("#seniorInputState").val();  
        let npa = this.$el.find("#seniorInputNPA").val();
       var newInscription = {
            seniorInputSex: sexe,
            seniorInputFirstName: prenom,
            seniorInputName: nom,
            seniorInputPseudo: pseudo,
            seniorInputPassword: motdepasse,
            seniorInputEmail: email,
            seniorInputAddress: adresse,
            seniorInputFloor: floor,
            seniorInputCity: ville,
            seniorInputState: canton,
            seniorInputNPA: npa,
        };
        var url='http://pingouin.heig-vd.ch/jurazone/api/seniors';
        $.ajax({
            url:url,
            type:'POST',
            dataType:"json",
            data: newInscription,
            success:function (data) {
                console.log(["Inscription requete: ", data]);
               
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
       // this.collection.create(newInscription.toJSON());
        
    },
    jun_add: function (evt) {
        event.preventDefault(); 
        let sexe = this.$el.find(".radioHFA").val();
        let prenom = this.$el.find("#juniorInputFirstName").val();
        let nom = this.$el.find("#juniorInputName").val();
        let pseudo = this.$el.find("#juniorInputPseudo").val();
        let motdepasse = this.$el.find("#juniorInputPassword").val();    
        let email = this.$el.find("#juniorInputEmail").val();    
        let adresse = this.$el.find("#juniorInputAddress").val();     
        let ville = this.$el.find("#juniorInputCity").val();    
        let canton = this.$el.find("#juniorInputState").val();  
        let npa = this.$el.find("#juniorInputNPA").val();
        var newInscription = {
            juniorInputSex: sexe,
            juniorInputFirstName: prenom,
            juniorInputName: nom,
            juniorInputPseudo: pseudo,
            juniorInputPassword: motdepasse,
            juniorInputEmail: email,
            juniorInputAddress: adresse,
            juniorInputCity: ville,
            juniorInputState: canton,
            juniorInputNPA: npa,
        };
        var url='http://pingouin.heig-vd.ch/jurazone/api/juniors';
        $.ajax({
            url:url,
            type:'POST',
            dataType:"json",
            data: newInscription,
            success:function (data) {
                console.log(["Inscription requete: ", data]);
               
                if(data=="correct") {  // If there is an error, show the error messages
                    window.location.replace('#index');
                    alert('Vous êtes bien inscrits ! Vous recevrez un e-mail pour connaître la suite de votre postulation ! Merci !');
                }
                else { // If not, send them back to the home page
                    //window.location.replace('IndexJunior/index.php');
                    $('.alert-error').text(data).show();
                    $(window).scrollTop(0,0); 
                };
            }
        });
        
    },

 convertData: function(evt) {
    // "bypassEmptyValues" permet de switcher entre suppression ou non des valeurs vides. True = suppression / False = pas de suppression
    var bypassEmptyValues = false;
    var html = '<input type="text" name="juniorInputDisponibilities" id="disponibilities">';
    var json = '{';
    var otArr = [];
    var tbl2 = $('#dispo_table tr').each(function (i) {
        x = $(this).children();
        var itArr = [];
        x.each(function () {
            if (bypassEmptyValues == true && $(this).text() != '') {
                itArr.push('"' + $(this).text() + '"');
            } else {
                itArr.push('"' + $(this).text() + '"');
            }
        });
        otArr.push('"' + i + '": [' + itArr.join(',') + ']');
    });
    json += otArr.join(",") + '}';
    $("#results_dispo").append(html);
    $("#disponibilities").val(json);
},

 showJuniorForm: function(evt) {
    $(".formJunior").removeClass("hidden");
    $(".formSenior").addClass("hidden");
    $("#btnJuniorForm").addClass("btn-primary");
    $("#btnJuniorForm").removeClass("btn-secondary");
    $("#btnSeniorForm").removeClass("btn-primary");
    $("#btnSeniorForm").addClass("btn-secondary");
},

showSeniorForm: function(evt) {
    $(".formSenior").removeClass("hidden");
    $(".formJunior").addClass("hidden");
    $("#btnJuniorForm").removeClass("btn-primary");
    $("#btnJuniorForm").addClass("btn-secondary");
    $("#btnSeniorForm").addClass("btn-primary");
    $("#btnSeniorForm").removeClass("btn-secondary");
},

showDisponibility: function (event) {
        var target = $(event.target);
        if (target.hasClass("available")) {
            target.removeClass("available");
            target.empty();
        } else {
            target.addClass("available");
            var id = target.attr("dispo-day");
            target.append(id);
        }
    },

resetForm: function(evt) {
    $('#dispo_table td').each(function (i) {
        $(this).empty();
        $(this).removeClass("available");
    })
},
    initialize: function (attrs, options) {
        this.template = tmplDefault;
    },
    render: function () {
        this.$el.html(this.template());
        return this.$el;
    }
});
