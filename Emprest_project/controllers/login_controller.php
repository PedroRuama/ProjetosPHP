<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_POST['login'] == 'adm' &  $_POST['senha'] == '123'){
            header("Location: ../inicial.php");
            die();
        }
        else{
            echo '<div id="erro"> Login incorreto </div>';   
        }
    }
?>