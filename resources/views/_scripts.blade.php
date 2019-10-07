<script>
    tinymce.init({
        selector: 'textarea',
        height: 200,
        branding: false,
        menu:{
            file: {title: 'File', items: 'newdocument'},
            edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
            insert: {title: 'Insert', items: 'link media | template hr'},
            view: {title: 'View', items: 'visualaid'},
            format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
            table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
            tools: {title: 'Tools', items: 'spellchecker code'}
        },
        menubar: 'file edit insert view format table tools help'
    });
</script>

<script>
    $(document).ready(function(){
        $('#cep').mask('00000-000');
        $('#cep_clinica').mask('00000-000');
        $('#cnpj').mask("00.000.000/0000-00");
        $('#cnpj_busca').mask("00.000.000/0000-00");
        $('#cpf').mask('000.000.000-00');
        $('#cpf_busca').mask('000.000.000-00');
        $('#telefone').mask('(00)0000-0000');
        $('#celular').mask('(00)00000-0000');
    });
</script>
<script type="text/javascript" >

    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#logradouro").val("");
            $("#numero").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val("");
            $("#complemento").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {
            $('#mensagem-sucesso').hide();
            $('#mensagem-erro').hide();
            $('#mensagem-procurando').hide();
            $('#erro').empty();



            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {
                    limpa_formulário_cep();
                    //Preenche os campos com "..." enquanto consulta webservice.
                    $('#mensagem-procurando').fadeIn();
                    $("#logradouro").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        $('#mensagem-procurando').hide();
                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#logradouro").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.uf);
                            $('#mensagem-sucesso').fadeIn();
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            $('#erro').append("CEP não encontrado");
                            $('#mensagem-erro').fadeIn();
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    $('#erro').append("CEP é inválido");
                    $('#mensagem-erro').fadeIn();
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

        function limpa_formulário_cep_clinica() {
            // Limpa valores do formulário de cep.
            $("#logradouro_clinica").val("");
            $("#numero_clinica").val("");
            $("#bairro_clinica").val("");
            $("#cidade_clinica").val("");
            $("#estado_clinica").val("");
            $("#complemento_clinica").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep_clinica").blur(function() {
            $('#mensagem-sucesso-clinica').hide();
            $('#mensagem-erro-clinica').hide();
            $('#mensagem-procurando-clinica').hide();
            $('#erro-clinica').empty();



            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {
                    limpa_formulário_cep_clinica();
                    //Preenche os campos com "..." enquanto consulta webservice.
                    $('#mensagem-procurando-clinica').fadeIn();
                    $("#logradouro_clinica").val("...");
                    $("#bairro_clinica").val("...");
                    $("#cidade_clinica").val("...");
                    $("#estado_clinica").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        $('#mensagem-procurando-clinica').hide();
                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#logradouro_clinica").val(dados.logradouro);
                            $("#bairro_clinica").val(dados.bairro);
                            $("#cidade_clinica").val(dados.localidade);
                            $("#estado_clinica").val(dados.uf);
                            $('#mensagem-sucesso-clinica').fadeIn();
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            $('#erro').append("CEP não encontrado");
                            $('#mensagem-erro-clinica').fadeIn();
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep_clinica();
                    $('#erro').append("CEP é inválido");
                    $('#mensagem-erro-clinica').fadeIn();
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep_clinica();
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        setTimeout(function(){$('.text-success').hide(1000);},2500);

    });
</script>