<?php
    function open_database(){
        try {
            //intancia o objeto PDO
            $pdo = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            
            //define para que o PDO lance exceções caso ocorra erros
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'conectado';
            return $pdo;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function close_database(){
        try {
            unset($pdo); //ou $pdo = null
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }   
    
    




?>
