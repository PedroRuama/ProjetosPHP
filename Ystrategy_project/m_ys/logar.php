<?php

include('conexao.php');



// error_reporting(0);

$usuario2 = mysqli_real_escape_string($conexao, $_POST['nome']);

$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

//$query = "select * from login";

$query = "select * from cadastro WHERE( usuario = '{$usuario2}' or email = '{$usuario2}') and SENHA = md5('{$senha}')" or die($mysqli_error);

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);



$querym = "SELECT * FROM `base_motorista` WHERE UserName_motorista = '{$usuario2}'  and senha_motorista = md5('{$senha}')" or die($mysqli_error);

$resultm = mysqli_query($conexao, $querym);

$rowm = mysqli_num_rows($resultm);









$sql_query2 =  mysqli_query($conexao, "select * from cadastro where ((USUARIO = '{$usuario2}' or email = '{$usuario2}') ) and SENHA = md5('{$senha}')") or die($mysqli_error);

$sql_query3 =  mysqli_query($conexao, "select * from base_motorista WHERE UserName_motorista = '{$usuario2}'  and senha_motorista = md5('{$senha}')") or die($mysqli_error);



if ($usuario2 === "") {

    echo "<script>alert('O campo nome nao pode estar vazio');</script>";
} elseif ($row == 1) {

    $arquivos = $sql_query2->fetch_assoc();

    $_SESSION['usuario'] = $arquivos['USUARIO'];

    $_SESSION['acao'] = $arquivos['acao'];

    $_SESSION['ACESSO'] = $arquivos['ACESSO'];

    if($_SESSION['ACESSO'] == 'FORMIGA'){
        $_SESSION['TIPO_SE'] = 'FORMIGA';
    }else{
         $_SESSION['TIPO_SE'] = 'MUNDIAL';
    }

    if ($_SESSION['acao'] == 'Geral') {

        echo "<script>alert('Logado com Sucesso!');</script>";

        echo "<script>location.href='form_rt.php';</script>";
        
    }else if( $_SESSION['acao'] == 'Resumos'){

        echo "<script>alert('Logado com Sucesso!');</script>";
        echo "<script>location.href='visao_geral.php';</script>";

    }else if( $_SESSION['acao'] == 'Observador'){

        echo "<script>alert('Logado com Sucesso!');</script>";
        echo "<script>location.href='form_m_servicos_NEW.php';</script>";
        $_SESSION['motorista'] = $arquivos['obs_m'];

    }


} elseif ($rowm == 1) {

    $arquivos = $sql_query3->fetch_assoc();

    $_SESSION['motorista'] = $arquivos['UserName_motorista'];


    echo "<script>alert('Logado com Sucesso!');</script>";

    echo "<script>location.href='form_m_servicos_NEW.php';</script>";
} else {

    echo "<script>alert('$usuario2, verifique!, Usuario e/ou senha incorreta!');</script>";

    echo "<script>history.go(-1)</script>";
}
