<?php
include 'conexao.php';

$name = mysqli_real_escape_string($conexao, $_POST['name']);
$tipo = mysqli_real_escape_string($conexao, $_POST['tipo']);


$incluircadastro = $conexao->prepare("INSERT INTO categorias(userID, name, tipo, padrao_ys) VALUES(" . $_SESSION['userID'] . ", '$name', '$tipo', 0)");

$incluircadastro->execute();


echo "<script> location.href = '../config.php' </script>";
?>