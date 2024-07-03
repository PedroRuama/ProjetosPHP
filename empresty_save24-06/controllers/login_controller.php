<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_POST['login'] == 'ygor' &  $_POST['senha'] == '46890417'){
            header("Location: ../inicial.php?select=1&rangeMin=0&rangeMax=10000");
            die();
        }
        if($_POST['login'] == 'ruama' &  $_POST['senha'] == '2426'){
            header("Location: ../inicial.php?select=1&rangeMin=0&rangeMax=10000");
            die();
        }
        if($_POST['login'] == 'lucas' &  $_POST['senha'] == '123456'){
            header("Location: ../inicial.php?login=1&select=1&rangeMin=0&rangeMax=10000");
            die();
        }
        else{
            header("Location: ../index.php?user=1");      
        }
    }
?>