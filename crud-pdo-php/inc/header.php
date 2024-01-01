<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CRUD PDO</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://maxdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" 
    integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" 
    crossorigin="anonymos">
    <link rel="stylesheet" href="https://maxdn.bootstrapcdn.com/ootstrap/4.0.0-beta/css/bootstrap.min.css" >
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo BASEURL ?>"> CRUD PDO</a>
        <button class="navbar-toggler" type="button" data-toggle=collapse  data-target="#navbarNavDropdown"
         aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggle-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"> Clientes</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="<?php echo BASEURL ?> customers/" class="dropdown-item">Gerenciar</a>
                        <a href="<?php echo BASEURL ?> customers/add.php" class="dropdown-item">Novo Cliente</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <main class="container">
</body>
</html>