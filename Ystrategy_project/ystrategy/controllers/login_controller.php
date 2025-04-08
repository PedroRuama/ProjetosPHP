<?php 
include("./conexao.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$_POST = array_map('strtoupper', $_POST);  

$user = mysqli_real_escape_string($conexao, $_POST['user']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select * from cad_user where(usuario = '{$user}' OR email='{$user}' AND senha = md5('{$senha}'))" or die($mysqli_error);
$resultado = mysqli_query($conexao, $query) or die("MySQL Error: " . $mysqli->error);
$rows = mysqli_num_rows($resultado);

if ($user === "") {
    echo "<script> alert('O campo usuário não pode estar vazio')</script>";
}elseif ($rows == 1) {
    $dados = $resultado->fetch_assoc();
    $_SESSION['userID'] = $dados['id'];
    $_SESSION['user'] = $dados['usuario'];
    $_SESSION['acao'] = $dados['acao'];
    $_SESSION['acesso'] = $dados['acesso'];

    echo "<script> alert('Logado com sucesso, bem vindo(a) ".$user."')</script>";


    if ($_SESSION['acao'] == 'geral') {
        echo "<script> location.href='../lancamentos.php'</script>";
    }
    
} 

?>