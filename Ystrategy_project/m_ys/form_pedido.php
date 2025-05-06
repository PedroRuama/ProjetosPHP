<?php

include_once('conexao.php');
include('menu.php');

?>



<head>

    <!-- <link rel="stylesheet" href="./css/reset.css"> -->

    <link rel="stylesheet" href="./css/indexm.css">
    <link rel="stylesheet" href="./css/servicos_m.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="./logo/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Mundial Entulhos / Cadastros</title>

</head>


<?php

$user = $_SESSION['usuario'];

$hoje = date('Y-m-d');

$rpc = 2;

$de = date("Y-m-d", strtotime($hoje . "+$rpc days"));





// VISÃO consulta pedido em aberto

$sessin_tabela =  mysqli_query($conexao, "select * from cadastro where USUARIO = '$user' and (sessao = 'PEDIDO' or sessao = 'ADMINISTRADOR')") or die($mysqli_error);

while ($pagina = $sessin_tabela->fetch_assoc()) {

    $row = mysqli_num_rows($sessin_tabela);

    $_SESSION['pagina'] =  $pagina['USUARIO'];
}



?>





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

<div class="Box-Dashbord">
    <div class="Conteudo-Dashbord">
        <?php include('reload.php'); ?>
        <form method="get" action=".">
            <input name="cep" type="hidden" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" />
            <input name="rua" type="hidden" id="rua" size="60" />
            <input name="bairro1" type="hidden" id="bairro1" size="40" />
            <input name="cidade" type="hidden" id="cidade" size="40" />
            <input name="uf1" type="hidden" id="uf1" size="2" />
            <input name="ibge" type="hidden" id="ibge" size="8" />
        </form>


        <h1 class='h1_title'>Incluir Novo Pedidos:</h1>

        <br>




        <div class="quadro-pedidos" id="pedidos_div">

            <br>
            <div class="div_forms digitar-pedido" id="digitar-pedido">

                <form action="cadastrar_pedido.php" method="post">
                    <h2>Incluir Novo Pedido</h2>

                    &nbsp;&nbsp;&nbsp;
                    <div class="forms__">
                        <div class="inputGroup">
                            <p class="label_select">Nome</p>
                            <select id="nome_cliente_pedido" name="nome_cliente_pedido" class="select2" required>
                                <option value=""></option>
                                <?php

                                while ($c_cliente = $sql_cadastro_cliente->fetch_assoc()) { ?>
                                    <option value='<?php echo $c_cliente['nome_cliente']; ?>'>
                                        <?php echo $c_cliente['nome_cliente']; ?></option>

                                <?php } ?>

                            </select>
                        </div>
                        <input size="10" minlength="1" maxlength="11" type="hidden" name="id_cliente" id="id_cliente" value="" placeholder="">
                        <input size="10" minlength="1" maxlength="11" type="hidden" name="codigo_cliente_pedido" id="codigo_cliente_pedido" value="" placeholder="">
                        <input size="45" minlength="2" onkeyup="maiuscula(this)" maxlength="45" type="hidden" name="nome_cliente_pedido2" value="" placeholder="">


                        <div class="inputGroup big_inpGroup">
                            <input size="10" minlength="11" maxlength="11" type="numero" disabled="disabled" name="telefone_cliente_pedido" id="telefone_cliente_pedido" value="" placeholder="Telefone">
                            <label for="" class="big_label">Telefone contato</label>
                        </div>

                        <div class="inputGroup big_inpGroup">
                            <input size="14" autocomplete="on" type="varchar" onblur="pesquisacep(this.value);" name="cep" id="ceps" value="" required />
                            <label>Cep</label>
                        </div>

                        <div class="inputGroup">
                            <input size="30" minlength="16" maxlength="45" type="varchar" name="endereco" id="endereco" value="" required>
                            <label>Endereço</label>
                        </div>
                        <div class="inputGroup">
                            <input size="4" type="int" name="Numero" id="Numero" value="" required>
                            <label>Numero</label>
                        </div>
                        <div class="inputGroup">
                            <input size="10" minlength="0" maxlength="14" type="varchar" name="complemento" id="complemento" value="" required>
                            <label>Complemento</label>
                        </div>
                        <div class="inputGroup">
                            <input name="bairro" type="text" id="bairro" size="20" minlength="0" maxlength="25" required />
                            <label>Bairro</label>
                        </div>
                        <div class="inputGroup">
                            <input minlength="0" maxlength="25" type="varchar" name="municipio" id="municipio" required />
                            <label>Municipio</label>
                        </div>
                        <div class="inputGroup">
                            <input minlength="2" maxlength="2" size="1" type="varchar" name="uf" id="uf" value="" required>
                            <label>UF</label>
                        </div>

                        <div class="inputGroup">
                            <p class="label_select">Qtde. Caçambas</p>
                            <input minlength="5" maxlength="2" size="3" type="varchar" name="qc" id="qc" value="1" placeholder="" required>

                        </div>
                        <div class="inputGroup">
                            <p class="label_select">Tipo Caçamba</p>
                            <select id="motorista" name="tipo_c" required>
                                <option value=""></option>
                                <option value='MUNDIAL'>MUNDIAL</option>
                                <option value='FORMIGA'>FORMIGA</option>
                            </select>
                        </div>

                        <div class="inputGroup">
                            <input size="5" minlength="0" maxlength="45" type="varchar" disabled="disabled" name="for_pag" id="for_pag" value="" placeholder="" required>
                            <label>F.Pagamento</label>
                        </div>
                        <div class="inputGroup">
                            <input size="3" minlength="0" maxlength="45" type="varchar" name="valor" id="valor" value="" placeholder="" required>
                            <label>VALOR</label>
                        </div>

                        <div class="inputGroup">
                            <input size="15" minlength="0" maxlength="45" type="date" name="d_entrega" id="d_entrega" value="<?php echo $de ?>" required>
                            <label for="">Entrega</label>
                        </div>

                        <div class="inputGroup">
                            <p class="label_select">Motorista</p>
                            <select id="motorista" name="motorista" required>
                                <option value=""></option>
                                <?php

                                while ($b_motorista = $sql_c_motorista->fetch_assoc()) { ?>

                                    <option value='<?php echo $b_motorista['nome_motorista']; ?>'>

                                        <?php echo $b_motorista['nome_motorista']; ?></option>

                                <?php } ?>

                            </select>
                        </div>
                        <div class="inputGroup">
                            <p class="label_select">Período</p>
                            <select id="periodo" name="periodo" required>
                                <option value=""></option>
                                <option value="DIURNO">DIURNO</option>
                                <option value="NOTURNO">NOTURNO</option>

                            </select>
                        </div>

                        <div class="inputGroup">
                            <p class="label_select">Tipo serviço</p>
                            <select id="tipo_se" name="tipo_se" required>
                                <option value=""></option>
                                <option value="MUNDIAL">MUNDIAL</option>
                                <option value="FORMIGA">FORMIGA</option>
                                <option value="AMBOS">AMBOS</option>


                            </select>
                        </div>
                        <div class="inputGroup">

                            <input size="20" minlength="1" maxlength="100" type="varchar" name="comentario" id="comentario" value="" required>
                            <label>Comentarios</label>

                        </div>

                        <button input type="submit" name="acao" class="btn">Salvar</button>
                    </div>


                </form>
            </div>

        </div>


        <br><br>







        <div class="tabela-base">



            <table class="table-wrapper">

                <thead>



                    <tr>

                        <th>Pedido</th>

                        <th>Serviço</th>

                        <th>Cliente</th>

                        <th>Motorista</th>

                        <th>Período</th>

                        <th>Endereço</th>

                        <th>Bairro</th>

                        <th>Valor</th>

                        <th>Data Entrega</th>

                        <th>Data de Retirada</th>

                        <th>Telefone</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($ped = $filtro_banco_dados->fetch_assoc()) { ?>

                        <tr>
                            <td><a><?php echo $ped['num_pedido']; ?></a></td>
                            <td><a><?php echo $ped['tipo_os']; ?></a></td>
                            <td><a><?php echo $ped['nome_cliente']; ?></a></td>
                            <td><a><?php echo $ped['Motorista_entrega']; ?></a></td>
                            <td><a><?php echo $ped['periodo']; ?></a></td>
                            <td><a><?php echo $ped['Endereco']; ?></a></td>
                            <td><a><?php echo $ped['bairro']; ?></a></td>
                            <td><a><?php echo $ped['valor']; ?></a></td>
                            <td><a><?php echo date('d/m/Y', strtotime($ped['data_entrega'])) ?></a></td>
                            <td><a><?php echo date('d/m/Y', strtotime($ped['data_retirada'])) ?></a>&nbsp;</td>
                            <td><a><?php echo $ped['telefone']; ?></a>&nbsp;</td>

                        </tr>

                    <?php }
                    if (isset($_POST['d_ret'])) {
                        $d_ret1 = date("Y-m-d", $_POST['d_ret']);
                    }
                    ?>
                </tbody>

            </table>
            <?php include('rodape.php'); ?>

        </div>

    </div>
</div>

<script src="./js/mudar.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="./js/tentando.js"></script>

<script>
    $(document).ready(function() {

        $('.select2').select2();

    });
</script>

<script type='text/javascript'>
    $(document).ready(function() {

        $("select[name='nome_cliente_pedido']").change(function() {

            var $telefone_cliente_pedido = $("input[name='telefone_cliente_pedido']");

            var $codigo_cliente_pedido = $("input[name='codigo_cliente_pedido']");

            var $id_cliente = $("input[name='id_cliente']");

            var $credito_cliente = $("input[name='for_pag']");

            var $tipo_valor = $("input[name='valor']");





            $.getJSON('function2.php', {

                matricula: $(this).val()

            }, function(json) {

                $telefone_cliente_pedido.val(json.telefone_cliente_pedido);

                $codigo_cliente_pedido.val(json.codigo_cliente_pedido);

                $id_cliente.val(json.id_cliente);

                $credito_cliente.val(json.for_pag);

                $tipo_valor.val(json.tipo_valor);





            });

        });

        let acesso = "<?php echo $_SESSION['ACESSO']; ?>"; // Obtém o valor da sessão
        let select = document.getElementById("tipo_se");

        if (acesso != "ADMIN" && acesso != "USER") {
            // Percorre todas as opções e remove as que não são iguais ao valor da sessão
            Array.from(select.options).forEach(option => {
                if (option.value !== "" && option.value !== acesso) {
                    option.remove(); // Remove a opção que não é permitida
                }
            });

            // Se apenas um valor estiver disponível, já o seleciona
            if (select.options.length === 2) {
                select.selectedIndex = 1;
            }
        }

    });
</script>