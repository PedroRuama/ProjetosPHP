<?php 

    // O nome do banco de dados
    define('DB_NAME', 'crud_pdo');

    //usuário do banco de dados mysql
    define('DB_USER', 'root');

    //senha do banco de dados
    define('DB_PASSWORD', '');

    //nome do host
    define('DB_HOST', 'localhost');

    //caminho absoluto para a pasta do sistema
   if (!defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) .'/');

    //camih do server para o sistema
    if( !defined('BASEURL') ) 
        define('BASEURL', '/crud-pdo-php');
    
   // caminho do arquivo de banco de dados
    if( !defined('DBAPI') )
        define('DBAPI', ABSPATH . 'inc/database.php'); 
    


?>  