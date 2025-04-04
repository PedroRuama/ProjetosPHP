<?php


if (!isset($_SESSION)) {

    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);


$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'ystrategy_bd';

$conexao = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die('Não foi possivel conectar com o banco');

if ($conexao->connect_errno) {
    echo "Não foi possivel conectar com o banco";
} else {
}


$conexao->set_charset("utf8");

?>