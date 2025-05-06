<?php

if(!isset($_SESSION)){

session_start();

}

?>

<?php



// $dbhost = 'localhost';

// $dbusername = 'root';

// $dbpassword = '';

// $dbname = 'mundial';



$dbhost = '127.0.0.1:3306';
$dbusername = 'u247855321_m_ys';
$dbpassword = 'Mundial@123';
$dbname = 'u247855321_m_ys';


$conexao = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die ('nao foi possivel conectar');

if ($conexao->connect_errno) {

  // echo "conexao nao estabelecida";

} else {

  // echo "conexao  estabelecida";



  $conexao->set_charset("utf8");



}

?>

