<?php
include_once("conexao1.php");



function retorna($matricula, $conn){
	$result_aluno = "SELECT * FROM cadastro where USUARIO = '$matricula'  LIMIT 1";
	$resultado_aluno = mysqli_query($conn, $result_aluno);
	if($resultado_aluno->num_rows){
		$row_aluno = mysqli_fetch_assoc($resultado_aluno);
		$valores['senha_cliente'] = $row_aluno['SENHA'];
		$valores['telefone_cliente'] = $row_aluno['telefone'];
		$valores['email_cliente'] = $row_aluno['email'];
		


	}else{
		$valores['email'] = 'sem cadastro';
	}
	return json_encode($valores);
}

if(isset($_GET['matricula'])){
	echo retorna($_GET['matricula'], $conn);
}
?>
<?php
if(!isset($_SESSION['usuario']))
{
    header("Location: index.php");
    exit;
}
?>
