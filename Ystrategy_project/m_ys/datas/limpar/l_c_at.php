<div style="display:none;">
    <?php
    include('../../menu.php');
     ?>
</div>
<?php
    include('../../conexao.php');
    $user = $_SESSION['usuario'];

?>


<?php



$incluircadastro1 = $conexao->prepare("DELETE FROM consulta where tabela = 'aterro' and usuario = '$user' ");

$incluircadastro1->execute();

echo "<script>history.go(-1)</script>";
