
<?php
    include_once('conexao.php');

    $acao = $_POST['acao'];
    $editVal = $_POST['editVal'];
    
    $select = $_POST['select'];
    $valmin = $_POST['rangeMin'];
    $valmax = $_POST['rangeMax'];


    if ($acao == 1) {
        $editCaixa = "update caixa set montante = montante - $editVal";
    }
    if ($acao == 2) {
        $editCaixa = "update caixa set montante = montante + $editVal";
    }
    $resultado = @mysqli_query($conexao, $editCaixa);
    if(!$resultado){
        die('Query Inválida:'.@mysqli_error($conexao));
    } 
    ?>
    <script>window.location.href = "../estatisticas.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>";</script>

    <?php
    
    
    //criando delet
    

    //executando instrução SQL
    
    mysqli_close($conexao);


    
?>