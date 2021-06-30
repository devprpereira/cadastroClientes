<!DOCTYPE html>
<?php
session_status() !== 2 ? session_start() : null;

// Se tiver mensagem de erro, mostra ao abrir e limpa a sessão
if (isset($_SESSION['status']) && !empty($_SESSION['status']) && $_SESSION['status'] == "FALHA") {
    echo '<div class="sessaoErro">';
    if (count($_SESSION['mensagem']) > 1){
        echo '<h3> Foram encontradas ' . count($_SESSION['mensagem']) . ' inconsistências no formulário!</h3><br/>';    
    } else {
        echo '<h3> Foi encontrada 1 inconsistência no formulário!</h3><br/>';
    }
    foreach ((array) $_SESSION['mensagem'] as $chave => $valor) {
        echo "<div> Campo <span class='erro'>" . $valor . "</span> deve ser preenchido com dados válidos! </div>";
    }
    echo '</div>';
    echo '</br>';
    //Limpa os dados de sessão depois de mostrar pra deixar essa área limpa
    unset($_SESSION['status']);
    unset($_SESSION['area']);
    unset($_SESSION['mensagem']);
}
$edit = false;
if (isset($_GET['edit']) && !empty($_GET['edit'])){
    $edit = true;
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Adicionando plugin para mascarar os inputs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <style>
        * {
            margin: 0 auto;
            padding: 0;
        }
        .sessaoErro {
            background-color: red;
            color: white;
            border: 1.5px solid black;
            border-radius: 5px;
            padding: 2.5px;
        }

        .erro {
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <form action="client.php" method="POST">
        <!-- Se tiver edit é porque está editando, então adiciona esse parâmetro -->
        <?php if ($edit) {echo '<input type="hidden" value="'. intval($_GET['edit']) . '" name="edit">';} ?>
        
        <label for="name"> Nome:
            <input name="name" type="text" id="name" value="" size="30" maxlength="30" required />
        </label><br />
        <label for="dtNascimento"> Data Nascimento:
            <input name="dtNascimento" type="date" id="dtNascimento" placeholder="99/99/9999" max="8" required />
        </label><br />

        <span>Sexo:</span>
        <input name="sexo" type="radio" id="sexo" value="M" size="1" required checked /><label for="sexo" checked>Masculino</label>
        <input name="sexo" type="radio" id="sexo" value="F" size="1" required /><label for="sexo">Feminino</label>
        </label><br />
        <label>Cep:
            <input name="cep" type="text" id="cep" size="10" maxlength="9" placeholder="99.999-999" value="" />
            <label>Cidade:
                <input name="cidade" type="text" id="cidade" size="40" readonly required /></label><br />
            <label>Estado:
                <input name="uf" type="text" id="uf" size="2" readonly required /></label><br />
            <label>Bairro:
                <input name="bairro" type="text" id="bairro" size="40" required /></label><br />
        </label><br />
        <label>Endereço:
            <input name="endereco" type="text" id="endereco" size="60" required /></label><br />
        <label>Número:
            <input name="numero" type="text" id="numero" size="10" required /></label><br />
        <label>Complemento:
            <input name="complemento" type="text" id="complemento" size="20" required /></label><br />
        <?php ?>
        <input type="submit" value="Salvar">
    </form>
</body>

<script>
    $(document).ready(function() {

        $("#cep").mask("99.999-999");


        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#endereco").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#endereco").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });
</script>

</html>