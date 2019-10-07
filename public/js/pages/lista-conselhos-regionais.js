var script = {};

$(document).ready(function () {
    script.iniciar();
});

script = {
    idTemp:null,
    dados:{
        _token:$('meta[name="csrf-token"]').attr('content')
    },
    campos:[],
    indexErrors:['registros_regional_id','especialidade_id'],

    iniciarCampos:function () {
        this.campos.modalCadastrarEspecialidade = $("#modal-cadastrar-especialidade");
        this.campos.modalBlockUi                = $("#modal-block-ui");
        this.campos.listaErros                  = $("#lista-erros");
        this.campos.tbodyListaEspecialista      = $("#tbody-lista-especialidade")

    },

    iniciarTabela:function () {
        var myself = this;
        $("#tabela-registros").on("click","#btn-especialidade",function (e) {
            e.preventDefault();
            myself.idTemp = $(this).data("id");
            myself.preencherTabela();
            myself.campos.modalCadastrarEspecialidade.modal();
        });
    },

    iniciarBotoes:function () {
        var myself = this;
        $("#btn-enviar").click(function () {
            myself.recolherDadosEEnviar();
        });

        myself.campos.tbodyListaEspecialista.on("click","#btn-excluir",function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            myself.deletarEspecialidade(id);
        });
    },

    recolherDadosEEnviar: function () {
        var myself = this;
        myself.dados['registros_regional_id'] = myself.idTemp;
        myself.dados['especialidade_id']      = $("#especialidade").val();
        myself.executarEnvio();

    },

    executarEnvio: function () {
        var myself = this;
        myBlock();
        $.ajax({
            url: window.location.origin + "/medico/conselhos-regionais/especialidade/cadastrar",
            data: myself.dados,
            method: "post",
            success: function (data) {
                myself.preencherTabela();
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

    preencherTabela: function(){
        var myself = this;

        myself.ajaxPreencherTabela();

    },

    deletarEspecialidade: function(id){
        var myself = this;
        myself.ajaxDeletarEspecialidade(id);
    },

    ajaxPreencherTabela: function () {
        var myself = this;

        myBlock();
        $.ajax({
            url:window.location.origin + "/medico/conselhos-regionais/especialidade/listar",
            data:{id:myself.idTemp},
            method:"get",
            success:function (data) {
                myself.campos.tbodyListaEspecialista.empty();

                if(data.length>0){
                    data.forEach(function (e) {
                        myself.campos.tbodyListaEspecialista.append(
                            "<tr>"+
                            "<td>"+e.nome+"</td>"+
                            "<td><a href='#' data-id='"+e.id+"' class='btn btn-link' id='btn-excluir' data-toggle='tooltip' title='Excluir'><i class='fa fa-trash'></i></a></td>"+
                            "</tr>"
                        );
                    });

                }else{
                    myself.campos.tbodyListaEspecialista.append(
                        "<tr>"+
                        "<td colspan='2'>Não há registros cadastros</td>"+
                        "</tr>"
                    );
                }


            },
            error:function (data) {
            }
        });


    },

    ajaxDeletarEspecialidade: function (id) {
        var myself = this;
        var dados = {};
        dados['id'] = id;
        myBlock();
        $.ajax({
            url:window.location.origin + "/medico/conselhos-regionais/especialidade/delete",
            data:dados,
            method:"get",

            success:function (data) {
                myself.preencherTabela();
                myself.campos.listaErros.empty();
                myself.campos.listaErros.append("<p class='text-success' id='erro-paragrafo' style='display: none;'>"+data.message+"</p>");
                $('#erro-paragrafo').slideDown();

                setTimeout(function(){$('#erro-paragrafo').hide(1000);},4000);


            },
            error:function (data) {
            }
        });



    },





    iniciar:function () {
        this.iniciarCampos();
        this.iniciarTabela();
        this.iniciarBotoes();

    }
}