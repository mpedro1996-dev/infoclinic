var nav ={
    lista:[],
    currentCard:null,
    currentNav:null,

    iniciarCampos:function () {
        this.lista.especialidade = $("#nav-especialidade");
        this.lista.medico        = $("#nav-medico");
        this.lista.local         = $("#nav-local");
        this.lista.horario       = $("#nav-horario");

        this.currentCard = script.campos.cardEspecialidade;
        this.currentNav = this.lista.especialidade;
    },

    iniciarInteracoes:function () {
        var myself = this;

        myself.lista.especialidade.click(function (e) {
            e.preventDefault();

            myself.trocarCard(script.campos.cardEspecialidade);
            myself.trocarNav(myself.lista.especialidade);
        });

        myself.lista.medico.click(function (e) {
            e.preventDefault();

            myself.trocarCard(script.campos.cardMedico);
            myself.trocarNav(myself.lista.medico);
        });

        myself.lista.local.click(function (e) {
            e.preventDefault();

            myself.trocarCard(script.campos.cardLocal);
            myself.trocarNav(myself.lista.local);
        });

        myself.lista.horario.click(function (e) {
            e.preventDefault();

            myself.trocarCard(script.campos.cardHorario);
            myself.trocarNav(myself.lista.horario);
        });

    },

    trocarCard:function (proximo) {
        this.currentCard.animate({
            width:'toggle',
            height:'toggle'
        },"slow",function () {
            proximo.animate({
                width:'toggle',
                height:'toggle'
            },"slow");

        });
        this.currentCard = proximo;
    },

    trocarNav:function (proximo) {
        if(proximo.is(':hidden')){
            proximo.show();
        }
        this.currentNav.removeClass("active");
        proximo.addClass("active");
        this.currentNav = proximo;

    },

    iniciar:function () {
        this.iniciarCampos();
        this.iniciarInteracoes();
    }

}

$(document).ready(function () {
    nav.iniciar();
});