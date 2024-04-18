<?php
    include_once('conexao.php');
    
    $log = $_GET['log'];

    if (isset($_POST['email'])) {
        $email = $_POST['email'];   
    }
    if (isset($_POST['user_name'])) {
        $username = $_POST['user_name'];
    }
    if (isset($_POST['email_user'])) {
        $email_user = $_POST['email_user'];
    }
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
    }



    $pass = $_POST['pass'];
   
    $senha_codificada = password_hash($pass, PASSWORD_DEFAULT);
  


    

    if ($log == 1) {
    
        $Verificacao = mysqli_query($conexao, "SELECT user_name from users where user_name='$username'");
        $num_rows = mysqli_num_rows($Verificacao);
        if ($num_rows > 0) {
            header("Location: ../routes/criarconta.php?error");  
        }else{


            $insert = "insert into users(email, user_name, pass, nome)
            values('$email', '$username', '$senha_codificada', '$nome')";
            // //executando instrução SQL
            $resultado = @mysqli_query($conexao, $insert);
        
            if (!$resultado) {
                die('Query Inválida:' . @mysqli_error($conexao));
            } else { echo 'Sucesso!';
            }
            header("Location: ../routes/login.php?logcreated");
        }
        
    }
    if ($log == 2) {
    
        $Verificacao = mysqli_query($conexao, "SELECT * from users WHERE email='$email_user' OR user_name='$email_user'");
        // $num_rows = mysqli_num_rows($Verificacao);
        
        $dadosU = mysqli_fetch_array($Verificacao);



        if (password_verify($pass, $dadosU['pass'])) {
            
            $nome_u = $dadosU['user_name'];
            header("Location: ../index?user=$nome_u");  
        } else {
            header("Location: ../routes/login.php?logError");
            
        }

        
    }


    


    mysqli_close($conexao);




?>