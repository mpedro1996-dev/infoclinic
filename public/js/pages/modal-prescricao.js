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
    indexErrors:['nome_remedio','quantidade','unidade_medida','consulta_id','periodo'],

    iniciarCampos:function () {
        this.campos.modalCadastrarPrescricao    = $("#modal-cadastrar-prescricao");
        this.campos.modalBlockUi                = $("#modal-block-ui");
        this.campos.listaErros                  = $("#lista-erros");
        this.campos.tbodyListaPrescricao        = $("#tbody-lista-prescricao");

        this.idTemp                             = $("#consulta_id").val();
        this.campos.medicamento                 = $("#medicamento");
        this.campos.quantidade                  = $("#quantidade");
        this.campos.unidadeMedida               = $("#unidade-medida");
        this.campos.posologia                   = $("#posologia");
        this.campos.btnEnviar                   = $("#btn-enviar");





    },

    iniciarBotoes:function () {
        var myself = this;

        $("#btn-enviar").click(function () {
            myself.recolherDadosEEnviar();
        });

        $("#btn-modal-prescricao").on("click",function (e) {
            e.preventDefault();
            myself.preencherTabela();
            myself.campos.modalCadastrarPrescricao.modal();
        });

        myself.campos.tbodyListaPrescricao.on("click","#btn-excluir",function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            myself.deletarPrescricao(id);
        });
    },

    recolherDadosEEnviar: function () {
        var myself = this;
        myself.dados['consulta_id']           = myself.idTemp;
        myself.dados['nome_remedio']          = myself.campos.medicamento.val();
        myself.dados['quantidade']            = myself.campos.quantidade.val();
        myself.dados['unidade_medida']        = myself.campos.unidadeMedida.val();
        myself.dados['periodo']               = myself.campos.posologia.val();
        myself.executarEnvio();

    },

    executarEnvio: function () {
        var myself = this;
        myBlock();
        $.ajax({
            url: window.location.origin + "/medico/prescricao/cadastrar",
            data: myself.dados,
            method: "post",
            success: function (data) {
                myself.preencherTabela();
                myself.limpar();
            },
            error: function (data) {
                var erros = data.responseJSON.errors;
                if(erros!==undefined){
                    myself.campos.listaErros.empty();
                    myself.indexErrors.forEach(function(e){
                        if(erros.hasOwnProperty(e)){
                            erros[e].forEach(function (erro) {
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

    deletarPrescricao: function(id){
        var myself = this;
        myself.ajaxDeletarPrescricao(id);
    },

    ajaxPreencherTabela: function () {
        var myself = this;

        myBlock();
        $.ajax({
            url:window.location.origin + "/medico/prescricao/listar",
            data:{id:myself.idTemp},
            method:"get",
            success:function (data) {
                myself.campos.tbodyListaPrescricao.empty();

                if(data.length>0){
                    data.forEach(function (e) {
                        myself.campos.tbodyListaPrescricao.append(
                            "<tr>"+
                            "<td>"+e.nome+"</td>"+
                            "<td>"+e.posologia+"</td>"+
                            "<td><a href='#' data-id='"+e.id+"' class='btn btn-link' id='btn-excluir' data-toggle='tooltip' title='Excluir'><i class='fa fa-trash'></i></a></td>"+
                            "</tr>"
                        );
                    });

                }else{
                    myself.campos.tbodyListaPrescricao.append(
                        "<tr>"+
                        "<td colspan='3'>Não há registros cadastros</td>"+
                        "</tr>"
                    );
                }


            },
            error:function (data) {
            }
        });


    },

    ajaxDeletarPrescricao: function (id) {
        var myself = this;
        var dados = {};
        dados['id'] = id;
        myBlock();
        $.ajax({
            url:window.location.origin + "/medico/prescricao/delete",
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

    limpar:function () {
        var myself = this;

        myself.campos.medicamento.val("");
        myself.campos.quantidade.val("");
        myself.campos.unidadeMedida.val("");
        myself.campos.posologia.val("");

    },





    iniciar:function () {
        this.iniciarCampos();
        this.iniciarBotoes();

    }
}