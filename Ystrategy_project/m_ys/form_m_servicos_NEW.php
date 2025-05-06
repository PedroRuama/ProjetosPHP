  <div id="div_menu">
      <?php

        include('menu.php');

        ?>
  </div>
  <?php
    // if($_SESSION('ACESSO') == 'FORMIGA'){
    //     echo "<script>location.href='form_m_servicos_NEW.php?se_FORMIGA';</script>";
    // }

    if (!isset($_SESSION['usuario']) && !isset($_SESSION['motorista'])) {

        header("Location: index.php");

        exit;
    } else {
        $user1 = $_SESSION['motorista'];

        $user2 = $_SESSION['usuario'];

        $n = explode(' ', $user1);

        $pN = $n[0]; // 'Carlos'



        if (isset($user2)) {

            $user = $user2;
        } else {

            $user = $pN;
        }
    }


    // echo $_SESSION['motorista'];

    if ($_SESSION['ACESSO'] == 'FORMIGA' && !isset($_GET['se_FORMIGA'])) {
        echo "<script>location.href='form_m_servicos_NEW.php?se_FORMIGA';</script>";
    }

    ?>
  <br>
  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width">

      <link rel="stylesheet" href="./css/servicos_m.css">
      <link rel="stylesheet" href="./css/indexm.css">
      
  </head>

  <script>
      function maiuscula(string) {


          res = string.value.toUpperCase();

          string.value = res;



      }

      function minuscula(string) {

          min = string.value.toLowerCase();

          string.value = min;



      }

      function filtro_m_servicos(motorista) {
          // document.getElementById("div_menu").style.display = 'none'   
          document.getElementById("tr_totais").style.display = 'none'
          document.getElementById("sair_m").style.display = 'none'
          var motorista_tr = document.getElementsByClassName("motorista_tr")
          var coluna_motorista = document.getElementsByClassName("tabela-resumo1")





          for (let index = 0; index < motorista_tr.length; index++) {
              // console.log("for");
              const LINHA = motorista_tr[index];
              let td = 0;
              while (td < LINHA.getElementsByTagName('td').length) {
                  if (LINHA.getElementsByTagName('td')[td].innerHTML.includes(motorista)) {
                      LINHA.style.removeProperty("display");
                      td = LINHA.getElementsByTagName('td').length
                      // td = motorista_tr.getElementsByTagName('td').length

                  } else {
                      LINHA.style.display = 'none'
                  }
                  td++
              }
          }
          for (let index = 0; index < coluna_motorista.length; index++) {
              console.log("for");
              const COLUNA_M = coluna_motorista[index];

              if (COLUNA_M.getElementsByTagName('th')[0].innerHTML.includes(motorista)) {
                  COLUNA_M.style.removeProperty("display");
                  //  = COLUNA_M.getElementsByTagName('td').length
                  // td = motorista_tr.getElementsByTagName('td').length

              } else {
                  COLUNA_M.style.display = 'none'
              }



          }

      }

      function totais_Tresumo() {
          var td_entregas = document.getElementsByClassName("td_entregas");
          var td_trocas = document.getElementsByClassName("td_trocas");
          var td_retiradas = document.getElementsByClassName("td_retiradas");
          var td_totais = document.getElementsByClassName("td_totais");
          var val_entregas = 0;
          var val_trocas = 0;
          var val_retiradas = 0;
          var val_totais = 0;

          // Preencher a coluna "Total" em cada linha
          for (let index = 0; index < td_totais.length; index++) {
              const entregas = parseInt(td_entregas[index].innerHTML) || 0;
              const trocas = parseInt(td_trocas[index].innerHTML) || 0;
              const retiradas = parseInt(td_retiradas[index].innerHTML) || 0;
              const total = entregas + trocas + retiradas;

              td_totais[index].innerHTML = total; // Preenche o total na coluna

              if (!parseInt(td_totais[index].innerHTML)) {
                  td_totais[index].parentElement.style.display = 'none'

              }
          }

          // Calcular os totais gerais para a última linha
          for (let index = 0; index < td_entregas.length; index++) {
              val_entregas += parseInt(td_entregas[index].innerHTML) || 0;
          }
          for (let index = 0; index < td_trocas.length; index++) {
              val_trocas += parseInt(td_trocas[index].innerHTML) || 0;
          }
          for (let index = 0; index < td_retiradas.length; index++) {
              val_retiradas += parseInt(td_retiradas[index].innerHTML) || 0;
          }
          for (let index = 0; index < td_totais.length; index++) {
              val_totais += parseInt(td_totais[index].innerHTML) || 0;
          }




          // Atualizar a última linha com os totais
          document.getElementById("td_Tentregas").innerHTML = val_entregas;
          document.getElementById("td_Ttrocas").innerHTML = val_trocas;
          document.getElementById("td_Tretiradas").innerHTML = val_retiradas;
          document.getElementById("td_TTotais").innerHTML = val_totais;
      }

      function editar(btn_editar) {
          const userConfirmed = confirm("Deseja realmente alterar o serviço já entregue/retirado?");
          var card = btn_editar.parentElement;
          var form_edit = card.getElementsByClassName('alteracao')[0];
          console.log(card);
          if (userConfirmed) {
              form_edit.style.display = 'flex';
              btn_editar.style.display = 'none';
          } else {

          }



      }

      function alterar(btn_editar) {
          const userConfirmed = confirm("Deseja realmente reverter o serviço já entregue/retirado?");
          if (userConfirmed) {

              btn_editar.type = 'submit';
          } else {

          }



      }




      function multi_baixa(btn_enviarAll) {
          var IDs_select = [];
          var cacamba_aterro = [];
          var _tipo_c = [];


          var coluna_moto = btn_enviarAll.parentElement.parentElement.parentElement.parentElement
          var cards_coluna = coluna_moto.getElementsByClassName('Card');


          for (let i = 0; i < cards_coluna.length; i++) {
              const card = cards_coluna[i];
              if (card.getElementsByClassName('num_cacamba').length) {
                  if (card.getElementsByClassName('num_cacamba')[0].value != "") {
                      IDs_select.push(card.getElementsByClassName('num_ped')[0].innerHTML)
                      cacamba_aterro.push(card.getElementsByClassName('num_cacamba')[0].value)
                      _tipo_c.push(card.getElementsByClassName('tipo_c')[0].value)
                  }
              } else if (card.getElementsByClassName('nome_aterro').length) {
                  if (card.getElementsByClassName('nome_aterro')[0].value != "") {
                      IDs_select.push(card.getElementsByClassName('num_ped')[0].innerHTML)
                      cacamba_aterro.push(card.getElementsByClassName('nome_aterro')[0].value)
                  }
              }

          }
          console.log(IDs_select);
          console.log(cacamba_aterro);

          coluna_moto.getElementsByClassName('ids_card')[0].value = IDs_select
          coluna_moto.getElementsByClassName('cacambas_aterros')[0].value = cacamba_aterro
          coluna_moto.getElementsByClassName('inp_tipo_c')[0].value = _tipo_c


          btn_enviarAll.type = 'submit';

      }



      function noAcessEdit() {
          var no_edit = document.getElementsByClassName("no_edit");
          for (let i = 0; i < no_edit.length; i++) {
              const element = no_edit[i];
              element.style.display = 'none'

          }
      }

      function acess() {

          let acesso = "<?php echo $_SESSION['ACESSO']; ?>";
          let radio_se = document.getElementsByClassName('select_se');

          if (acesso != "ADMIN" && acesso != "USER") {

              for (let i = 0; i < radio_se.length; i++) {
                  const servicos = radio_se[i];
                  if (servicos.name != acesso) {
                      servicos.parentElement.remove()
                  }
              }
          }
      }
  </script>


  <body>
      <div class="Box-Dashbord">
          <div class="Conteudo-Dashbord">
              <?php include('reload.php'); ?>
              <?php




                $C_D_I_F1 =  mysqli_query($conexao, "select * from consulta where entrega <> '' and tabela = 'servico'") or die($mysqli_error);

                while ($arquivos1 = $C_D_I_F1->fetch_assoc()) {

                    $im = $arquivos1['entrega'];

                    $Q = "SELECT * FROM `consulta` WHERE entrega <> '' and tabela = 'servico' ";

                    $R = mysqli_query($conexao, $Q);

                    $row11 = mysqli_num_rows($R);

                    $hoje = date('Y,m,d');
                }


                // $pedidos_aberto = mysqli_query($conexao, "select  motorista,aterro,status,tipo_os,data_entrega,data_retirada,Endereco,numero,complemento,(select num_pedido from base_os a where  data_retirada = '$im' and a.num_pedido = x.num_pedido and a.motorista = x.motorista and a.codigo_cliente = x.codigo_cliente)as Ped_ret,(select obs from base_os b where b.num_pedido = x.num_pedido and b.motorista = x.motorista and (data_entrega = '$im' or data_retirada = '$im') and b.codigo_cliente = x.codigo_cliente) as comentario,(select num_pedido from base_os c where  c.num_pedido = x.num_pedido and c.motorista = x.motorista and data_entrega = '$im'  and c.codigo_cliente = x.codigo_cliente and (status = 'Entregar' or status = 'entregue') ) as Ped_ENT from base_os x where  (data_entrega = '$im' or  (data_retirada = '$im' and status <> 'Entregue') )  GROUP BY motorista order by Endereco,troca") or die($mysqli_error);                
                $pedidos_aberto = mysqli_query($conexao, "select * from base_os where data_entrega = '$im' OR data_retirada = '$im' group by motorista;") or die($mysqli_error);


                $aterross =  mysqli_query($conexao, "select * from base_aterro order by nome_aterro") or die($mysqli_error);


                ?>

              <a href="logout.php" style="display: none;" id="sair_m"><button>&nbsp;sair& ;&nbsp;</button></a>
              <div class="tabela-resumo">

                  <h1 class="h1_title">Motorista Serviços:</h1>
                  <div class="mydict no_motorista">
                      <div class="mydict_div_servic">
                          <label id="se_MUNDIAL">
                              <input type="radio" class="select_se" name="MUNDIAL" onclick="window.location.href='form_m_servicos_NEW.php'"
                                  <?php
                                    if (!isset($_GET['se_FORMIGA'])) {
                                        echo "checked";
                                    } elseif ($_SESSION['ACESSO']) ?>>
                              <span>YSTRATEGY</span>
                          </label>

                          <label>
                              <input type="radio" class="select_se" name="FORMIGA" onclick="window.location.href='form_m_servicos_NEW.php?se_FORMIGA'"
                                  <?php
                                    if (isset($_GET['se_FORMIGA'])) {
                                        echo "checked";
                                    } ?>>
                              <span>OUTROS</span>
                          </label>
                      </div>

                  </div>

                  <div class="calendario-servico no-print">

                      <form action="data_consulta_servico.php?form_m_servicos" method="post">

                          <h2>Ecolher data:</h2>
                          <div class="inputGroup">
                              <input size="45" minlength="0" maxlength="45" type="date" name="d_inicio" id="d_inicio" value='<?php echo $im ?>' placeholder="">
                              <button input type="submit" name="acao">&nbsp;&nbsp;&nbsp;Confirmar data&nbsp;&nbsp;&nbsp;</button>
                          </div>


                      </form>
                  </div>
                  <br>

                  <table id="tabela-resumo">



                      <thead>



                          <tr>

                              <th>Motorista</th>

                              <th>&nbsp;ENTREGAS&nbsp;</th>

                              <th>&nbsp;TROCAS&nbsp;</th>

                              <th>&nbsp;RETIRADAS&nbsp;</th>

                              <th>&nbsp;Total&nbsp;</th>

                          </tr>

                      </thead>

                      <tbody>

                          <?php


                            $e_a_p_m =  mysqli_query($conexao, "
                        SELECT 
                        motorista,
                   
                        COUNT(CASE 
                                WHEN (status = 'Entregar' OR status = 'Entregue') 
                                AND tipo_os <> 'Troca' 
                                AND data_entrega = '$im' 
                                THEN 1 END) AS Entregar,

    
                                (SELECT 

                        COUNT(CASE 
                                WHEN (status = 'Retirar' OR status = 'Retirado') 
                                AND data_retirada = '$im'   
                                THEN 1 END) 
                        - COUNT(CASE 
                               WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
                                AND (tipo_os = 'Troca' OR troca != '')
                                AND (data_entrega = '$im' OR data_retirada ='$im')
                                AND (Motorista_retirada = b.motorista AND b.data_retirada = '$im') 
                                THEN 1 END)

                    FROM base_os b
                    WHERE b.Motorista_retirada = a.motorista) AS Retirar,

                        (SELECT 
                           COUNT(CASE 
                                WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
                                AND (tipo_os = 'Troca' OR troca != '')
                                AND (data_entrega = '$im' OR data_retirada ='$im')
                                AND (Motorista_retirada = b.motorista AND b.data_retirada = '$im') 
                                THEN 1 END)
                        FROM base_os b
                        WHERE b.Motorista_retirada = a.motorista) AS Trocar,

                        
                        (COUNT(CASE 
                                WHEN (status = 'Entregar' OR status = 'Entregue') 
                                AND tipo_os <> 'Troca' 
                                AND data_entrega = '$im' 
                                THEN 1 END) +
                        COUNT(CASE 
                                WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
                                AND tipo_os = 'Troca' 
                                AND data_entrega = '$im'
                                THEN 1 END) +
                        COUNT(CASE 
                                WHEN (status = 'Retirar' OR status = 'Retirado') 
                                AND tipo_os <> 'Troca'
                                AND data_retirada = '$im' 
                                THEN 1 END) 
                        - COUNT(CASE 
                                WHEN (status = 'Retirar' OR status = 'Retirado') 
                                AND (confirm_troca = '1' OR tipo_os = 'Troca')
                                AND data_entrega = '$im'
                                THEN 1 END)) AS Total
                    FROM base_os a
                    GROUP BY motorista;



                    ") or die($mysqli_error);


                            while ($peds = $e_a_p_m->fetch_assoc()) {

                                $n = explode(' ', $peds['motorista']);
                                $pN = $n[0]; // 'Carlos'

                            ?>

                              <tr class="motorista_tr">
                                  <td><?php echo $pN; ?></td>

                                  <td class="td_entregas"><?php echo $peds['Entregar']; ?></td>

                                  <td class="td_trocas"><?php echo $peds['Trocar']; ?></td>

                                  <td class="td_retiradas"><?php echo $peds['Retirar']; ?></td>

                                  <td class="td_totais"></td>
                              </tr>

                          <?php } ?>

                          <tr id="tr_totais" style="font-weight: bold;">
                              <td>TOTAIS:</td>
                              <td id="td_Tentregas"></td>
                              <td id="td_Ttrocas"></td>
                              <td id="td_Tretiradas"></td>
                              <td id="td_TTotais"></td>

                          </tr>



                      </tbody>

                  </table>

              </div>







              <div class="legenda no-print">
                  <div class="topico" style="color:#485468">
                      Colocações:&nbsp;&nbsp;<div class="topico-C"></div>
                  </div>
                  &nbsp;&nbsp;&nbsp;
                  <div class="topico" style="color:#882b2b">
                      Retiradas: &nbsp;&nbsp;<div class="topico-R"></div>
                  </div>
                  &nbsp;&nbsp;&nbsp;
                  <div class="topico" style="color:#b3940c">
                      Trocas(Retirar/Colocar): &nbsp;&nbsp;<div class="topico-TR"></div>
                  </div>
                  &nbsp;&nbsp;&nbsp;
                  <div class="topico" style="color:#278327">
                      Serviço Ok: &nbsp;&nbsp;<div class="topico-OK"></div>
                  </div>

              </div>
              <br>


              <div class="quadro">



                  <?php



                    while ($pedido = $pedidos_aberto->fetch_assoc()) {

                        $motorista = $pedido['motorista'];



                    ?>



                      <div class="tabela-resumo1">

                          <br>
                          <table class="tabela-resumo-motorista" cellpadding="15">
                              <div class="hr"></div>

                              <td class="no-print no_edit">
                                  <form action="cm_all.php" method="post">
                                      <input type="text" class="ids_card" name="ids_card" style="display: none">
                                      <input type="text" class="cacambas_aterros" name="cacambas_aterros" style="display: none">
                                      <input type="text" class="inp_tipo_c" name="inp_tipo_c" style="display: none">

                                      <button type="button" onclick="multi_baixa(this)">Enviar Todos Campos Preenchidos</button>
                                  </form>

                              </td>
                              <tr>

                                  <th><?php echo $motorista ?></th>




                                  <?php

                                    if (isset($_GET['se_FORMIGA']) && !isset($_SESSION['motorista'])) {
                                        $tipo_servico_filtro = "(tipo_servico='FORMIGA' OR tipo_servico='AMBOS')";
                                    } elseif (isset($_SESSION['usuario']) && !isset($_SESSION['motorista'])) {
                                        $tipo_servico_filtro = "(tipo_servico='MUNDIAL' OR tipo_servico='AMBOS' OR tipo_servico IS NULL)";
                                    } else {
                                        $tipo_servico_filtro =  "1=1";
                                    }
                                    // $tipo_servico_filtro = isset($_GET['se_FORMIGA']) ? "(tipo_servico='FORMIGA' OR tipo_servico='AMBOS')" : "(tipo_servico='MUNDIAL' OR tipo_servico='AMBOS' OR tipo_servico IS NULL)";

                                    $pedido_aberto = mysqli_query($conexao, "select motorista,status,aterro,tipo_os,data_entrega,data_retirada,nome_cliente,Endereco,numero,complemento,cacamba,(select num_pedido from base_os a where a.num_pedido = x.num_pedido and a.motorista = x.motorista and  data_retirada = '$im' and a.codigo_cliente = x.codigo_cliente and (status = 'Retirar' or status = 'retirado')) as Ped_ret,(select troca from base_os d where d.num_pedido = x.num_pedido and d.motorista = x.motorista and  (data_retirada = '$im' or data_entrega = '$im')  and d.codigo_cliente = x.codigo_cliente ) as troca,(select obs from base_os b where b.num_pedido = x.num_pedido and (data_entrega = '$im' or data_retirada = '$im') and b.motorista = x.motorista and b.codigo_cliente = x.codigo_cliente) as comentario,(select num_pedido from base_os c where  c.num_pedido = x.num_pedido and c.motorista = x.motorista and data_entrega = '$im' and c.codigo_cliente = x.codigo_cliente and (status = 'Entregar' or status = 'Entregue') ) as Ped_ENT from base_os x where (data_entrega = '$im' or  (data_retirada = '$im' and status <> 'Entregue') ) and motorista = '$motorista' AND $tipo_servico_filtro GROUP BY motorista,Endereco,num_pedido,troca ") or die($mysqli_error);




                                    $pedido_aberto = mysqli_query($conexao, "select motorista,status,aterro,tipo_os,data_entrega,data_retirada,nome_cliente,Endereco,numero,complemento,cacamba,(select num_pedido from base_os a where a.num_pedido = x.num_pedido and a.motorista = x.motorista and  data_retirada = '$im' and a.codigo_cliente = x.codigo_cliente and (status = 'Retirar' or status = 'retirado')) as Ped_ret,(select troca from base_os d where d.num_pedido = x.num_pedido and d.motorista = x.motorista and  (data_retirada = '$im' or data_entrega = '$im')  and d.codigo_cliente = x.codigo_cliente ) as troca,(select obs from base_os b where b.num_pedido = x.num_pedido and (data_entrega = '$im' or data_retirada = '$im') and b.motorista = x.motorista and b.codigo_cliente = x.codigo_cliente) as comentario,(select num_pedido from base_os c where  c.num_pedido = x.num_pedido and c.motorista = x.motorista and data_entrega = '$im' and c.codigo_cliente = x.codigo_cliente and (status = 'Entregar' or status = 'Entregue') ) as Ped_ENT from base_os x where (data_entrega = '$im' or  (data_retirada = '$im' and status <> 'Entregue') ) and motorista = '$motorista' AND $tipo_servico_filtro GROUP BY motorista,Endereco,num_pedido,troca ") or die($mysqli_error);



                                    while ($peds = $pedido_aberto->fetch_assoc()) {

                                        $n = explode(' ', $peds['motorista']);

                                        $pN = $n[0]; // 'Carlos'

                                    ?>

                              </tr>



                              <tr>

                                  <td class="Card">
                                      <?php
                                        $base_os_Allselect = mysqli_query($conexao, "SELECT * FROM base_os where num_pedido = '" . $peds['Ped_ENT'] . "'");
                                        $base_osDados = $base_os_Allselect->fetch_assoc();
                                        // cards entregas:  entrege Verde, entregar Cinza/azul normal,  Entregar TROCA Amarelo/tbm (retirar Troca) ------------------ 
                                        if ($peds['Ped_ENT']) {
                                            // echo '-------' . $peds['troca'] . '---------' . $peds['tipo_os'] . '-------------' . $peds['status'] . '--------------------' . $peds['Ped_ENT'] .'----------- '.$base_osDados['confirm_troca'];
                                            // && $peds['status'] != 'Entregar'
                                            if ($peds['status'] != 'Retirado' && $peds['status'] != 'Entregar') { ?>

                                              <div class="servico_OK card_entregue">



                                                  <h3 class="h3_ok"><b style="color: #e72727;"><?php echo $peds['status']; ?></b> -&nbsp;&nbsp;CAÇAMBA:&nbsp;&nbsp;<?php echo $peds['cacamba']; ?>
                                                      &nbsp;✓&nbsp;OK</h3><br>


                                                  <div class="conteudo_card">
                                                      <?php echo $peds['nome_cliente']; ?>
                                                      <br>
                                                      <br>
                                                      Endereço&nbsp;:

                                                      &nbsp;&nbsp;<?php echo $peds['Endereco']; ?>&nbsp;&nbsp;Nº&nbsp;:

                                                      &nbsp;&nbsp;<?php echo $peds['numero']; ?>
                                                      <br>
                                                      Bairro&nbsp;: <?php echo $base_osDados['bairro']; ?>&nbsp;--&nbsp;
                                                      <?php echo $peds['complemento']; ?>
                                                      <br>
                                                      <br>


                                                      Comentario&nbsp;:&nbsp;&nbsp;
                                                      <?php echo $peds['comentario']; ?>&nbsp;&nbsp;&nbsp;

                                                      <br>

                                                      Data de Entrega&nbsp;:&nbsp;

                                                      &nbsp;<?php $dataEntrega = new DateTime($peds['data_entrega']);
                                                            echo $dataEntrega->format('d/m/Y')
                                                            ?>&nbsp;&nbsp;&nbsp;

                                                      <br>

                                                      Numero do Pedido&nbsp;:

                                                      &nbsp;&nbsp; <span class="num_ped"><?php echo $peds['Ped_ENT']; ?></span><br>
                                                      Tipo Caçamba&nbsp;:

                                                      <?php echo $base_osDados['tipo_cacamba']; ?>
                                                      <br>
                                                      <div onclick="editar(this)" class="no_edit">
                                                          <br>

                                                          <button input type="button" name="acao">EDITAR</button>

                                                          <br>
                                                      </div>
                                                      <br>
                                                      <div class="alteracao" id="alteracao">
                                                          <form action="cmc.php?update3=<?PHP echo $peds['Ped_ENT'] ?>" method="post">

                                                              Inserir o Novo Numero da Caçamba<br><br>

                                                              <input type="text" name="six" size="3" class="num_cacamba">

                                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                              <br>
                                                              <br>

                                                              <div class="inputGroup">
                                                                  <p class="label_select">Tipo da Caçamba</p>
                                                                  <select name="tipo_c" class="tipo_c" required>
                                                                      <option value=""></option>
                                                                      <option value='MUNDIAL'>MUNDIAL</option>
                                                                      <option value='FORMIGA'>FORMIGA</option>
                                                                  </select>
                                                              </div>
                                                              <br>
                                                              <button input type="submit" name="acao"> SALVAR</button>
                                                          </form>

                                                          <form action="reverse_servico.php" method="post">
                                                              <input type="text" name="id" value="<?PHP echo $base_osDados['num_pedido'] ?>" style="display:none">
                                                              <input type="text" name="tipo" value="<?PHP echo $peds['tipo_os'] ?>" style="display:none">
                                                              <input type="text" name="c_r" value="c" style="display:none">
                                                              <button type="button" onclick="alterar(this)">REVERTER SERVIÇO</button>
                                                          </form>

                                                      </div>
                                                  </div>


                                              </div>

                                              <?php

                                            } else {

                                                if ($peds['troca']) { ?>

                                                  <div class="card_trocas Ctroca">

                                                      <h3 class="h3_trocas"> <span class="aviso_troca">TROCA &nbsp;</span> (<b style="color: rgb(183, 0, 0);;"> Colocação </b>Caçamba) &nbsp;: &nbsp; <?php echo $peds['Endereco']; ?>, &nbsp;<?php echo $peds['numero']; ?></h3>

                                                      <br>
                                                      <div class="conteudo_card">
                                                          <?php echo $peds['nome_cliente']; ?>
                                                          <br>
                                                          <br>
                                                          Endereço&nbsp;:

                                                          &nbsp;&nbsp;<?php echo $peds['Endereco']; ?>&nbsp;&nbsp;Nº :

                                                          <?php echo $peds['numero']; ?>

                                                          <br>
                                                          Bairro&nbsp;: <?php echo $base_osDados['bairro']; ?>&nbsp;--&nbsp;
                                                          <?php echo $peds['complemento']; ?>

                                                          <br>
                                                          <br>


                                                          Comentario&nbsp;:&nbsp;&nbsp;
                                                          <?php echo $peds['comentario']; ?>&nbsp;&nbsp;&nbsp;

                                                          <br>

                                                          Data de Entrega&nbsp;:

                                                          &nbsp;<?php $dataEntrega = new DateTime($peds['data_entrega']);
                                                                echo $dataEntrega->format('d/m/Y')
                                                                ?>&nbsp;&nbsp;&nbsp;
                                                          <br>
                                                          Numero do Pedido&nbsp;:



                                                          &nbsp;&nbsp;<span class="num_ped"><?php echo $peds['Ped_ENT']; ?></span><br>


                                                          Troca do Pedido&nbsp;:

                                                          &nbsp;&nbsp;<span class="num_ped"><?php echo $peds['troca']; ?> </span><br>

                                                          <br>



                                                          <form action="cmc.php?update3=<?PHP echo $peds['Ped_ENT'] ?>" method="post" class="no-print no_edit">

                                                              Inserir o Numero da Caçamba<br><br>

                                                              <input type="text" name="six" size="3" class="num_cacamba">

                                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                              <br>
                                                              <br>

                                                              <div class="inputGroup">
                                                                  <p class="label_select">Tipo da Caçamba</p>
                                                                  <select name="tipo_c" class='tipo_c' required>
                                                                      <option value=""></option>
                                                                      <option value='MUNDIAL'>MUNDIAL</option>
                                                                      <option value='FORMIGA'>FORMIGA</option>
                                                                  </select>
                                                              </div>
                                                              <br>
                                                              <button input type="submit" name="acao">COLOCAR</button>

                                                              <span class="no-print"> <br><br> </span>

                                                          </form>
                                                      </div>

                                                  <?php } else {

                                                    ?>
                                                      <div class="card_colocacao">
                                                          <h3 class="h3_colocacao">Colocação :&nbsp;<?php echo $peds['Endereco']; ?>, &nbsp;<?php echo $peds['numero']; ?></h3>


                                                          <br>
                                                          <div class="conteudo_card">
                                                              <?php echo $peds['nome_cliente']; ?>
                                                              <br>
                                                              <br>
                                                              Endereço&nbsp;:

                                                              &nbsp;&nbsp;<?php echo $peds['Endereco']; ?>&nbsp;&nbsp;Nº :

                                                              <?php echo $peds['numero']; ?>

                                                              <br>
                                                              Bairro&nbsp;: <?php echo $base_osDados['bairro']; ?>&nbsp;--&nbsp;
                                                              <?php echo $peds['complemento']; ?>
                                                              <br>
                                                              <br>


                                                              Comentario&nbsp;:&nbsp;&nbsp;
                                                              <?php echo $peds['comentario']; ?>&nbsp;&nbsp;&nbsp;

                                                              <br>

                                                              Data de Entrega&nbsp;:

                                                              &nbsp;<?php $dataEntrega = new DateTime($peds['data_entrega']);
                                                                    echo $dataEntrega->format('d/m/Y')
                                                                    ?>&nbsp;&nbsp;&nbsp;
                                                              <br>
                                                              Numero do Pedido&nbsp;:



                                                              &nbsp;&nbsp;<span class="num_ped"><?php echo $peds['Ped_ENT']; ?></span><br>

                                                              Tipo Serviço&nbsp;:
                                                              &nbsp;&nbsp;<span class="tipo_se"><?php echo $base_osDados['tipo_servico']; ?> </span><br>

                                                              <br>



                                                              <form action="cmc.php?update3=<?PHP echo $peds['Ped_ENT'] ?>" method="post" class="no-print no_edit">

                                                                  Inserir o Numero da Caçamba<br><br>

                                                                  <input type="text" name="six" size="3" class="num_cacamba">

                                                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                  <br>
                                                                  <br>

                                                                  <div class="inputGroup">
                                                                      <p class="label_select">Tipo da Caçamba</p>
                                                                      <select name="tipo_c" class="tipo_c" required>
                                                                          <option value=""></option>
                                                                          <option value='MUNDIAL'>MUNDIAL</option>
                                                                          <option value='FORMIGA'>FORMIGA</option>
                                                                      </select>
                                                                  </div>
                                                                  <br>
                                                                  <button input type="submit" name="acao">COLOCAR</button>

                                                                  <br><br>

                                                              </form>
                                                          </div>
                                                      </div>

                                                  <?php } ?>

                                          <?php


                                            }
                                        } ?>


                                          <?php

                                            if ($peds['Ped_ret']) {
                                                $base_os_Allselect = mysqli_query($conexao, "SELECT * FROM base_os where num_pedido = '" . $peds['Ped_ret'] . "'");
                                                $base_osDados = $base_os_Allselect->fetch_assoc();

                                                // echo '-------' . $peds['troca'] . '---------' . $peds['tipo_os'] . '-------------' . $peds['status'] . '--------------------' . $peds['Ped_ret'].'---------'. $base_osDados['confirm_troca'];

                                                if ($peds['status'] == 'Retirado' || $peds['status'] == 'Entregar') { ?>



                                                  <div class="servico_OK card_retirado">
                                                      <h3 class="h3_ok"><b style="color: #e72727;"><?php echo $peds['status']; ?></b> -&nbsp;&nbsp;ATERRO:&nbsp;&nbsp;<?php echo $peds['aterro']; ?> &nbsp;&nbsp;
                                                          ✓&nbsp;OK</h3><br>

                                                      <div class="conteudo_card">
                                                          <?php echo $peds['nome_cliente']; ?>
                                                          <br>
                                                          <br>
                                                          Endereço&nbsp;:

                                                          &nbsp;&nbsp;<?php echo $peds['Endereco']; ?>&nbsp;&nbsp;Nº&nbsp;:

                                                          &nbsp;&nbsp;<?php echo $peds['numero']; ?><br>
                                                          Bairro&nbsp;: <?php echo $base_osDados['bairro']; ?>&nbsp;--&nbsp;
                                                          <?php echo $peds['complemento']; ?>



                                                          <br>
                                                          <br>


                                                          Comentario&nbsp;:&nbsp;&nbsp;
                                                          <?php echo $peds['comentario']; ?>&nbsp;&nbsp;&nbsp;

                                                          <br>



                                                          Data de Retirada&nbsp;:

                                                          &nbsp;<?php $dataRetirar = new DateTime($peds['data_retirada']);
                                                                echo $dataRetirar->format('d/m/Y')
                                                                ?>&nbsp;&nbsp;&nbsp;
                                                          <br>

                                                          Numero do Pedido&nbsp;:

                                                          <span class="num_ped"><?php echo $peds['Ped_ret']; ?></span><br>

                                                          Caçamba&nbsp;:

                                                          <?php echo $peds['cacamba']; ?><br>
                                                          Tipo Caçamba&nbsp;:

                                                          <?php echo $base_osDados['tipo_cacamba']; ?>

                                                          <div onclick="editar(this)" class="no-print no_edit">
                                                              <br>

                                                              <button input type="button" name="acao">EDITAR</button>

                                                              <br>
                                                          </div>
                                                          <br>
                                                          <br>
                                                          <div class="alteracao" id="alteracao" style="display: none;">
                                                              <div>
                                                                  <form action="cmcr.php?update3=<?PHP echo $peds['Ped_ret'] ?>" method="post">
                                                                      Inserir o Novo Aterro da Caçamba Retirada<br><br>

                                                                      <label>Aterro</label>

                                                                      <select id="aterro" name="aterro" class="nome_aterro">
                                                                          <option value=""></option>

                                                                          <?php
                                                                            mysqli_data_seek($aterross, 0);

                                                                            while ($p_aterros = $aterross->fetch_assoc()) { ?>

                                                                              <option value='<?php echo $p_aterros['Nome_aterro']; ?>'>

                                                                                  <?php echo $p_aterros['Nome_aterro']; ?></option>

                                                                          <?php } ?>

                                                                      </select>




                                                                      <button input type="submit" name="acao">SALVAR</button>
                                                                  </form>
                                                              </div>
                                                              <form action="reverse_servico.php" method="post">
                                                                  <input type="text" name="id" value="<?PHP echo $base_osDados['num_pedido'] ?>" style="display:none">
                                                                  <input type="text" name="tipo" value="<?PHP echo $peds['tipo_os'] ?>" style="display:none">
                                                                  <input type="text" name="c_r" value="r" style="display:none">
                                                                  <button type="button" onclick="alterar(this)">REVERTER SERVIÇO</button>
                                                              </form>

                                                          </div>
                                                      </div>
                                                  </div>

                                                  <?php

                                                } else {

                                                    if ($peds['troca'] && $peds['tipo_os'] == 'Colocacao' && $peds['status'] == 'Retirar' || $peds['troca'] && $peds['status'] == 'Retirar' && $base_osDados['confirm_troca'] == 1) {
                                                    ?>

                                                      <div class="card_trocas Rtroca">
                                                          <h3 class="h3_trocas"> <span class="aviso_troca">TROCA&nbsp;</span> (<b style="color: rgb(183, 0, 0);;">Retirada</b> Caçamba) &nbsp;:&nbsp;<?php echo $peds['Endereco']; ?>, &nbsp;<?php echo $peds['numero']; ?></h3>
                                                          <br>

                                                          <div class="conteudo_card">
                                                              <?php echo $peds['nome_cliente']; ?>
                                                              <br>
                                                              <br>
                                                              Endereço&nbsp;:

                                                              &nbsp;&nbsp;<?php echo $peds['Endereco']; ?>&nbsp;&nbsp;Nº&nbsp;:

                                                              &nbsp;&nbsp;<?php echo $peds['numero']; ?><br>
                                                              Bairro&nbsp;: <?php echo $base_osDados['bairro']; ?>&nbsp;--&nbsp;
                                                              <?php echo $peds['complemento']; ?>
                                                              <br>
                                                              <br>


                                                              Comentario&nbsp;:&nbsp;&nbsp;
                                                              <?php echo $peds['comentario']; ?>&nbsp;&nbsp;&nbsp;

                                                              <br>



                                                              Data de Retirada&nbsp;:

                                                              &nbsp;<?php $dataRetirar = new DateTime($peds['data_retirada']);
                                                                    echo $dataRetirar->format('d/m/Y')
                                                                    ?>&nbsp;&nbsp;&nbsp;
                                                              <br>

                                                              Numero do Pedido&nbsp;:

                                                              <span class="num_ped"><?php echo $peds['Ped_ret']; ?></span><br>

                                                              Caçamba&nbsp;:

                                                              <?php echo $peds['cacamba']; ?><br> <br>
                                                              <form action="cmcr.php?update3=<?PHP echo $peds['Ped_ret'] ?>" method="post" class="no_edit">

                                                                  <span class="no-print">Inserir o Aterro da Caçamba Retirada<br><br></span>

                                                                  <label class="no-print">Aterro</label>

                                                                  <select id="aterro" name="aterro" class="nome_aterro no-print">



                                                                      <option value=""></option>

                                                                      <?php



                                                                        mysqli_data_seek($aterross, 0);

                                                                        while ($p_aterros = $aterross->fetch_assoc()) { ?>

                                                                          <option value='<?php echo $p_aterros['Nome_aterro']; ?>'>

                                                                              <?php echo $p_aterros['Nome_aterro']; ?></option>

                                                                      <?php } ?>

                                                                  </select>



                                                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                  <button input type="submit" class="no-print" name="acao">RETIRAR</button>


                                                                  <span class="no-print"> <br><br> </span>
                                                              </form>
                                                          </div>
                                                      </div>
                                                  <?php } else if ($peds['troca'] == "" && $peds['tipo_os'] == 'Colocacao' && $peds['status'] == 'Retirar' || $peds['troca'] && $peds['tipo_os'] == 'Troca' && $peds['status'] == 'Retirar' && $base_osDados['confirm_troca'] == 0) { ?>


                                                      <div class="card_retirar">

                                                          <h3 class="h3_retirar">Retirada :&nbsp;&nbsp;<?php echo $peds['Endereco']; ?>, &nbsp;<?php echo $peds['numero']; ?></h3>
                                                          <br>
                                                          <div class="conteudo_card">
                                                              <?php echo $peds['nome_cliente']; ?>
                                                              <br>
                                                              <br>

                                                              Endereço&nbsp;:

                                                              &nbsp;&nbsp;<?php echo $peds['Endereco']; ?>&nbsp;&nbsp;Nº&nbsp;:

                                                              &nbsp;&nbsp;<?php echo $peds['numero']; ?><br>

                                                              Bairro&nbsp;: <?php echo $base_osDados['bairro']; ?>&nbsp;--&nbsp;
                                                              <?php echo $peds['complemento']; ?>
                                                              <br>
                                                              <br>


                                                              Comentario&nbsp;:&nbsp;&nbsp;
                                                              <?php echo $peds['comentario']; ?>&nbsp;&nbsp;&nbsp;

                                                              <br>



                                                              Data de Retirada&nbsp;:&nbsp;&nbsp;

                                                              &nbsp;<?php $dataRetirar = new DateTime($peds['data_retirada']);
                                                                    echo $dataRetirar->format('d/m/Y')
                                                                    ?>&nbsp;&nbsp;&nbsp;
                                                              <br>

                                                              Numero do Pedido&nbsp;:

                                                              <span class="num_ped"><?php echo $peds['Ped_ret']; ?></span><br>

                                                              Caçamba&nbsp;:

                                                              <?php echo $peds['cacamba']; ?><br> <br>

                                                              <form action="cmcr.php?update3=<?PHP echo $peds['Ped_ret'] ?>" method="post" class="no_edit">
                                                                  <span class="no-print">Inserir o Aterro da Caçamba Retirada<br><br></span>

                                                                  <label class="no-print">Aterro</label>

                                                                  <select id="aterro" name="aterro" class="nome_aterro no-print">



                                                                      <option value=""></option>

                                                                      <?php



                                                                        mysqli_data_seek($aterross, 0);

                                                                        while ($p_aterros = $aterross->fetch_assoc()) { ?>

                                                                          <option value='<?php echo $p_aterros['Nome_aterro']; ?>'>

                                                                              <?php echo $p_aterros['Nome_aterro']; ?></option>

                                                                      <?php } ?>

                                                                  </select>



                                                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                                  <button input type="submit" name="acao" class="no-print">RETIRAR</button>

                                                                  <span class="no-print"> <br><br> </span>
                                                              </form>
                                                          </div>

                                                      </div>

                                          <?php   }
                                                }
                                            } ?>

                                  </td>

                              </tr>









                          <?php
                                    } ?>







                          </table>



                      </div>

                  <?php }
                    include('rodape.php');
                    echo "<script>";
                    echo "totais_Tresumo();";
                    echo "</script>";

                    if (isset($_SESSION['motorista'])) {
                        echo "<script>";
                        echo "filtro_m_servicos('" . $_SESSION['motorista'] . "');";
                        echo "noAcessMenu()";
                        echo "</script>";
                    } else {
                        echo "<script>";
                        echo "acess();";
                        echo "</script>";
                    }

                    if (isset($_SESSION['acao']) && $_SESSION['acao'] == 'Observador') {
                        echo "<script>";
                        echo "noAcessEdit();";
                        echo "</script>";
                    }


                    ?>


              </div>
          </div>


      </div>

  </body>



  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js">



  </script>

  </html>