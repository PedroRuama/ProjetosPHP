<?php

include('menu.php');


?>

<?php

$user = $_SESSION['usuario'];

// VISÃO consulta pedido em aberto

$sessin_tabela =  mysqli_query($conexao, "select * from cadastro where USUARIO = '$user' and (sessao = 'VEICULOS' or sessao = 'ADMINISTRADOR')") or die($mysqli_error);

while ($pagina = $sessin_tabela->fetch_assoc()) {

    $row = mysqli_num_rows($sessin_tabela);

    $_SESSION['pagina'] =  $pagina['USUARIO'];
}

?>



<div class="Box-Dashbord">
    <div class="Conteudo-Dashbord">

        <div class="digitar_veiculos">



            <h1>Cadastro de Veiculos</h1>

            <br>

            <form action="cadastrar_veiculo.php" method="post">

                <label>Placa</label>

                &nbsp;

                <input size="10" onkeyup="maiuscula(this)" minlength="7" maxlength="8" type="varchar" name="placa" id="placa" value="" placeholder="Placa">

                &nbsp; &nbsp;

                <label>Nome</label>

                &nbsp;

                <input size="29" onkeyup="maiuscula(this)" minlength="1" maxlength="25" type="varchar" name="nome_veiculo" id="nome_veiculo" value="" placeholder="">

                <label>Chassi</label>

                &nbsp;

                <input size="40" minlength="10" onkeyup="maiuscula(this)" maxlength="45" type="varchar" name="chassi" id="chassi" value="" placeholder="Chassi">

                &nbsp; &nbsp;

                <label>Modelo</label>

                &nbsp;

                <input minlength="1" maxlength="20" onkeyup="maiuscula(this)" type="modelo" name="modelo" id="modelo" value="" placeholder="modelo">

                <br><br>



                <label>Marca</label>

                &nbsp;

                <input minlength="6" maxlength="14" onkeyup="maiuscula(this)" type="marca" name="marca" id="marca" value="" placeholder="marca">

                &nbsp; &nbsp; &nbsp; &nbsp;





                <label>Ano</label>

                &nbsp;

                <input size="14" maxlength="4" type="int" name="ano" id="ano" value="" placeholder="ano">

                &nbsp; &nbsp; &nbsp; &nbsp;



                <label>licenciamento</label>

                &nbsp;

                <input size="10" minlength="4" maxlength="4" type="int" name="licenciamento" id="licenciamento" value="" placeholder="licenciamento">

                &nbsp; &nbsp; &nbsp; &nbsp;



                <label>Mes Licenciar</label>

                &nbsp;

                <input type="mes_licenciar" name="mes_licenciar" id="mes_licenciar" value=""

                    placeholder="mes_licenciar">





                &nbsp; &nbsp;&nbsp;&nbsp;

                <button input type="submit" name="acao">&nbsp;&nbsp;Salvar&nbsp;&nbsp;</button>

                <br><br>

            </form>





        </div>



        <div class="formulario_pesquisa_veiculos">



            <body>

                <div class="table-wrapper-veiculos">

                    <table BORDER="1" cellpadding="15">

                        <thead>



                            <tr>

                                <th>Placa</th>

                                <th>Nome</th>

                                <th>&nbsp;Chassi&nbsp;</th>

                                <th>&nbsp;Modelo&nbsp;</th>

                                <th>&nbsp;Marca&nbsp;</th>

                                <th>&nbsp;licenciado&nbsp;</th>

                                <th>&nbsp;❌&nbsp;</th>



                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            while ($arquivos = $sql_c_placa->fetch_assoc()) { ?>



                                <tr>



                                    <td><a>&nbsp;<?php echo $arquivos['placa']; ?>&nbsp;</a></td>

                                    <td><a>&nbsp;<?php echo $arquivos['nome_veiculo']; ?>&nbsp;</a></td>

                                    <td><a>&nbsp;<?php echo $arquivos['chassi']; ?>&nbsp;</a></td>

                                    <td align="center"><a>&nbsp;<?php echo $arquivos['Modelo']; ?>&nbsp;</a></td>

                                    <td><a>&nbsp;<?php echo $arquivos['Marca']; ?>&nbsp;</a></td>

                                    <td align="center"><a>&nbsp;<?php echo $arquivos['Licenciado']; ?>&nbsp;</a></td>

                                    <th><a href="?apaga_veiculos=<?PHP echo $arquivos['id'] ?>">&nbsp;🚫&nbsp;</a></th>



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