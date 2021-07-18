<?php
require_once('../../dependencias.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>

<body>
    <main>
        <div class="container">
            <h1 style="text-align: center;">Cadastro de Usuário</h1>
            <form class="row g-3" action="IndexUser.php" method="POST">
                <div class="col-md-6">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail">
                </div>
                <div class="col-md-6">
                    <label for="inputsenha" class="form-label">Senha</label>
                    <input type="senha" class="form-control" id="inputsenha">
                </div>
                <div class="col-8">
                    <label for="inputNome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="inputNome" placeholder="Nome Completo">
                </div>
                <div class="col-md-4">
                    <label for="inputDataNascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="inputDataNascimento">
                </div>
                <div class="col-md-4">
                    <label for="inputCPF" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="inputCPF">
                </div>
                <div class="col-md-4">
                    <label for="inputRG" class="form-label">RG</label>
                    <input type="text" class="form-control" id="inputRG">
                </div>
                <div class="col-md-4">
                    <label for="inputSexo" class="form-label">Sexo</label>
                    <input type="text" class="form-control" id="inputSexo">
                </div>
                <div class="col-12">
                    <label for="inputEndereco" class="form-label">Endereco</label>
                    <input type="text" class="form-control" id="inputEndereco" placeholder="Rua dos Bobos">
                </div>
                <div class="col-2">
                    <label for="inputNumero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="inputNumero" placeholder="Número">
                </div>
                <div class="col-md-4">
                    <label for="inputBairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="inputBairro">
                </div>
                <div class="col-md-6">
                    <label for="inputComplemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="inputComplemento">
                </div>
                <div class="col-md-6">
                    <label for="inputCidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="inputCidade">
                </div>
                <div class="col-md-6">
                    <label for="inputEstado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="inputEstado">
                </div>
                <div class="col-md-3">
                    <label for="inputCEP" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="inputCEP">
                </div>
                <div class="col-md-3">
                    <label for="inputTelefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="inputTelefone">
                </div>
                <div class="col-md-3">
                    <label for="inputCelular" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="inputCelular">
                </div>
                <div class="form-group col-md-3"><label class="control-label" for="status">Status</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="padding: 1rem; margin-right: 2px;">
                                <input type="checkbox" name="status" value="1" id="status" onclick="teste1(this);" checked>
                            </div>
                        </div>
                        <div class="form-control"><strong class="text-success" id="statuscadastrar">Ativo</strong></div>
                    </div>
                    <span class="help-block"></span>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success" style=" width: 100%;">Cadastrar</button>
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