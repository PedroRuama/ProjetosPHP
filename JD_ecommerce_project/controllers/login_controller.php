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
    $pass = $_POST['pass'];

    if ($log == 1) {
    
        $Verificacao = mysqli_query($conexao, "SELECT user_name from users where user_name='$username'");
        $num_rows = mysqli_num_rows($Verificacao);
        if ($num_rows > 0) {
            header("Location: ../routes/criarconta.php?error");  
        }else{
            $insert = "insert into users(email, user_name, pass)
            values('$email', '$username', '$pass')";
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
    
        $Verificacao = mysqli_query($conexao, "SELECT * from users WHERE email='$email_user' OR user_name='$email_user' AND pass='$pass'");
        $num_rows = mysqli_num_rows($Verificacao);
        
        if ($num_rows > 0) {

            $dadosU = mysqli_fetch_array($Verificacao);
            $nome_U = $dados['user_name'];
            header("Location: ../index?user=$nome_U");  
        }else{
          
            header("Location: ../routes/login.php?logError");
        }
        
    }


    

   

    mysqli_close($conexao);










    do {
        $Verificacao = mysqli_query($conexao, "SELECT codP from produtos where codP = '$AutoCodP'");
        $num_rows = mysqli_num_rows($Verificacao);

    } while ($num_rows > 0);


  





    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_POST['login'] == 'ygor' &  $_POST['senha'] == '46890417'){
            header("Location: ../inicial.php?select=1&rangeMin=0&rangeMax=10000");
            die();
        }
        if($_POST['login'] == 'ruama' &  $_POST['senha'] == '2426'){
            header("Location: ../inicial.php?select=1&rangeMin=0&rangeMax=10000");
            die();
        }
        if($_POST['login'] == 'lucas' &  $_POST['senha'] == '123456'){
            header("Location: ../inicial.php?login=1&select=1&rangeMin=0&rangeMax=10000");
            die();
        }
        else{
            header("Location: ../index.php?user=1");      
        }
    }
?>