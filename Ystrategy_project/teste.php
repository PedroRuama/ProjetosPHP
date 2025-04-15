<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dropdown Menu</title>
  <link rel="stylesheet" href="styles.css">
</head>

<style>
  /* Estilos básicos para a navegação */
  nav {
    background-color: #333;
  }

  .nav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
  }

  .nav>li {
    float: left;
  }

  .nav>li>a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  .nav>li>a:hover {
    background-color: #111;
  }

  /* Estilos para o dropdown */
  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content li {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content li a {
    color: black;
    text-decoration: none;
  }

  .dropdown-content li:hover {
    background-color: #f1f1f1;
  }

  /* Mostrar o dropdown ao passar o mouse */
  .dropdown:hover .dropdown-content {
    display: block;
  }
</style>

<body>
  <nav>
    <ul class="nav">
      <li class="dropdown">
        <a href="#" class="dropbtn">Menu</a>
        <ul class="dropdown-content">
          <li><a href="#">Opção 1</a></li>
          <li><a href="#">Opção 2</a></li>
          <li><a href="#">Opção 3</a></li>
        </ul>
      </li>
      <li><a href="#">Item 2</a></li>
      <li><a href="#">Item 3</a></li>
    </ul>
  </nav>
</body>

</html>