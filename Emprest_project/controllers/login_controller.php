<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_POST['login'] == 'adm' &  $_POST['senha'] == '123'){
            header("Location: ../inicial.php?select=1&rangeMin=0&rangeMax=10000");
            die();
        }
        else{
            header("Location: ../index.php");
               
        }
    }
?>