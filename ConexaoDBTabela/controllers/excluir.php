 
    <?php
        include_once('conexao.php');

        $postId = $_POST['Ids'];
        $id = explode(",", $postId); //mesma coisa que o split
       
        while(sizeOf($id) != 0){ // deleta um por um
            $delete = "delete from produtos where id = $id[0]"; //deleta o 1° da array
            $resultado = @mysqli_query($conexao, $delete);
            if(!$resultado){
                die('Query Inválida:'.@mysqli_error($conexao));
            } 
            array_shift($id); //dropa o primeiro item da arrays
        }
        ?>
        <p>Registro deletado com sucesso</p>
        <button><a href="../index.php">Voltar</a></button>

     <?php
        
        //criando delet
        

        //executando instrução SQL
      
        mysqli_close($conexao);


        
    ?>