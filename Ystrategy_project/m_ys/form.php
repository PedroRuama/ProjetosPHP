<div class="visao_clientes">



                <?php $sql_cadastro_cliente1 =  mysqli_query($conexao, "select * from base_clientes order by  codigo_cliente desc ") or die($mysqli_error);?>



                <body>

                    <div class="table-wrapper">

                        <form action="Exportar_clientes.php" method="post">



                            <input type="submit" value="Exportar Cadastro">

                        </form>

                    </div>

                    <table border="1px" cellpadding="20" style=" background: white; border-width: 1px; borber-top-width:1px;">

                        <thead>



                            <tr>

                                <th style="border-width: 1; border-color: black;">&nbsp;Codigo&nbsp;</th>

                                <th style="border-width: 1; border-color: black;">&nbsp;Nome&nbsp;</th>

                                <th style="border-width: 1; border-color: black;">&nbsp;Email&nbsp;</th>

                                <th style="border-width: 1; border-color: black;">&nbsp;Credito&nbsp;</th>

                                <th style="border-width: 1; border-color: black;">&nbsp;Cpf&nbsp;</th>

                                <th style="border-width: 1; border-color: black;">&nbsp;telefone&nbsp;</th>

                                <th style="border-width: 1; border-color: black;">&nbsp;&nbsp;❌&nbsp;&nbsp;</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                     while ($arq = $sql_cadastro_cliente1->fetch_assoc()) {

                        

                    ?>



                            <tr>

                                <td style="border-width: 1; border-color: black;"><a>&nbsp;<?php echo $arq['codigo_cliente']; ?>&nbsp;</a></td>

                                <td style="border-width: 1; border-color: black;"><a>&nbsp;<?php echo $arq['nome_cliente']; ?>&nbsp;</a></td>

                                <td style="border-width: 1; border-color: black;"><a>&nbsp;<?php echo $arq['email']; ?>&nbsp;</a></td>

                                <td style="border-width: 1; border-color: black;"><a>&nbsp;&nbsp;<?php echo $arq['credito_cliente']; ?>&nbsp;&nbsp;</a></td>

                                <td style="border-width: 1; border-color: black;"><a>&nbsp;&nbsp;<?php echo $arq['CPF']; ?>&nbsp;&nbsp;</a></td>

                                <td style="border-width: 1; border-color: black;"><a>&nbsp;&nbsp;<?php echo $arq['telefone_contato']; ?>&nbsp;&nbsp;</a></td>



                                <th style="border-width: 1; border-color: black;"><a href="?apaga_cliente=<?PHP echo $arq['codigo_cliente'] ?>">&nbsp;🚫&nbsp;</a></th>

                            </tr>



                            <?php

                     }



                     ?>

                        </tbody>

                    </table>



                </body>

            </div>

        </div>
        
<?php

$erro = error_get_last();

if ($erro !== null) {
    // Se ocorreu um erro, exibe a mensagem personalizada
    echo "Erro no código, reporte ao técnico responsável.";
}

?>