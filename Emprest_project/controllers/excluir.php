
<?php
    include_once('conexao.php');

    $postId = $_POST['IdsExcluir'];
    $id = explode(",", $postId); //mesma coisa que o split
    
    
    $select = $_POST['select'];
    $valmin = $_POST['rangeMin'];
    $valmax = $_POST['rangeMax'];

    while(sizeOf($id) != 0){ // deleta um por um
        $delete = "delete from pessoas where id = $id[0]"; //deleta o 1° da array
        $resultado = @mysqli_query($conexao, $delete);
        if(!$resultado){
            die('Query Inválida:'.@mysqli_error($conexao));
        } 
        array_shift($id); //dropa o primeiro item da arrays
    }
    ?>
    <script>window.location.href = "../gerenciar.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>";</script>

    <?php
    
    //criando delet
    

    //executando instrução SQL
    
    mysqli_close($conexao);


    
?>