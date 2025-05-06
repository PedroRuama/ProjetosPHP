<?php

include('menu.php');



?>

<?php

$user = $_SESSION['usuario'];

// VISÃO consulta pedido em aberto

$sessin_tabela =  mysqli_query($conexao, "select * from cadastro where USUARIO = '$user' and (sessao = 'VALORES' or sessao = 'ADMINISTRADOR')") or die($mysqli_error);

while ($pagina = $sessin_tabela->fetch_assoc()) {

    $row = mysqli_num_rows($sessin_tabela);

    $_SESSION['pagina'] =  $pagina['USUARIO'];
}

?>







<div class="Box-Dashbord">
    <div class="Conteudo-Dashbord">

        <div class="digitar-valores">

            <h1>Cadastro de Valores</h1>

            <br>

            <form action="cadastrar_valores.php" method="post">

                <label>Tipo</label>

                &nbsp;

                <input size="10" minlength="1" maxlength="15" onkeyup="maiuscula(this)" type="Desc" name="Desc" id="Desc"

                    value="" placeholder="Descrição"><br><br>

                <label>Valor</label>

                <input size="10" minlength="0" maxlength="10" type="int" name="valor" id="valor" value="" placeholder="Valor">



                <button input type="submit" name="acao">&nbsp;&nbsp;Salvar&nbsp;&nbsp;</button>

            </form>



        </div>



        <body>

            <div class="table-wrapper-valores">

                <table BORDER="1" cellpadding="15">



                    <thead>



                        <tr>

                            <th>&nbsp;TIPO&nbsp;</th>

                            <th>&nbsp;VALOR&nbsp;</th>

                            <th>&nbsp;❌&nbsp;</th>





                    </thead>

                    <tbody>

                        <?php



                        $user_s =  mysqli_query($conexao, "select * from base_valores  order by Tipo_valor") or die($mysqli_error);

                        while ($cad = $user_s->fetch_assoc()) { ?>

                            <tr>



                                <td><a>&nbsp;&nbsp;<?php echo $cad['Tipo_valor']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                                <td><a>&nbsp;&nbsp;<?php echo $cad['valor']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                                <th><a href="?apaga_valores=<?PHP echo $cad['id'] ?>">&nbsp;🚫&nbsp;</a></th>



                            </tr>

                            <br>



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