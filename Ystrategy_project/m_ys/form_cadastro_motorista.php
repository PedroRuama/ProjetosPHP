<?php

include('menu.php');
?>

<?php

$user = $_SESSION['usuario'];

// VISÃO consulta pedido em aberto

$sessin_tabela =  mysqli_query($conexao, "select * from cadastro where USUARIO = '$user' and (sessao = 'MOTORISTA' or sessao = 'ADMINISTRADOR')") or die($mysqli_error);

while ($pagina = $sessin_tabela->fetch_assoc()) {

    $row = mysqli_num_rows($sessin_tabela);

    $_SESSION['pagina'] =  $pagina['USUARIO'];
}

?>





<?php

$data_comissao =  mysqli_query($conexao, "select * from consulta where tabela = 'motorista';") or die($mysqli_error);

while ($d_c_ = $data_comissao->fetch_assoc()) {

    $d_c_i =  $d_c_['entrega'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <link rel="stylesheet" href="css/indexm.css">
    <link rel="stylesheet" href="css/servicos_m.css">
</head>

<body>
    <div class="Box-Dashbord">
        <div class="Conteudo-Dashbord">

            <div class="geral_motorista">


                <div class="digitar-motorista">



                    <h1 class="h1_title">Cadastro de Motorista:</h1>

                    <br>

                    <div class="">



                        <?php

                        include('./datas/cal_mot.php');

                        ?>

                        <br>



                        <body>

                            <div class="">

                                <table class="table-wrapper">

                                    <?php

                                    ?>



                                    <thead>



                                        <tr>

                                            <th>&nbsp;Motorista&nbsp;</th>
                                            <th class="th_financeiro">&nbsp;Diurno&nbsp;</th>
                                            <th class="th_financeiro">&nbsp;Noturno&nbsp;</th>
                                            <th class="th_financeiro">&nbsp;Sem info&nbsp;</th>
                                            <th>&nbsp;Total&nbsp;</th>





                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php while ($cmm = $consulta_motorista->fetch_assoc()) { ?>



                                            <tr>

                                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $cmm['motorista']; ?>&nbsp;&nbsp;&nbsp;</a></td>

                                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $cmm['diurno']; ?>&nbsp;&nbsp;&nbsp;</a></td>
                                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $cmm['noturno']; ?>&nbsp;&nbsp;&nbsp;</a></td>
                                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $cmm['vazio']; ?>&nbsp;&nbsp;&nbsp;</a></td>
                                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $cmm['qtde']; ?>&nbsp;&nbsp;&nbsp;</a></td>



                                            </tr>



                                        <?php } ?>





                                    </tbody>

                                </table>

                            </div>

                        </body>

                        <br>

                    </div>

                    <script>
                        function limpa_formulário_cep() {

                            //Limpa valores do formulário de cep.

                            document.getElementById('endereco').value = ("");

                            document.getElementById('bairro').value = ("");

                            document.getElementById('municipio').value = ("");

                            document.getElementById('uf').value = ("");

                            document.getElementById('ibge').value = ("");

                        }



                        function meu_callback(conteudo) {

                            if (!("erro" in conteudo)) {

                                //Atualiza os campos com os valores.

                                document.getElementById('endereco').value = (conteudo.logradouro);

                                document.getElementById('bairro').value = (conteudo.bairro);

                                document.getElementById('municipio').value = (conteudo.localidade);

                                document.getElementById('uf').value = (conteudo.uf);

                                document.getElementById('ibge').value = (conteudo.ibge);

                            } //end if.
                            else {

                                //CEP não Encontrado.

                                limpa_formulário_cep();

                                alert("CEP não encontrado.");

                            }

                        }



                        function pesquisacep(valor) {



                            //Nova variável "cep" somente com dígitos.

                            var cep = valor.replace(/\D/g, '');



                            //Verifica se campo cep possui valor informado.

                            if (cep != "") {



                                //Expressão regular para validar o CEP.

                                var validacep = /^[0-9]{8}$/;



                                //Valida o formato do CEP.

                                if (validacep.test(cep)) {



                                    //Preenche os campos com "..." enquanto consulta webservice.

                                    document.getElementById('endereco').value = "...";

                                    document.getElementById('bairro').value = "...";

                                    document.getElementById('cidade').value = "...";

                                    document.getElementById('uf').value = "...";

                                    document.getElementById('ibge').value = "...";



                                    //Cria um elemento javascript.

                                    var script = document.createElement('script');



                                    //Sincroniza com o callback.

                                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';



                                    //Insere script no documento e carrega o conteúdo.

                                    document.body.appendChild(script);



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

                        };
                    </script>

                    </head>



                    <form method="get" action=".">

                        <input name="cep" type="hidden" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" />

                        <input name="rua" type="hidden" id="rua" size="60" />

                        <input name="bairro1" type="hidden" id="bairro1" size="40" />

                        <input name="cidade" type="hidden" id="cidade" size="40" />

                        <input name="uf1" type="hidden" id="uf1" size="2" />

                        <input name="ibge" type="hidden" id="ibge" size="8" />

                    </form>

                    <br>
                    <div class="div_forms">
                        <form action="cadastrar_motorista.php" method="post">
                            <h2>Motoristas Cadastrados:</h2>
                            <br>
                            <div class="forms__">
                                <div class="inputGroup">
                                    <input size="35" minlength="1" onkeyup="maiuscula(this)" maxlength="45" type="name" name="nome_m" id="nome2"
                                        value="" required>
                                    <label for="">Nome</label>
                                </div>
                                <div class="inputGroup">

                                    <input minlength="0" maxlength="8" size="12" type="password" name="mot_senha" id="mot_senha" value="" required>
                                    <label for="">Senha</label>
                                </div>
                                <div class="inputGroup">
                                    <input size="35" minlength="1" onkeyup="maiuscula(this)" maxlength="45" type="endereco" name="endereco"
                                        id="endereco" value="" required>
                                    <label for="">Endereço</label>
                                </div>
                                <div class="inputGroup">

                                    <input size="13" minlength="0" maxlength="14" type="int" name="Numero" id="Numero" value=""
                                        required>
                                    <label for="">Numero</label>
                                </div>
                                <div class="inputGroup">
                                    <input minlength="0" maxlength="14" size="14" onkeyup="maiuscula(this)" type="varchar" name="complemento"

                                        id="complemento" value="" required>
                                    <label for="">Complento</label>
                                </div>
                                <div class="inputGroup">
                                    <input minlength="0" maxlength="25" onkeyup="maiuscula(this)" type="varchar" name="bairro" id="bairro"
                                        value="" required>
                                    <label for="">Bairro</label>
                                </div>
                                <div class="inputGroup">

                                    <input minlength="0" maxlength="25" onkeyup="maiuscula(this)" type="varchar" name="municipio" id="municipio"
                                        value="" required>
                                    <label for="">Municipio</label>
                                </div>
                                <div class="inputGroup">

                                    <input minlength="2" size="10" maxlength="2" type="varchar" onkeyup="maiuscula(this)" name="uf" id="uf" value=""

                                        required>
                                    <label for="">UF</label>
                                </div>
                                <div class="inputGroup">
                                    <input size="14" type="varchar" onblur="pesquisacep(this.value);" name="cep" id="ceps" value="" required /><br><br>
                                    <label for="">Cep</label>
                                </div>

                                <div class="inputGroup">

                                    <input size="14" maxlength="11" type="int" name="cpf" id="cpf2" value="" required>
                                    <label for="">CPF</label>
                                </div>
                                <div class="inputGroup">
                                    <input size="14" maxlength="25" type="int" name="rg" id="rg" value="" required>
                                    <label for="">Rg</label>
                                </div>
                                <div class="inputGroup">
                                    <input size="14" maxlength="11" type="int" name="cnh" id="cnh" value="" required>
                                    <label for="">CNH</label>
                                </div>
                                <div class="inputGroup">
                                    <input type="date" name="vencimento" id="vencimento" value='<?php echo date("Y-m-d"); ?>' required>
                                    <label for="">Vencimemto</label>
                                </div>
                                <div class="inputGroup">
                                    <input size="10" minlength="11" maxlength="11" type="numero" name="telefone_m" id="telefone" value=""

                                        required>
                                    <label for="">Telefone</label>
                                </div>
                                <div class="inputGroup">
                                    <input type="date" name="nascimento" id="nascimento2" value='<?php echo date("Y-m-d"); ?>' required>
                                    <label for="">Nascimento</label>
                                </div>
                                <div class="inputGroup">
                                    <input size="10" name="cadastro" id="cadastro2" type='date' value='<?php echo date("Y-m-d"); ?>' required>
                                    <label for="">Cadastro</label>
                                </div>


                                <button input type="submit" name="acao" class="btn">Salvar</button>

                        </form>
                    </div>

                </div>
                <br><br>



            </div>







            <body>

                <div class="tabela-base">


                    <table class="table-wrapper">





                        <thead>



                            <tr>

                                <th>&nbsp;Motorista&nbsp;</th>

                                <th>&nbsp;Endereço&nbsp;</th>

                                <th>&nbsp;Bairro&nbsp;</th>

                                <th>&nbsp;Cidade&nbsp;</th>

                                <th>&nbsp;CPF&nbsp;</th>

                                <th>&nbsp;RG&nbsp;</th>

                                <th>&nbsp;CNH&nbsp;</th>

                                <th>&nbsp;Vencimento&nbsp;</th>

                                <th>&nbsp;Data Nascimento&nbsp;</th>

                                <th>&nbsp;❌&nbsp;</th>



                            </tr>

                        </thead>

                        <tbody>

                            <?php while ($consulta_motorista = $sql_c_motorista_g->fetch_assoc()) { ?>



                                <tr>



                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_motorista['nome_motorista']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_motorista['end_motorista']; ?>-<?php echo $consulta_motorista['num_end_motorista']; ?>-<?php echo $consulta_motorista['complemento']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_motorista['bairro_motorista']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_motorista['Municipio_motorista']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_motorista['Cpf_motorista']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_motorista['Rg_motorista']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_motorista['cnh']; ?>&nbsp;&nbsp;&nbsp;</a></td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_motorista['vencimento_cnh']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_motorista['nascimento']; ?>&nbsp;&nbsp;&nbsp;</a></td>

                                    <th><a href="?update2=<?PHP echo $consulta_motorista['id_motorista'] ?>">&nbsp;🚫&nbsp;</a></th>



                                </tr>



                            <?php } ?>





                        </tbody>

                    </table>

                </div>

            </body>


        </div>

    </div>
    </div>
</body>

</html>


<script src="./js/mudar.js">

</script>

<script type='text/javascript'></script>

<script src="./js/mudar.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="./js/tentando.js"></script>


<?php


?>