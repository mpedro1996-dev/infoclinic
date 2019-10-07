var script = {};

$(document).ready(function () {
    script.iniciar();
});

script = {
    campos:[],
    modal:null,
    formulario:null,
    idConsulta:null,

    iniciarCampos:function () {
        this.formulario                = $("#formulario");
        this.campos.idConsulta         = $("#id");
        this.campos.divDiasSemana      = $("#div-dias-semana");
        this.campos.divDataAgendamento = $("#div-data-agendamento");
        this.campos.divErroAgendamento = $("#erro-agendamento");
        this.campos.divDataHorario     = $("#div-horario");
        this.campos.dataAgendamento    = $("#data-agendamento");
        this.campos.horario            = $("#horario-agendamento");
        this.campos.btnCadastrar       = $("#btn-cadastrar");

        this.modal                     = $("#modal-cadastrar-retorno");

    },

    aparecerElementos:function (elemento, config) {
        elemento.animate(config,"slow");
    },

    iniciarBotoes:function () {
        var myself = this;
        $("#tabela-corpo").on("click","#btn-retorno",function (e) {
            e.preventDefault();
            myself.idConsulta = $(this).data('id');
            myself.campos.idConsulta.val(myself.idConsulta);
            myself.ajaxListarDiasSemanas();
            myself.modal.modal();
        });

        myself.campos.horario.change(function () {
            var horario = myself.campos.horario.val();

            if(horario===""){
                myself.campos.divErroAgendamento.slideDown();
                myself.campos.btnCadastrar.slideUp();
            }else{
                myself.campos.divErroAgendamento.slideUp();
                myself.campos.btnCadastrar.slideDown();
            }

        });
    },

    ajaxListarDiasSemanas: function () {
        var myself = this;
        myBlock();
        $.ajax({
            url: window.location.origin + "/retorno/listar-dias-semana",
            data:{
                consulta_id:myself.idConsulta,
            },
            method: "get",
            success: function (data) {
                myself.listarDiasSemanas(data);

            },
            error: function (data) {
                var erros = data.responseJSON.errors;
                if(erros!==undefined){
                    myself.indexErrors.forEach(function(e){
                        if(erros.hasOwnProperty(e)){
                            erros[e].forEach(function (erro) {
                                myself.campos.listaErros.empty();
                                myself.campos.listaErros.append("<p class='text-danger' id='erro-paragrafo' style='display: none;'>"+erro+"</p>");
                                $('#erro-paragrafo').slideDown();
                                setTimeout(function(){$('#erro-paragrafo').hide(1000);},4000);

                            })
                        }
                    });
                }
            }
        });
    },

    listarDiasSemanas:function (data) {
        var myself = this;
        myself.campos.divDiasSemana.empty();
        data.forEach(function (dado) {
            myself.campos.divDiasSemana.append(
                '<div class="form-check form-check-inline">'+
                '<input class="form-check-input" type="radio" name="dia-semana" id="'+dado['dia']+'" value="'+dado['valor']+'">'+
                '<label class="form-check-label" for="'+dado['dia']+'">'+dado['dia']+'</label>'+
                '</div>'
            );
        });
        myself.campos.radioDiasSemanas =  $("input[name='dia-semana']");
        myself.iniciarInteracoesHorario();



    },

    iniciarInteracoesHorario:function () {
        var myself = this;
        myself.campos.dataAgendamento.datepicker({uiLibrary:'bootstrap4'});

        myself.campos.radioDiasSemanas.change(function () {
            myself.aparecerElementos(myself.campos.divDataAgendamento,{width:'hide',height:'hide'});
            var selecionado = myself.campos.radioDiasSemanas.filter(":checked").val();
            var config = myself.getConfigDatePicker(selecionado);
            myself.campos.dataAgendamento.destroy();
            myself.campos.dataAgendamento.datepicker(config);
            myself.aparecerElementos(myself.campos.divDataAgendamento,{width:'show',height:'show'});
            myself.campos.dataAgendamento.click(function () {
                myself.campos.dataAgendamento.open();
            });

        });
    },

    getConfigDatePicker:function (selecionado) {
        var myself = this;
        var dias = [0,1,2,3,4,5,6];
        for(var i = 0; i < dias.length;i++){
            if(selecionado == dias[i]){
                dias.splice(i,1);
            }
        }
        var config = {
            uiLibrary:'bootstrap4',
            iconsLibrary:'fontawesome',
            disableDaysOfWeek:dias,
            locale:'pt-br',
            minDate: new Date(),
            format:"dd/mm/yyyy",
            header:true,
            close:function () {
                if(myself.campos.dataAgendamento.value()!==""&&myself.campos.dataAgendamento.value()!==myself.dataAgendamentoTemp){
                    myself.dataAgendamentoTemp = myself.campos.dataAgendamento.value();
                    myself.ajaxListarHorarios();
                }
            }
        };

        return config;

    },

    ajaxListarHorarios: function () {
        var myself = this;
        myBlock();
        $.ajax({
            url: window.location.origin + "/retorno/listar-horarios",
            data:{
                consulta_id:myself.idConsulta,
                data: myself.campos.dataAgendamento.val(),
                dia_semana: myself.campos.radioDiasSemanas.filter(":checked").val()
            },
            method: "get",
            success: function (data) {
                myself.preencherComboHorarios(data);


            },
            error: function (data) {
                var erros = data.responseJSON.errors;
                if(erros!==undefined){
                    myself.indexErrors.forEach(function(e){
                        if(erros.hasOwnProperty(e)){
                            erros[e].forEach(function (erro) {
                                myself.campos.listaErros.empty();
                                myself.campos.listaErros.append("<p class='text-danger' id='erro-paragrafo' style='display: none;'>"+erro+"</p>");
                                $('#erro-paragrafo').slideDown();
                                setTimeout(function(){$('#erro-paragrafo').hide(1000);},4000);

                            })
                        }
                    });
                }
            }
        });
    },

    preencherComboHorarios:function (data) {
        var myself = this;
        myself.aparecerElementos(myself.campos.divDataHorario,{width:'hide',height:'hide'});
        myself.campos.horario.empty();
        myself.campos.horario.append(new Option("Selecione",""));

        data.forEach(function (dado) {
            myself.campos.horario.append(new Option(dado,dado));
        });
        myself.aparecerElementos(myself.campos.divDataHorario,{width:'show',height:'show'});
    },

    iniciar:function () {
        this.iniciarCampos();
        this.iniciarBotoes();

    }
};