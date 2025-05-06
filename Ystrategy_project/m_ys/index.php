<?php

include("conexao.php");

?>
<!-- 
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="css/login.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=1370, user-scalable=yes, maximum-scale=10.0">
  <link rel="shortcut icon" href="./logo/logo (1).ico" type="image/x-icon">
  <title>Mundial Entulhos / Cadastros</title>
  <script src="./js/mudar.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  
</head> -->



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ystategy Caçambas</title>
  <link rel="shortcut icon" href="./logos/ystrategylogolaranja.png" type="image/x-icon">

  <link rel="stylesheet" href="css/login.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

  <link rel="manifest" href="/manifest.json">
</head>

<body>

</body>

</html>

<script>
  function forceReload() {
    console.log("Reload em andamento")
    // Recarrega a página sem cache
    location.reload(true); // true força o cache a ser ignorado
    console.log("Reload OK")
    document.getElementById("atualizar").style = "display:none";
    document.getElementById("msg_ok").style = "display:flex";
  }
</script>


<div class="msg-login">

  <?php

  if (isset($_SESSION['usuario'])) {

    include('menu.php');


   
  ?>
    <button id="addToHomeScreen" style="display:none;">Adicionar à Tela Inicial</button>



  <?php

  } else {
  ?>

    <body>
      <div class="alingLogin">
        <form class="form" action="logar.php" method="post">
          <div class="divLogo">
            <img src="./logos/ystrategylogotipolaranja.png" alt="logo" id=0 class="img"></a>
          </div>
          <br>
          <p class="form-title">Entre no seu login Ystrategy</p>
          <br>
          <br>
          <div class="Allinputs_div">

            <div class="input-container">
              <input type="name" name="nome" id="nome2" value="" placeholder="nome">
            </div>
            <div class="input-container">
              <input type="password" name="senha" id="senha2" value="" placeholder="senha">
            </div>
          </div>
          <br>
          <br>

          <button type="submit" class="submit">
            Entrar
          </button>
          <br>
          <br>
        </form>

      </div>


    </body>

  <?php

  }

  $hoje = date('Y,m,d');

  ?>

</div>




<script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js').then(() => {
      console.log('Service Worker registrado com sucesso.');
    }).catch(error => {
      console.error('Erro ao registrar o Service Worker:', error);
    });
  }

  let deferredPrompt;

  window.addEventListener('beforeinstallprompt', event => {
    event.preventDefault();
    deferredPrompt = event;

    const addToHomeScreenButton = document.getElementById('addToHomeScreen');
    addToHomeScreenButton.style = 'display: block';

    addToHomeScreenButton.addEventListener('click', () => {
      addToHomeScreenButton.style.display = 'none';
      deferredPrompt.prompt();

      deferredPrompt.userChoice.then(choiceResult => {
        if (choiceResult.outcome === 'accepted') {
          console.log('Usuário aceitou o prompt');
        } else {
          console.log('Usuário rejeitou o prompt');
        }
        deferredPrompt = null;
      });
    });
  });
</script>


</html>