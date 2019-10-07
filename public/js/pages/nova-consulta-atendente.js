var script = {};

$(document).ready(function () {
    script.iniciar();
});

script = {
    campos:[],
    dados:{
        _token:$('meta[name="csrf-token"]').attr('content')
    },
    idEspecialidadeTemp:null,
    idRegistroRegionalTemp:null,
    idVinculoTemp:null,
    dataAgendamentoTemp:null,

    //Privados
    iniciarCampos:function () {

        this.campos.divErroEspecialidade            = $("#erro-especialidade");
        this.campos.divErroAgendamento              = $("#erro-agendamento");
        this.campos.divMessagem                     = $("#dialog");


        this.campos.vinculo                         = $("#vinculo-id");
        this.campos.especialidade                   = $("#especialidade-id");
        this.campos.paciente                        = $("#paciente-id");
        this.campos.divDiasSemana                   = $("#div-dias-semana");
        this.campos.divDataAgendamento              = $("#div-data-agendamento");
        this.campos.divDataHorario                  = $("#div-horario");
        this.campos.dataAgendamento                 = $("#data-agendamento");
        this.campos.horario                         = $("#horario-agendamento");

        this.campos.cardEspecialidade               = $("#card-especialidade");
        this.campos.cardMedico                      = $("#card-medico");
        this.campos.cardLocal                       = $("#card-local");
        this.campos.cardHorario                     = $("#card-horario");



        this.campos.botaoAgendar                    = $("#btn-agendar");

        this.campos.divMessagem.dialog({
            uiLibrary:'bootstrap4',
            title:'Agendamento Realizado',
            modal:true,
            autoOpen:false,
            resizable:false,
            draggable:false,
            width:350,
            closed:function () {
                window.location = window.location.origin+"/atendente/consultas/listar";
            },
        });

        this.ajaxListarDiasSemanas();


    },

    aparecerElementos:function (elemento, config) {
        elemento.animate(config,"slow");
    },

    iniciarBotoes:function () {
        var myself = this;


        myself.campos.botaoAgendar.click(function () {
            var horario = myself.campos.horario.val();

            if(horario===""){
                myself.campos.divErroAgendamento.slideDown();
            }else{
                myself.campos.divErroAgendamento.slideUp();
                myself.ajaxCadastrar();
            }

        });

    },

    ajaxListarDiasSemanas: function () {
        var myself = this;
        myBlock();
        $.ajax({
            url: window.location.origin + "/paciente/agendamento/listar-dias-semana",
            data:{
                vinculo_id:myself.campos.vinculo.val(),
            },
            method: "get",
            success: function (data) {
                console.log(data);
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

    getConfigDatePicker:function (selecionado) {
        var myself = this;
        var dias = [0,1,2,3,4,5,6];
        for(var i = 0; i < dias.length;i++){
            if(selecionado == dias[i]){
                dias.splice(i,1);
            }
        }
        var data = new Date();
        data.setDate(data.getDate()-1);
        var config = {
            uiLibrary:'bootstrap4',
            iconsLibrary:'fontawesome',
            disableDaysOfWeek:dias,
            locale:'pt-br',
            minDate: data,
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

    ajaxListarHorarios: function () {
        var myself = this;
        myBlock();
        $.ajax({
            url: window.location.origin + "/paciente/agendamento/listar-horarios",
            data:{
                vinculo_id:myself.campos.vinculo.val(),
                paciente_id:myself.campos.paciente.val(),
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

    ajaxCadastrar: function () {
        var myself = this;
        myself.dados['vinculo_id'] = myself.campos.vinculo.val();
        myself.dados['data_agendamento'] = myself.campos.dataAgendamento.val();
        myself.dados['horario_agendamento'] = myself.campos.horario.val();
        myself.dados['especialidade_id'] = myself.campos.especialidade.val();
        myself.dados['paciente_id'] = myself.campos.paciente.val();
        myBlock();
        $.ajax({
            url: window.location.origin + "/paciente/agendamento/cadastrar",
            data:myself.dados,
            method: "post",
            success: function (data) {
                myself.campos.divMessagem.open();


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


    //Publicos
    iniciar:function () {
        this.iniciarCampos();
        this.iniciarBotoes();

    }
};