<?php

include('menu.php');
$hoje = date('Y,m,d');

?>

<?php

$user = $_SESSION['usuario'];

// VISÃO consulta pedido em aberto

$sessin_tabela =  mysqli_query($conexao, "select * from cadastro where USUARIO = '$user' and (sessao = 'CAÇAMBA' or sessao = 'ADMINISTRADOR')") or die($mysqli_error);

while ($pagina = $sessin_tabela->fetch_assoc()) {

    $row = mysqli_num_rows($sessin_tabela);

    $_SESSION['pagina'] =  $pagina['USUARIO'];
}

?>





<div class="Box-Dashbord">
    <div class="Conteudo-Dashbord">



        <div class="digitar-cacamba">



            <h1>Cadastro de Caçambas</h1>

            <br>

            <form action="cadastrar_cacamba.php" method="post">

                <label>Numero</label>

                &nbsp;

                <input size="10" minlength="1" maxlength="9" type="numero" name="numero" id="numero" value="" placeholder="Numero">

                &nbsp;

                &nbsp;



                <label>Observação</label>

                &nbsp;

                <input size="50" minlength="1" maxlength="100" type="varchar" name="observacao" id="observacao" value="" placeholder=""><br><br>

                <label>Data de Compra</label>

                &nbsp;

                <input size="45" minlength="0" maxlength="45" type="date" name="compra" id="compra" value='<?php echo date("Y-m-d"); ?>' placeholder="Data da compra">

                &nbsp;&nbsp;

                <label>Ultima Manutenção</label>

                &nbsp;

                <input minlength="1" maxlength="20" type="date" name="manu" id="manu" value='<?php echo date("Y-m-d"); ?>' placeholder="data_manutenção"><br><br>

                <label>Quantidade de manutenção</label>

                <input minlength="0" maxlength="14" type="int" size="5" name="qtde_manu" id="qtde_manu" value="" placeholder="Qtde">

                &nbsp;&nbsp;

                <label>Date Descarte</label>

                &nbsp;

                <input size="0" maxlength="4" type="date" name="date_desc" id="date_desc" value="" placeholder="date_desc">

                <br><br>





                <button input type="submit" name="acao">&nbsp;&nbsp;Salvar&nbsp;&nbsp;</button>

            </form>



        </div>

        <br>



        <div class="formulario_pesquisa_cacamba">



            <body>

                <div class="table-wrapper-cacamba">

                    <table BORDER="1" cellpadding="15">

                        <thead>



                            <tr>

                                <th>&nbsp;Numero&nbsp;</th>

                                <th>&nbsp;Observação&nbsp;</th>

                                <th>&nbsp;Data de Compra&nbsp;</th>

                                <th>&nbsp;Ultima Manutenção&nbsp;</th>

                                <th>&nbsp;Qtde de manutenções&nbsp;</th>

                                <th>&nbsp;Status&nbsp;</th>



                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            while ($arquivos = $sql_c_cacamba->fetch_assoc()) { ?>



                                <tr>



                                    <td><a>&nbsp;<?php echo $arquivos['numero']; ?>&nbsp;</a></td>

                                    <td><a>&nbsp;<?php echo $arquivos['observacao']; ?>&nbsp;</a></td>

                                    <td><a>&nbsp;<?php echo $arquivos['data_compra']; ?>&nbsp;</a></td>

                                    <td><a>&nbsp;<?php echo $arquivos['ult_manutencao']; ?>&nbsp;</a></td>

                                    <td align="center"><a>&nbsp;<?php echo $arquivos['qtde_manutencao']; ?>&nbsp;</a></td>

                                    <td><a>&nbsp;<?php echo $arquivos['status']; ?>&nbsp;</a></td>





                                </tr>



                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </body>

        </div>
    </div>
</div>




<script src="./js/mudar.js">

</script>

<?php

?>