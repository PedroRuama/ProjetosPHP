
<?php
    include_once('conexao.php');

    $codP = $_GET['codP'];
    
    $delete = "delete from beats where codP = $codP"; 

    $resultado = @mysqli_query($conexao, $delete);
    if(!$resultado){
        die('Query Inválida:'.@mysqli_error($conexao));
    } 
   
    ?>
    <script>window.location.href = "../gerenciar.php";</script>

    <?php
    
    //criando delet
    

    //executando instrução SQL
    
    mysqli_close($conexao);


    
?>