
<?php



include('menu.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/indexm.css">
    <title>Document</title>
</head>
ser

<?php

if(!isset($_SESSION['usuario']))

{

    header("Location: index.php");

    exit;

}

?>



<body>



    <script type="text/javascript">

    function maiuscula(string) {

        res = string.value.toUpperCase();

        string.value = res;



    }

    </script>

    <script type="text/javascript">

    function minuscula(string) {

        min = string.value.toLowerCase();

        string.value = min;



    }

    </script>



    <?php

     $sql_c_motorista =  mysqli_query($conexao, "select * from base_aterro order by nome_aterro") or die($mysqli_error);

     $C_D_I_F1 =  mysqli_query($conexao, "select * from consulta where entrega <> '' and tabela = 'servico'") or die($mysqli_error);

     while ($arquivos1 = $C_D_I_F1->fetch_assoc()) {

     $im = $arquivos1['entrega'];

     $Q = "SELECT * FROM `consulta` WHERE entrega <> '' and tabela = 'servico' ";

     $R = mysqli_query($conexao, $Q);

     $row11 = mysqli_num_rows($R);

     // echo $row11;

     $hoje = date('Y,m,d');



     }

        

            // VISÃO CONSULTA DOS SERVIÇOS EM ABERTO

            

            $pedidos_aberto2 =  mysqli_query($conexao, "select  * from base_os where (status = 'Entregar' or status = 'Retirar') and (data_retirada = '$im' or  data_entrega = '$im')  GROUP BY motorista   order by motorista") or die($mysqli_error);

            



            // VISÃO CONSULTA DOS SERVIÇOS EM ABERTO  // ############################################## //



            $pedidos_aberto = mysqli_query($conexao,"select  motorista,status,tipo_os,data_entrega,data_retirada,Endereco,numero,complemento,(select num_pedido from base_os a where  data_retirada = '$im' and a.num_pedido = x.num_pedido and a.motorista = x.motorista and a.codigo_cliente = x.codigo_cliente and status = 'Retirar' ) as Ped_ret,(select obs from base_os b where b.num_pedido = x.num_pedido and b.motorista = x.motorista and (data_entrega = '$im' or data_retirada = '$im') and b.codigo_cliente = x.codigo_cliente) as comentario,(select num_pedido from base_os c where  c.num_pedido = x.num_pedido and c.motorista = x.motorista and data_entrega = '$im'  and c.codigo_cliente = x.codigo_cliente and status = 'Entregar' ) as Ped_ENT from base_os x where (status = 'Entregar' or status = 'Retirar' ) and (data_entrega = '$im' or data_retirada = '$im')  GROUP BY motorista") or die($mysqli_error);



           

            

            $aterross =  mysqli_query($conexao, "select * from base_aterro order by nome_aterro") or die($mysqli_error);

            

            //PEDIDO BUSCA MOTORISTA

             

             



       ?>

  

    <h1>Motorista Serviços</h1>

    <div class="tabela-resumo">



        <table BORDER="1" cellpadding="15" style="overflow-x:auto; background-color: lightsteelblue;">



            <thead>



                <tr>

                    <th>Motorista</th>

                    <th>&nbsp;ENTREGAR&nbsp;</th>

                    <th>&nbsp;TROCAR&nbsp;</th>

                    <th>&nbsp;RETIRAR&nbsp;</th>

                    <th>&nbsp;Total&nbsp;</th>

                </tr>

            </thead>

            <tbody>

                <?php

                    

                       $e_a_p_m =  mysqli_query($conexao, "SELECT motorista,(select COUNT(status) from base_os a where a.motorista = x.motorista  and ((data_entrega = '$im' and (status = 'entregar' or status = 'Entregue')) or (data_retirada = '$im' and (status = 'Retirar' or status = 'Retirado'))) GROUP BY motorista) - ((select COUNT(status) from base_os a where a.motorista = x.motorista and ( status = 'Entregar' or status = 'Entregue') AND tipo_os = 'Troca'  and data_entrega = '$im' )) as Total,(select COUNT(status) from base_os a where a.motorista = x.motorista and ( status = 'Entregar' or status = 'Entregue') AND tipo_os <> 'Troca'and data_entrega = '$im') as Entregar,(select COUNT(status) from base_os a where a.motorista = x.motorista and ( status = 'Entregar' or status = 'Entregue') AND tipo_os = 'Troca'  and data_entrega = '$im' ) as Trocar,((select COUNT(status) from base_os b where b.motorista = x.motorista and (status = 'RETIRAR' or status = 'Retirado')  and data_retirada = '$im')-(select COUNT(status) from base_os a where a.motorista = x.motorista and (status = 'Entregar' or status = 'Entregue') AND tipo_os = 'Troca'  and data_entrega = '$im' )) as Retirar FROM base_os x GROUP by motorista;") or die($mysqli_error);

                    

            

                     while ($peds = $e_a_p_m->fetch_assoc()) {

                      $n = explode(' ', $peds['motorista']);

                      $pN = $n[0]; // 'Carlos'

                ?>

                <tr>



                    <td><a>&nbsp;&nbsp;<?php echo $pN; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                    <td style="text-align: center; color: white;">

                        <a>&nbsp;&nbsp;<?php echo $peds['Entregar']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a>

                    </td>

                    <td style="text-align: center; color: white;">

                        <a>&nbsp;&nbsp;<?php echo $peds['Trocar']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a>

                    </td>

                    <td style="text-align: center; color: white;">

                        <a>&nbsp;&nbsp;<?php echo $peds['Retirar']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                    <td style="text-align: center; color: white;">

                        <a>&nbsp;&nbsp;<?php echo $peds['Total']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

                </tr>



                <?php } ?>



            </tbody>

        </table>

    </div>



    <br>



    

    <div class="calendario-servico">

        <form action="data_consulta_servico.php" method="post">

        <label>Data</label>

        <input size="45" minlength="0" maxlength="45" type="date" name="d_inicio" id="d_inicio"

            value='<?php echo $im ?>' placeholder="">

        <button input type="submit" name="acao">&nbsp;&nbsp;&nbsp;Gravar data&nbsp;&nbsp;&nbsp;</button>

        </form>

        <br><br><br>

    </div>

   

   

    <div class="quadro">



        <?php



while($pedido = $pedidos_aberto -> fetch_assoc()){

 $motorista = $pedido['motorista'];



 ?>



        <div class="tabela-resumo1">

            <br>





            <table BORDER="1" cellpadding="15"

                style="overflow-x:auto; background-color: lightsteelblue; width:100%; max-width: 100%;">







                <tr>

                    <th><?php echo $motorista ?></th>



                    <?php





                 $pedido_aberto = mysqli_query($conexao,"select  motorista,status,tipo_os,data_entrega,data_retirada,Endereco,numero,complemento,cacamba,(select num_pedido from base_os a where a.num_pedido = x.num_pedido and a.motorista = x.motorista and  data_retirada = '$im' and a.codigo_cliente = x.codigo_cliente and status = 'Retirar' ) as Ped_ret,(select obs from base_os b where b.num_pedido = x.num_pedido and (data_entrega = '$im' or data_retirada = '$im') and b.motorista = x.motorista and b.codigo_cliente = x.codigo_cliente) as comentario,(select num_pedido from base_os c where  c.num_pedido = x.num_pedido and c.motorista = x.motorista and data_entrega = '$im' and c.codigo_cliente = x.codigo_cliente and status = 'Entregar' ) as Ped_ENT from base_os x where (status = 'Entregar' or status = 'Retirar' ) and (data_entrega = '$im' or data_retirada = '$im') and motorista = '$motorista'  GROUP BY motorista,Endereco,num_pedido;") or die($mysqli_error);



                 while ($peds = $pedido_aberto->fetch_assoc()) {

                 $n = explode(' ', $peds['motorista']);

                 $pN = $n[0]; // 'Carlos'

            ?>

                </tr>



                <tr>

                    <td>

                        <?php



                        if($peds['Ped_ENT']){ ?>

                        Endereço&nbsp;:

                        &nbsp;&nbsp;<?php echo $peds['Endereco'];?>&nbsp;&nbsp;Nº&nbsp;:

                        &nbsp;&nbsp;<?php echo $peds['numero'];?>

                        &nbsp;&nbsp;<?php echo $peds['complemento'];?>

                        <br>

                        Numero do Pedido&nbsp;:

                        &nbsp;&nbsp;<?php echo $peds['Ped_ENT'];?><br>

                        Comentario&nbsp;:&nbsp;&nbsp;

                        &nbsp;&nbsp;<?php echo $peds['comentario']; ?>&nbsp;&nbsp;&nbsp;

                        <br>

                        Data de Entrega&nbsp;:&nbsp;&nbsp;

                        &nbsp;&nbsp;<?php echo $peds['data_entrega']; ?>&nbsp;&nbsp;&nbsp;



                        <form action="cmc.php?update3=<?PHP echo $peds['Ped_ENT']?>" method="post">

                            Inserir o Numero da Caçamba<br><br>

                            <input type="text" name="six" size="3">

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <button input type="submit"

                                name="acao">&nbsp;&nbsp;&nbsp;COLOCAÇÃO&nbsp;&nbsp;&nbsp;</button>

                            <br><br>

                        </form>



                        <?php

                        }



                        if($peds['Ped_ret']){ ?>



                        <form action="cmcr.php?update3=<?PHP echo $peds['Ped_ret']?>" method="post">



                            Endereço&nbsp;:

                            &nbsp;&nbsp;<?php echo $peds['Endereco'];?>&nbsp;&nbsp;Nº&nbsp;:

                            &nbsp;&nbsp;<?php echo $peds['numero'];?><br>



                            Numero do Pedido&nbsp;:

                            <?php echo $peds['Ped_ret'];?><br>

                            Numero da Caçamba&nbsp;:

                            <?php echo $peds['cacamba'];?><br>

                            Data de Retirada&nbsp;:&nbsp;&nbsp;

                            &nbsp;&nbsp;<?php echo $peds['data_retirada']; ?>&nbsp;&nbsp;&nbsp;

                            <br><br>

                            <label>Aterro</label>

                            <select id="aterro" name="aterro">

                                <option value=""></option>

                                <?php

                                   mysqli_data_seek($aterross, 0);

                                   while ($p_aterros = $aterross->fetch_assoc()) { ?>

                                <option value='<?php echo $p_aterros['Nome_aterro'];?>'>

                                    <?php echo $p_aterros['Nome_aterro']; ?></option>

                                <?php } ?>

                            </select>



                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <button input type="submit"

                                name="acao">&nbsp;&nbsp;&nbsp;<?php echo $peds['status']; ?>&nbsp;&nbsp;&nbsp;</button>

                            <br><br>

                        </form>





                    </td>





                </tr>









                <?php } }?>







            </table>



        </div>

        <?php } ?>

    </div>



</body>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

<?php


?>