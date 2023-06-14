<?php 
    echo '<h3> Recuperando os dados </h3>';
    if(isset($_POST['asp'])){
        echo "ASP:".$_POST['asp'];
        echo '<br>';
    }
    if(isset($_POST['php'])){
        echo "PHP:".$_POST['php'];
        echo '<br>';
    }
    if(isset($_POST['java'])){
        echo "JAVA: ".$_POST['java'];
        echo '<br>';
    }
?>