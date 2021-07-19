<?php
if (isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $dataNascimento = $_POST['dataNascimento'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $sexo = strtoupper($_POST['sexo']);
    $endereco = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['uf'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    if (isset($_POST['statusAtualizar'])) {
        $statusAtualizar = 1;
    } else {
        $statusAtualizar = 0;
    }

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');

    $sql = "INSERT INTO pessoa (nome,email,senha,dataNascimento,cpf,rg,sexo,endereco,numero,bairro,complemento,cidade,estado,cep,telefone,celular,status) 
    VALUES ('{$nome}','{$email}','{$senhaCriptografada}','{$dataNascimento}','{$cpf}','{$rg}','{$sexo}','{$endereco}','{$numero}','{$bairro}','{$complemento}','{$cidade}','{$estado}','{$cep}','{$telefone}','{$celular}','{$statusAtualizar}')";
    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    header("Refresh: 0; url = IndexAdm.php");
}
require_once('../../dependencias.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <style>
        @media only screen and (min-width: 991px) {
            main {
                display: flex;
                height: 100vh;
                align-items: center;
            }
        }

        .container {
            border-radius: 2%;
        }
    </style>
    <script>
        function limpa_formulário_cep() {
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {

                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('uf').value = (conteudo.uf);
            } else {

                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            var cep = valor.replace(/\D/g, '');


            if (cep != "") {


                var validacep = /^[0-9]{8}$/;


                if (validacep.test(cep)) {


                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('uf').value = "...";


                    var script = document.createElement('script');

                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';


                    document.body.appendChild(script);

                } else {

                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } else {

                limpa_formulário_cep();
            }
        };
    </script>
</head>

<body style="background-color: #5cb85c;">
    <main>
        <div class="container" style="background-color: burlywood;">
            <h1 style="text-align: center;">Cadastro de Usuário</h1>
            <form class="row g-3" method="POST">
                <div class="col-md-6">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail">
                </div>
                <div class="col-md-6">
                    <label for="inputsenha" class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" id="inputsenha">
                </div>
                <div class="col-md-8">
                    <label for="inputNome" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Nome Completo">
                </div>
                <div class="col-md-4">
                    <label for="inputDataNascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="dataNascimento" class="form-control" id="inputDataNascimento">
                </div>
                <div class="col-md-4">
                    <label for="inputCPF" class="form-label">CPF</label>
                    <input name="cpf" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputRG" class="form-label">RG</label>
                    <input type="text" name="rg" class="form-control" id="inputRG">
                </div>
                <div class="col-md-4">
                    <label for="inputSexo" class="form-label">Sexo</label>
                    <select name="sexo" id="inputSexo" class="form-control ls-select" required>
                        <option value="" disabled="disabled" selected>Escolher...</option>
                        <option value="1">Feminino</option>
                        <option value="2">Masculino</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputCEP" class="form-label">CEP</label>
                    <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" placeholder="digite seu CEP" onblur="pesquisacep(this.value);" class="form-control" >
                </div>
                <div class="col-md-8">
                    <label for="inputEndereco" class="form-label">Endereco</label>
                    <input  name="rua" type="text" id="rua" size="60" class="form-control" placeholder="Rua dos Bobos">
                </div>
                <div class="col-md-2">
                    <label for="inputNumero" class="form-label">Número</label>
                    <input type="text" name="numero" class="form-control" id="inputNumero" placeholder="Número">
                </div>
                <div class="col-md-4">
                    <label for="inputBairro" class="form-label">Bairro</label>
                    <input name="bairro" type="text" id="bairro" size="40" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="inputComplemento" class="form-label">Complemento</label>
                    <input type="text" name="complemento" class="form-control" id="inputComplemento">
                </div>
                <div class="col-md-6">
                    <label for="inputCidade" class="form-label">Cidade</label>
                    <input name="cidade" type="text" id="cidade" size="40"  class="form-control" >
                </div>
                <div class="col-md-6">
                    <label for="inputEstado" class="form-label">Estado</label>
                    <input name="uf" type="text" id="uf" size="2" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputTelefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" class="form-control" id="inputTelefone">
                </div>
                <div class="col-md-4">
                    <label for="inputCelular" class="form-label">Celular</label>
                    <input type="text" name="celular" class="form-control" id="inputCelular">
                </div>
                <div class="form-group col-md-4"><label class="control-label" for="statusAtualizar">Status</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="padding: 1rem; margin-right: 2px;">
                                <input type="checkbox" name="statusAtualizar" value="1" id="statusAtualizar" onclick="teste1(this);" checked>
                            </div>
                        </div>
                        <div class="form-control"><strong class="text-success" id="statuscadastrar">Ativo</strong></div>
                    </div>
                    <span class="help-block"></span>
                </div>
                <div class="col-12">
                    <button type="submit" name="salvar" class="btn btn-success" style=" width: 100%;">Cadastrar</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        function teste1(tag) {
            let labelStatus = document.getElementById('statuscadastrar');
            if (tag.value == '1') {
                tag.value = 0;
                labelStatus.className = "text-danger";
                labelStatus.innerHTML = "Inativo";


            } else {
                tag.value = 1;
                labelStatus.className = "text-success";
                labelStatus.innerHTML = "Ativo";

            }
            console.log(tag.value);
        }
    </script>
</body>

</html>