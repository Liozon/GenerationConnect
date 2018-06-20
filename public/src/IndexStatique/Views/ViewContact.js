import tmplDefault from "IndexStatique/Templates/contactTemp.html";

export default Backbone.View.extend({
   /* events: {
        'form submit': 'act_send'
    },
    act_send: function (evt) {
        let inputNomComp = this.$el.find("#nomComp");
        let inputNoTel = this.$el.find("#numberTel");
        let inputEmail = this.$el.find("#emailCont");
        let inputMessage = this.$el.find("#messageCont");
        let nom = inputNomComp.val();
        let noTel = inputNoTel.val();
        let email = inputEmail.val();
        let message = inputMessage.val();
        let test = nom + email + noTel +message;
        alert(test);
        //inputTask.val('');
        //inputDate.val('');
        //inputTask.focus();
        //evt.preventDefault();
    },*/
    initialize: function (attrs, options) {
        this.template = tmplDefault;
    },
    render: function () {
        this.$el.html(this.template());
        return this.$el;
    }
});
