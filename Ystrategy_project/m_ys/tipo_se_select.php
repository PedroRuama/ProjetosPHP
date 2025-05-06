<?php

include('conexao.php');

if(isset($_GET['MUNDIAL'])){
    $_SESSION['TIPO_SE'] = 'MUNDIAL';
}elseif(isset($_GET['FORMIGA'])){
    $_SESSION['TIPO_SE'] = 'FORMIGA';
}
include('chamadas_sql.php');

echo "<script>location.href='form_rt.php';</script>";
?>