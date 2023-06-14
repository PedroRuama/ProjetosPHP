<html>
    <head>
        <title>Minha pagina web - Formulario - Recuperando os Dados</title>
    </head>
    <body>
        <?php
            $idBanco = 10;
            $nomeUser = "admin";
            echo "<a href='exemplo07_dados.php?id=";
            echo $idBanco;
            echo "$user=";
            echo $nomeUser;
            echo "> Passando dados via URL </a>"
        ?>
        
    </body>



</html>
