<?php
include('menu.php');
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />



<?php

$user = $_SESSION['usuario'];

// VISÃO consulta pedido em aberto

$sessin_tabela =  mysqli_query($conexao, "select * from cadastro where USUARIO = '$user' and (sessao = 'CLIENTES' or sessao = 'ADMINISTRADOR')") or die($mysqli_error);

while ($pagina = $sessin_tabela->fetch_assoc()) {

    $row = mysqli_num_rows($sessin_tabela);

    $_SESSION['pagina'] =  $pagina['USUARIO'];
}

?>





<div class="Box-Dashbord">
    <div class="Conteudo-Dashbord">

        <body>





        </body>



        <div class="container">



            <div class="ativo onn">

                <div class="form">

                    <h1>Cadastro de Clientes</h1>



                    <br>

                    <form action="cadastrar_cliente.php" method="post">

                        <label>Codigo</label>

                        <input size="10" minlength="1" disabled='disabled' maxlength="11" autocomplete="" type="numero"

                            name="codigo_cliente1" id="cod_cli" value="" placeholder="">

                        <input size="10" minlength="1" maxlength="11" autocomplete="" type="hidden" name="codigo_cliente"

                            id="cod_cli" value="" placeholder="">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <br><br>

                        <label for="nome_cliente" class="form-label">Nome</label>

                        <select size="45" id="nome_cliente" name="nome_cliente" class="select2">

                            <option value=""></option>

                            <?php



                            while ($c_cliente = $sql_cadastro_cliente->fetch_assoc()) { ?>

                                <option value='<?php echo $c_cliente['nome_cliente']; ?>'>

                                    <?php echo $c_cliente['nome_cliente']; ?></option>

                            <?php } ?>

                        </select>

                        <button class="btn btn-success" type="button" id="button-addon2"

                            style="background: lime;    border-radius: 15px;" data-bs-toggle="modal"

                            data-bs-target="#cadastrocliente"> &nbsp;&nbsp;+&nbsp;&nbsp; </button>





                        <label>Senha</label>

                        <input minlength="6" maxlength="12" type="password" name="senha_cliente" autocomplete=""

                            id="senha_cliente" value="" placeholder="Senha" required><br><br>

                        <label>Email</label>

                        <input size="100" minlength="1" type="email" name="email_cliente" id="email_cli" value=""

                            placeholder="email" required><br><br>

                        <label>Rg/Inscrição Estadual</label>

                        <input minlength="6" maxlength="14" type="rg" name="rg_cliente" id="rg2" value="" placeholder="Rg" required>

                        &nbsp;&nbsp;&nbsp;

                        <label>Cpf/Cnpj</label>

                        <input size="14" maxlength="24" type="int" name="cpf_cliente" id="cpf2" value="" placeholder="Cpf" required>

                        &nbsp;&nbsp;&nbsp;

                        <label>Telefone de contato</label>

                        <input size="10" minlength="11" maxlength="11" type="numero" name="telefone_cliente" id="telefone"

                            value="" placeholder="Telefone" required>

                        <br><br>

                        <label for="for_pag">Forma de Pagamento:</label>

                        <select id="for_pag" name="for_pag" required>

                            <option value=""></option>

                            <option value="avista">A vista</option>

                            <option value="BOLETO">Boleto</option>

                            <option value="Faturado">Faturado</option>

                            <option value="Antecipado">Antecipado</option>

                            <option value="Pix">Pix à vista</option>

                            <option value="TRANSFERÊNCIA">Transferencia à vista</option>

                        </select>





                        &nbsp;&nbsp;&nbsp;

                        <label for="tipo_val">Base valor:</label>

                        <select id="tipo_val" name="tipo_val" required>

                            <option value=""></option>

                            <?php

                            while ($b_valor = $sql_b_valor->fetch_assoc()) { ?>

                                <option value='<?php echo $b_valor['Tipo_valor']; ?>'>

                                    <?php echo $b_valor['Tipo_valor']; ?></option>

                            <?php } ?>

                        </select>

                        &nbsp;&nbsp;&nbsp;

                        <label>Prazo</label>

                        <input size="2" maxlength="2" type="Prazo_cred" name="Prazo_cred" id="Prazo_cred_1" value=""

                            placeholder="Prazo" required>

                        &nbsp;&nbsp;&nbsp;

                        <label>Desconto %</label>

                        <input size="2" maxlength="2" type="desconto" name="desconto" id="desconto" value=""

                            placeholder="Desc"><br><br>



                        <label>Prazo Emissão Nota/Recibo</label>

                        <input size="10" maxlength="10" type="varchar" name="Prazo_Nota" id="Prazo_Nota"" placeholder="" required>

                &nbsp;&nbsp;&nbsp;

                <label>Comentarios</label>

                <input size=" 45" minlength="3"  type="varchar" name="com" id="com" value=""

                            placeholder="Observações Importante" required><br><br>



                        <label for="tipo_nota">Tipo Nota:</label>

                        <select id="tipo_nota" name="tipo_nota" required>

                            <option value=""></option>

                            <option name="com" value="RECIBO">RECIBO</option>

                            <option value="NF">NF</option>

                        </select>

                        &nbsp;&nbsp;&nbsp;

                        <label>Administrador</label>

                        <input size=" 45" minlength="3" maxlength="45" type="varchar" name="adminis" id="adminis" value=""

                            placeholder=""><br><br>



                        <input size="10" name="cadastro_cliente" id="cadastro2" type='hidden'

                            value='<?php echo date("Y-m-d"); ?>' placeholder="cadastro"><br><br>

                        <button input type="submit" name="acao">Salvar</button>

                        <button a href="logout.php"></a>sair</button>

                    </form>









                </div>

                <?php

                include('form.php');

                ?>

            </div>

        </div>



        <div class="modal fade" id="cadastrocliente" name="cadastrocliente" tabindex="-1" aria-labelledby="cadastroclienteLabel"

            aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="cadastroclienteLabel">Incluir Novo Cliente</h1>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body">

                        <form class="row g-3" id="form_nomecliente" method="POST">

                            <div class="col-12">

                                <label for="nomecliente" class="form-label">Nome do Cliente</label>

                                <input type="text" name="nomecliente" onkeyup="maiuscula(this)" class="form-control"

                                    id="nomecliente" placeholder="" value="">

                            </div>

                            <div class="col-12">

                                <input type="submit" id="inclui_nome_btn" class="btn btn-success" value="Incluir">

                            </div>

                        </form>



                    </div>



                </div>

            </div>

        </div>

    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- <script src="./js/tentando.js"></script> -->

<script>
    $(document).ready(function() {

        $('.select2').select2();

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"

    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">

</script>

<script src="./js/custom.js"></script>

<script type='text/javascript'>
    $(document).ready(function() {

        $("select[name='nome_cliente']").change(function() {

            var $nome_cliente_pedido1 = $("input[name='codigo_cliente1']");

            var $nome_cliente_pedido = $("input[name='codigo_cliente']");

            var $senha_cliente_pedido = $("input[name='senha_cliente']");

            var $email_cliente = $("input[name='email_cliente']");

            var $rg_cliente = $("input[name='rg_cliente']");

            var $cpf_cliente = $("input[name='cpf_cliente']");

            var $telefone_cliente = $("input[name='telefone_cliente']");

            var $credito_cliente = $("select[name='for_pag']");

            var $tipo_val = $("select[name='tipo_val']");

            var $Prazo_cred = $("input[name='Prazo_cred']");

            var $desconto = $("input[name='desconto']");

            var $Prazo_Nota = $("input[name='Prazo_Nota']");

            var $com = $("input[name='com']");

            var $tipo_nota = $("select[name='tipo_nota']");

            var $administrador = $("input[name='adminis']");

            var $id_cliente = $("input[name='id_cliente']");



            $.getJSON('fun_cad_cli.php', {

                matricula: $(this).val()

            }, function(json) {

                $nome_cliente_pedido.val(json.codigo_cliente);

                $senha_cliente_pedido.val(json.senha_cliente);

                $email_cliente.val(json.email_cliente);

                $rg_cliente.val(json.rg_cliente);

                $cpf_cliente.val(json.cpf_cliente);

                $telefone_cliente.val(json.telefone_cliente);

                $credito_cliente.val(json.credito_cliente);

                $tipo_val.val(json.tipo_val);

                $Prazo_cred.val(json.Prazo_cred);

                $desconto.val(json.desconto);

                $Prazo_Nota.val(json.Prazo_Nota);

                $com.val(json.com);

                $tipo_nota.val(json.tipo_nota);

                $administrador.val(json.adminis);

                $id_cliente.val(json.id_cliente);

                $nome_cliente_pedido1.val(json.codigo_cliente);





            });

        });

    });
</script>


<?php

?>