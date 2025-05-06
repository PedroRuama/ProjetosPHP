<?php

include('menu.php');



?>

<?php

$user = $_SESSION['usuario'];

// VISÃO consulta pedido em aberto

$sessin_tabela =  mysqli_query($conexao, "select * from cadastro where USUARIO = '$user' and (sessao = 'ATERRO' or sessao = 'ADMINISTRADOR')") or die($mysqli_error);

while ($pagina = $sessin_tabela->fetch_assoc()) {

    $row = mysqli_num_rows($sessin_tabela);

    $_SESSION['pagina'] =  $pagina['USUARIO'];
}

?>





<?php

$data_comissao =  mysqli_query($conexao, "select * from consulta where tabela = 'aterro';") or die($mysqli_error);

while ($d_c_ = $data_comissao->fetch_assoc()) {

    $d_c_i =  $d_c_['entrega'];
}

?>




<head>

    <!-- <link rel="stylesheet" href="./css/reset.css"> -->

    <link rel="stylesheet" href="./css/indexm.css">


</head>





<div class="Box-Dashbord">
    <div class="Conteudo-Dashbord">


        <body>
            <div class="quadro-pedidos">
                <div class="digitar-aterro div_forms" id="div-01">

                    <form action="cadastrar_aterro.php" method="post">
                        <h2>Cadastro Aterro</h2>

                        <br>
                        <div class="forms__">
                            <div class="inputGroup">
                                <input size="10" minlength="1" maxlength="9" type="numero" name="codigo_aterro" id="numero">
                                <label for="">Código atero</label>
                            </div>

                            <div class="inputGroup">
                                <input size="60" minlength="1" onkeyup="maiuscula(this)" maxlength="45" type="name" name="nome_aterro"

                                    id="nome2" value="">


                                <label for="">Nome</label>
                            </div>

                            <div class="inputGroup">
                                <input size="47" minlength="1" onkeyup="maiuscula(this)" maxlength="45" type="endereco"
                                    name="endereco_aterro" id="endereco" value="">
                                <label for="">Endereço</label>
                            </div>

                            <div class="inputGroup">
                                <input minlength="0" maxlength="14" type="int" name="Numero_aterro" id="Numero">
                                <label for="">Numero</label>
                            </div>

                            <div class="inputGroup">
                                <input size="14" maxlength="25" type="int" name="cep_aterro" id="cep">
                                <label for="">Cep</label>
                            </div>

                            <div class="inputGroup">

                                <input minlength="0" maxlength="25" size="22" onkeyup="maiuscula(this)" type="varchar" name="bairro_aterro"
                                    id="bairro">
                                <label for="">Bairro</label>
                            </div>

                            <div class="inputGroup">

                                <input minlength="0" maxlength="25" onkeyup="maiuscula(this)" type="varchar" name="municipio_aterro"

                                    id="municipio" value="">
                                <label for="">Municipio</label>
                            </div>


                            <div class="inputGroup">

                                <input minlength="0" maxlength="14" onkeyup="maiuscula(this)" type="varchar" name="complemento_aterro"

                                    id="complemento" value="">


                                <label for="">Complemento</label>
                            </div>

                            <div class="inputGroup">

                                <input size="6" type="decimal" name="valor_aterro" id="valor_aterro" value="">


                                <label for="">Comissão</label>
                            </div>
                        </div>


                        <br>
                        <button input type="submit" name="acao" class="btn">Salvar</button>
                        <br>


                    </form>



                </div>
            </div>
            <br>
            <br>
            <div class="formulario_pesquisa_aterro_" id="div-01_">



                <?php

                include('./datas/cal_at.php');

                ?>

                <br>





                <table BORDER="1" cellpadding="15">





                    <thead>

                        <tr>

                            <th>Aterro</th>

                            <!-- <th>Valor</th> -->

                            <th>Qntd</th>

                            <th>Valor Total</th>

                            <!-- <th>❌</th> -->



                        </tr>

                    </thead>



                    <tbody>

                        <?php while ($arquivos = $consulta_aterro__->fetch_assoc()) { ?>



                            <tr>



                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['aterro']; ?>&nbsp;&nbsp;&nbsp;</a></td>

                                <!-- <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['valor']; ?>&nbsp;&nbsp;&nbsp;</a></td> -->

                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['qntd']; ?>&nbsp;&nbsp;&nbsp;</a></td>

                                <td><a>R$&nbsp;&nbsp;<?php echo $arquivos['Valor_total']; ?>&nbsp;&nbsp;&nbsp;</a></td>



                                <!-- <th><a href="?update2=<?PHP echo $arquivos['id'] ?>">🚫</a></th> -->



                            </tr>



                        <?php } ?>





                    </tbody>

                </table>

            </div>







        </body>

        <body>

            <div class="table-wrapper-motorista">

                <table BORDER="1" cellpadding="15">





                    <thead>



                        <tr>

                            <th>&nbsp;Nome&nbsp;</th>

                            <th>&nbsp;Endereço&nbsp;</th>

                            <th>&nbsp;Bairro&nbsp;</th>

                            <th>&nbsp;Cidade&nbsp;</th>



                            <th>&nbsp;❌&nbsp;</th>



                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($consulta_aterro = $aterros_f->fetch_assoc()) { ?>



                            <tr>



                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_aterro['Nome_aterro']; ?>&nbsp;&nbsp;&nbsp;</a>

                                </td>

                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_aterro['End_aterro']; ?>&nbsp;&nbsp;&nbsp;</a>

                                </td>

                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_aterro['Bairro_aterro']; ?>&nbsp;&nbsp;&nbsp;</a>

                                </td>

                                <td><a>&nbsp;&nbsp;&nbsp;<?php echo $consulta_aterro['Cidade_aterro']; ?>&nbsp;&nbsp;&nbsp;</a>

                                </td>



                                <th><a href="?update4=<?PHP echo $consulta_aterro['id'] ?>">&nbsp;🚫&nbsp;</a></th>



                            </tr>



                        <?php } ?>





                    </tbody>

                </table>

            </div>

        </body>

    </div>
</div>



<script src="./js/mudar.js"></script>
<?php


?>