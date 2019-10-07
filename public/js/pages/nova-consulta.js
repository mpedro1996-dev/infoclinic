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

        this.campos.especialidade                   = $("#especialidade-id");
        this.campos.divErroEspecialidade            = $("#erro-especialidade");
        this.campos.divErroAgendamento              = $("#erro-agendamento");
        this.campos.divMessagem                     = $("#dialog");


        this.campos.nomeMedico                      = $("#nome-medico");
        this.campos.sexo                            = $("input[name='radio-sexo']");
        this.campos.medicoCheckboxPerto             = $("#medico-checkbox-perto");
        this.campos.tbodyListaMedicos               = $("#tbody-medico");

        this.campos.nomeClinica                     = $("#nome-clinica");
        this.campos.clinicaCheckboxPerto            = $("#clinica-checkbox-perto");
        this.campos.tbodyListaClinicas              = $("#tbody-clinica");

        this.campos.divDiasSemana                   = $("#div-dias-semana");
        this.campos.divDataAgendamento              = $("#div-data-agendamento");
        this.campos.divDataHorario                  = $("#div-horario");
        this.campos.dataAgendamento                 = $("#data-agendamento");
        this.campos.horario                         = $("#horario-agendamento");

        this.campos.cardEspecialidade               = $("#card-especialidade");
        this.campos.cardMedico                      = $("#card-medico");
        this.campos.cardLocal                       = $("#card-local");
        this.campos.cardHorario                     = $("#card-horario");



        this.campos.botaoEnviarEspecialidade        = $("#btn-enviar-especialidade");
        this.campos.botaoProcurarMedico             = $("#btn-procurar-medico");
        this.campos.botaoProcurarLocal              = $("#btn-procurar-local");
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
                window.location = window.location.origin+"/paciente/consultas/listar";
            },
        });


    },

    aparecerElementos:function (elemento, config) {
        elemento.animate(config,"slow");
    },

    iniciarBotoes:function () {
        var myself = this;

        myself.campos.botaoEnviarEspecialidade.click(function () {
            var especialidade = myself.campos.especialidade.val();

            if(especialidade==""){
                myself.campos.divErroEspecialidade.slideDown();
            }else{
                myself.campos.divErroEspecialidade.slideUp();
                nav.trocarCard(myself.campos.cardMedico);
                nav.trocarNav(nav.lista.medico);
                myself.idEspecialidadeTemp = myself.campos.especialidade.val();
                myself.ajaxListarMedicos();

            }
        });

        myself.campos.botaoProcurarMedico.click(function () {
            nav.trocarCard(myself.campos.cardMedico);
            nav.trocarNav(nav.lista.medico);
            myself.ajaxListarMedicos();
        });

        myself.campos.tbodyListaMedicos.on('click','#btn-locais',function () {
            myself.idRegistroRegionalTemp = $(this).data('id');
            nav.trocarCard(myself.campos.cardLocal);
            nav.trocarNav(nav.lista.local);
            myself.ajaxListarClinicas();
        });

        myself.campos.tbodyListaClinicas.on('click','#btn-horarios',function () {
            myself.idVinculoTemp = $(this).data('id');
            nav.trocarCard(myself.campos.cardHorario);
            nav.trocarNav(nav.lista.horario);
            myself.ajaxListarDiasSemanas();
        });

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

    iniciarInteracoes:function () {
        var myself = this;

        myself.campos.especialidade.change(function () {
            var especialidade = myself.campos.especialidade.val();

            if(especialidade==""){
                myself.campos.divErroEspecialidade.slideDown();
            }else{
                myself.campos.divErroEspecialidade.slideUp();
            }
        });

    },

    ajaxListarMedicos: function () {
        var myself = this;
        myBlock();
        $.ajax({
            url: window.location.origin + "/paciente/agendamento/listar-medicos",
            data:{
                especialidade:myself.idEspecialidadeTemp,
                estaPerto:myself.campos.medicoCheckboxPerto.is(":checked")?true:false,
                nomeMedico:myself.campos.nomeMedico.val(),
                sexo:myself.campos.sexo.filter(":checked").val()
            },
            method: "get",
            success: function (data) {
                myself.preencherTabelaMedicos(data);

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

    preencherTabelaMedicos:function (data) {
        var myself = this;

        myself.campos.tbodyListaMedicos.empty();
        if(data.length>0){
            data.forEach(function (dado) {
                myself.campos.tbodyListaMedicos.append(
                    "<tr>" +
                    "<td>"+dado['nome_medico']+"</td>"+
                    "<td>"+dado['sexo']+"</td>"+
                    "<td>"+dado['tipo_registro']+"</td>"+
                    "<td>"+dado['numero']+"</td>"+
                    "<td>"+dado['uf']+"</td>"+
                    "<td><button type='button' data-id='"+dado['id']+"' class='btn btn-primary' data-toggle='tooltip' title='Visualizar Locais' id='btn-locais'><i class='fa fa-map-marked-alt'></i></button></td>"+
                    "</tr>"
                );
            });
            $('[data-toggle="tooltip"]').tooltip();
        }else{
            myself.campos.tbodyListaMedicos.append(
                "<tr>" +
                "<td colspan='6'>Não há registro cadastrados</td>"+
                "</tr>"
            );
        }

    },

    ajaxListarClinicas: function () {
        var myself = this;
        myBlock();
        $.ajax({
            url: window.location.origin + "/paciente/agendamento/listar-clinicas",
            data:{
                registro_regional_id:myself.idRegistroRegionalTemp,
                especialidade:myself.idEspecialidadeTemp,
                estaPerto:myself.campos.clinicaCheckboxPerto.is(":checked")?true:false,
                nomeClinica:myself.campos.nomeClinica.val(),

            },
            method: "get",
            success: function (data) {
                console.log(data);
                myself.preencherTabelaClinicas(data);

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

    preencherTabelaClinicas:function (data) {
        var myself = this;

        myself.campos.tbodyListaClinicas.empty();
        if(data.length>0){
            data.forEach(function (dado) {
                myself.campos.tbodyListaClinicas.append(
                    "<tr>" +
                    "<td>"+dado['razao_social']+"</td>"+
                    "<td>"+dado['dias']+"</td>"+
                    "<td>"+dado['horario']+"</td>"+
                    "<td>"+dado['endereco']+"</td>"+
                    "<td>"+dado['cidade']+"</td>"+
                    "<td><button type='button' data-id='"+dado['vinculo_id']+"' class='btn btn-primary' data-toggle='tooltip' title='Agendar Horário' id='btn-horarios'><i class='fas fa-calendar-plus'></i></button></td>"+
                    "</tr>"
                );
            });
            $('[data-toggle="tooltip"]').tooltip();
        }else{
            myself.campos.tbodyListaClinicas.append(
                "<tr>" +
                "<td colspan='6'>Não há registro cadastrados</td>"+
                "</tr>"
            );
        }

    },

    ajaxListarDiasSemanas: function () {
        var myself = this;
        myBlock();
        $.ajax({
            url: window.location.origin + "/paciente/agendamento/listar-dias-semana",
            data:{
                vinculo_id:myself.idVinculoTemp,
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
                vinculo_id:myself.idVinculoTemp,
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
        myself.dados['vinculo_id'] = myself.idVinculoTemp;
        myself.dados['data_agendamento'] = myself.campos.dataAgendamento.val();
        myself.dados['horario_agendamento'] = myself.campos.horario.val();
        myself.dados['especialidade_id'] = myself.idEspecialidadeTemp;
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
        this.iniciarInteracoes();
        this.iniciarBotoes();

    }
};