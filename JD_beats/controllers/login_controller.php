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

if (isset($_POST['pass'])) {
    $pass = $_POST['pass'];
}else{$pass = 0;}



$senha_codificada = password_hash($pass, PASSWORD_DEFAULT);


switch ($log) {
    case 1:
        //criar conta
        $Verificacao = mysqli_query($conexao, "SELECT user_name from users where user_name='$username'");
        $num_rows = mysqli_num_rows($Verificacao);
        if ($num_rows > 0) {
            header("Location: ../log_page.php?singup&error");
        } else {
            $insert = "insert into users(email, user_name, pass, nome)
            values('$email', '$username', '$senha_codificada', '$nome')";

            $resultado = @mysqli_query($conexao, $insert);

            if (!$resultado) {
                die('Query Inválida:' . @mysqli_error($conexao));
            } else {
                echo 'Sucesso!';
            }
            header("Location: ../login.php?logcreated");
        }

        break;


    case 2:
        //logar
        $Verificacao = mysqli_query($conexao, "SELECT * from users WHERE email='$email_user' OR user_name='$email_user'");
        // $num_rows = mysqli_num_rows($Verificacao);

        $dadosU = mysqli_fetch_array($Verificacao);



        if (password_verify($pass, $dadosU['pass'])) {

            // Armazenar dados na sessão
            $_SESSION['user_name'] = $dadosU['user_name'];


            echo "<script>alert('Logado com Sucesso!" . $_SESSION['user_name'] . "');</script>";
            // echo "<script>location.href='../index.php';</script>";
            header("Location: ../index.php?logado");
        } else {
            header("Location: ../log_page.php?singin&logError");
        }
        break;

    case 3:
            session_destroy();
            echo "<script>alert('Deslogado com sucesso!');</script>";
            header("Location: ../index.php?deslog");
        break;
    default:
        # code...
        break;
}





mysqli_close($conexao);
