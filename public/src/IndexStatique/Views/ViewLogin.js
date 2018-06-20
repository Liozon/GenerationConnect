import tmplDefault from "IndexStatique/Templates/loginTemp.html";

export default Backbone.View.extend({
    events: {
        'click #button': 'login'
    },
    login: function (event) {
        event.preventDefault(); // Don't let this button submit the form
        $('.alert-error').hide(); // Hide any errors on a new submit
        var url = 'http://pingouin.heig-vd.ch/jurazone/auth/login';
        console.log('Loggin in... ');
        var formValues = {
            pseudo: $('#monPseudo').val(),
            password: $('#MonMot').val()
        };
        $.ajax({
            url: url,
            type: 'POST',
            dataType: "json",
            data: formValues,
            success: function (data) {
                console.log(["Login request details: ", data]);

                if (data == "senior") { // 
                    window.location.replace('IndexSenior/index.php');
                    console.log('oui');
                } else {
                    if (data == "junior") {
                        window.location.replace('IndexJunior/index.php');
                    } else {
                        if (data == "employe") {
                            window.location.replace('IndexAdmin/index.php');
                        } else {
                            $('.alert-error').text(data).show();
                            $(window).scrollTop(0, 0);
                        }
                    }
                };
            }
        });
    },

    initialize: function (attrs, options) {
        this.template = tmplDefault;
    },
    render: function () {
        this.$el.html(this.template());
        return this.$el;
    }
});
