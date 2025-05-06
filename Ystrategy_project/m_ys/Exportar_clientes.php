<?php
include('conexao.php')
?>
<?php
    $hoje = date('Y,m,d');

    header("Content-type: application/vnd.ms-excel");
    header("Content-type: application/force-download");
    header("Content-Disposition: attachment; filename=$hpje.clientes.xls");
    header("Pragma: no-cache");

?>
<table>
    <tr>
        <td>Contrato</td>
        <td>Clliente</td>
        <td>Email</td>
        <td>CPF</td>
        <td>RG</td>
        <td>Telefone</td>
        <td>Credito</td>
        <td>Tipo de Nota</td>
        <td>Administrador</td>







       
    </tr>
<?php
 $sql_cadastro_cliente =  mysqli_query($conexao, "select * from base_clientes order by  codigo_cliente desc ") or die($mysqli_error);
 while ($venda = $sql_cadastro_cliente->fetch_assoc()) { 
    echo "<tr><td>".$venda['codigo_cliente']."</td><td>".$venda['nome_cliente']."</td><td>".$venda['email']."</td><td>".$venda['CPF']."</td><td>".$venda['rg']."</td><td>".$venda['telefone_contato']."</td><td>".$venda['credito_cliente']."</td><td>".$venda['tipo_nota']."</td><td>".$venda['administrador']."</td></tr>";
    }
?>
</table>
<?php
 header('location: form_cadastro_cliente.php');
?>