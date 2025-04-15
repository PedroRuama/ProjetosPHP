<?php


if (!isset($_SESSION)) {

    session_start();
}



$dbhost = '127.0.0.1:3306';
$dbusername = 'u247855321_ystrategy';
$dbpassword = 'B^$SJoB=b9T';
$dbname = 'u247855321_ystrategy_bd';

// $dbhost = 'localhost';
// $dbusername = 'root';
// $dbpassword = '';
// $dbname = 'ystrategy_bd';

$conexao = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die('Não foi possivel conectar com o banco');

if ($conexao->connect_errno) {
    echo "Não foi possivel conectar com o banco";
} else {
}


$conexao->set_charset("utf8");

?>