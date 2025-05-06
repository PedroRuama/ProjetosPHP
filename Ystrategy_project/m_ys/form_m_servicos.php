<div id="div_menu">
      <?php

        include('menu.php');

        ?>
  </div>
  <?php

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



    ?>
  <br>
  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css\servicos_m.css">
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
          document.getElementById("div_menu").style.display = 'none'
          document.getElementById("tr_totais").style.display = 'none'
          document.getElementById("sair_m").style.display = 'block'
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
          var td_entregas = document.getElementsByClassName("td_entregas")
          var td_trocas = document.getElementsByClassName("td_trocas")
          var td_retiradas = document.getElementsByClassName("td_retiradas")
          var td_totais = document.getElementsByClassName("td_totais")
          var val_entregas = 0
          var val_trocas = 0
          var val_retiradas = 0
          var val_totais = 0

          for (let index = 0; index < td_entregas.length; index++) {
              const TD_ENT = td_entregas[index];
              val_entregas += parseInt(TD_ENT.innerHTML)
          }
          for (let index = 0; index < td_trocas.length; index++) {
              const TD_TRO = td_trocas[index];
              val_trocas += parseInt(TD_TRO.innerHTML)
          }
          for (let index = 0; index < td_retiradas.length; index++) {
              const TD_RET = td_retiradas[index];
              val_retiradas += parseInt(TD_RET.innerHTML)
          }
          for (let index = 0; index < td_totais.length; index++) {
              const TD_TOT = td_totais[index];
              val_totais += parseInt(TD_TOT.innerHTML)
          }
          document.getElementById("td_Tentregas").innerHTML = val_entregas
          document.getElementById("td_Ttrocas").innerHTML = val_trocas
          document.getElementById("td_Tretiradas").innerHTML = val_retiradas
          document.getElementById("td_TTotais").innerHTML = val_totais
      }

      function editar(btn_editar) {
          const userConfirmed = confirm("Deseja realmente alterar o serviço já entregue/retirado?");
          var card = btn_editar.parentElement;
          var form_edit = card.getElementsByClassName('alteracao')[0];
          console.log(card);
          if (userConfirmed) {

              form_edit.style.display = 'block';
              btn_editar.style.display = 'none';
          } else {

          }



      }
  </script>





  <body>

      <?php


        $sql_c_motorista =  mysqli_query($conexao, "select * from base_aterro order by nome_aterro") or die($mysqli_error);

        $C_D_I_F1 =  mysqli_query($conexao, "select * from consulta where entrega <> '' and tabela = 'servico' and usuario = '$user'") or die($mysqli_error);

        while ($arquivos1 = $C_D_I_F1->fetch_assoc()) {

            $im = $arquivos1['entrega'];

            $Q = "SELECT * FROM `consulta` WHERE entrega <> '' and tabela = 'servico' and usuario = '$user'";

            $R = mysqli_query($conexao, $Q);

            $row11 = mysqli_num_rows($R);

            $hoje = date('Y,m,d');
        }





        $pedidos_aberto2 =  mysqli_query($conexao, "select  * from base_os where data_entrega = '$im' and  (data_retirada = '$im' and status <> 'Entregue')    GROUP BY motorista    order by motorista") or die($mysqli_error);







        $pedidos_aberto = mysqli_query($conexao, "select  motorista,aterro,status,tipo_os,data_entrega,data_retirada,Endereco,numero,complemento,(select num_pedido from base_os a where  data_retirada = '$im' and a.num_pedido = x.num_pedido and a.motorista = x.motorista and a.codigo_cliente = x.codigo_cliente)as Ped_ret,(select obs from base_os b where b.num_pedido = x.num_pedido and b.motorista = x.motorista and (data_entrega = '$im' or data_retirada = '$im') and b.codigo_cliente = x.codigo_cliente) as comentario,(select num_pedido from base_os c where  c.num_pedido = x.num_pedido and c.motorista = x.motorista and data_entrega = '$im'  and c.codigo_cliente = x.codigo_cliente and (status = 'Entregar' or status = 'entregue') ) as Ped_ENT from base_os x where  (data_entrega = '$im' or  (data_retirada = '$im' and status <> 'Entregue') )  GROUP BY motorista order by Endereco,troca") or die($mysqli_error);







        $aterross =  mysqli_query($conexao, "select * from base_aterro order by nome_aterro") or die($mysqli_error);









        ?>

      <a href="logout.php" style="display: none;" id="sair_m"><button>&nbsp;sair&nbsp;&nbsp;</button></a>
      <br>
      <br>

      <h1>Motorista Serviços</h1>
      <br>

      <div class="tabela-resumo">



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



                    $e_a_p_m =  mysqli_query($conexao, "SELECT motorista,(select COUNT(status) from base_os a where a.motorista = x.motorista  and ((data_entrega = '$im' and (status = 'entregar' or status = 'Entregue')) or (data_retirada = '$im' and (status = 'Retirar' or status = 'Retirado'))) GROUP BY motorista) - ((select COUNT(status) from base_os a where a.motorista = x.motorista and ( status = 'Entregar' or status = 'Entregue') AND tipo_os = 'Troca'  and data_entrega = '$im' )) as Total,(select COUNT(status) from base_os a where a.motorista = x.motorista and ( status = 'Entregar' or status = 'Entregue') AND tipo_os <> 'Troca'and data_entrega = '$im') as Entregar,(select COUNT(status) from base_os a where a.motorista = x.motorista and ( status = 'Entregar' or status = 'Entregue') AND tipo_os = 'Troca'  and data_entrega = '$im' ) as Trocar,((select COUNT(status) from base_os b where b.motorista = x.motorista and (status = 'RETIRAR' or status = 'Retirado')  and data_retirada = '$im')-(select COUNT(status) from base_os a where a.motorista = x.motorista and (status = 'Entregar' or status = 'Entregue') AND tipo_os = 'Troca'  and data_entrega = '$im' )) as Retirar FROM base_os x GROUP by motorista;") or die($mysqli_error);





                    while ($peds = $e_a_p_m->fetch_assoc()) {

                        $n = explode(' ', $peds['motorista']);

                        $pN = $n[0]; // 'Carlos'

                    ?>

                      <tr class="motorista_tr">
                          <td><?php echo $pN; ?></td>

                          <td class="td_entregas"><?php echo $peds['Entregar']; ?></td>

                          <td class="td_trocas"><?php echo $peds['Trocar']; ?></td>

                          <td class="td_retiradas"><?php echo $peds['Retirar']; ?></td>

                          <td class="td_totais"><?php echo $peds['Total']; ?></td>
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



      <br>





      <div class="calendario-servico">

          <form action="data_consulta_servico.php" method="post">

              <label>Data</label>

              <input size="45" minlength="0" maxlength="45" type="date" name="d_inicio" id="d_inicio" value='<?php echo $im ?>' placeholder="">

              <button input type="submit" name="acao">&nbsp;&nbsp;&nbsp;Gravar data&nbsp;&nbsp;&nbsp;</button>

          </form>



      </div>

      <div class="legenda">
          <div class="topico" style="color:#485468">
              Colocações:&nbsp;&nbsp;<div class="topico-C"></div>
          </div>
          <div class="topico" style="color:#882b2b">
              Retiradas: &nbsp;&nbsp;<div class="topico-R"></div>
          </div>
          <div class="topico" style="color:#b3940c">
              Trocas(Retirar/Colocar): &nbsp;&nbsp;<div class="topico-TR"></div>
          </div>
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

                      <tr>

                          <th><?php echo $motorista ?></th>



                          <?php



                            $pedido_aberto = mysqli_query($conexao, "select  motorista,status,aterro,tipo_os,data_entrega,data_retirada,Endereco,numero,complemento,cacamba,(select num_pedido from base_os a where a.num_pedido = x.num_pedido and a.motorista = x.motorista and  data_retirada = '$im' and a.codigo_cliente = x.codigo_cliente and (status = 'Retirar' or status = 'retirado')) as Ped_ret,(select troca from base_os d where d.num_pedido = x.num_pedido and d.motorista = x.motorista and  (data_retirada = '$im' or data_entrega = '$im')  and d.codigo_cliente = x.codigo_cliente ) as troca,(select obs from base_os b where b.num_pedido = x.num_pedido and (data_entrega = '$im' or data_retirada = '$im') and b.motorista = x.motorista and b.codigo_cliente = x.codigo_cliente) as comentario,(select num_pedido from base_os c where  c.num_pedido = x.num_pedido and c.motorista = x.motorista and data_entrega = '$im' and c.codigo_cliente = x.codigo_cliente and (status = 'Entregar' or status = 'Entregue') ) as Ped_ENT from base_os x where (data_entrega = '$im' or  (data_retirada = '$im' and status <> 'Entregue') ) and motorista = '$motorista'  GROUP BY motorista,Endereco,num_pedido,troca ") or die($mysqli_error);



                            while ($peds = $pedido_aberto->fetch_assoc()) {

                                $n = explode(' ', $peds['motorista']);

                                $pN = $n[0]; // 'Carlos'

                            ?>

                      </tr>



                      <tr>

                          <td>
                              <?php
                                $base_os_Allselect = mysqli_query($conexao, "SELECT * FROM base_os where num_pedido = '" . $peds['Ped_ENT'] . "'");
                                $base_osDados = $base_os_Allselect->fetch_assoc();
                                // cards entregas:  entrege Verde, entregar Cinza/azul normal,  Entregar TROCA Amarelo/tbm (retirar Troca) ------------------ 
                                if ($peds['Ped_ENT']) {
                                    // echo '-------' . $peds['troca'] . '---------' . $peds['tipo_os'] . '-------------' . $peds['status'] . '--------------------' . $peds['Ped_ENT'] .'----------- '.$base_osDados['confirm_troca'];
                                    // && $peds['status'] != 'Entregar'
                                    if ($peds['status'] != 'Retirado' && $peds['status'] != 'Entregar') { ?>

                                      <div class="servico_OK card_entregue">



                                          <h3 class="h3_ok"><b style="color: #e72727;"><?php echo $peds['status']; ?></b> -&nbsp;&nbsp;CAÇAMBA:&nbsp;&nbsp;<?php echo $peds['cacamba']; ?>&nbsp;&nbsp;
                                              &nbsp;✓&nbsp;OK</h3><br>


                                          <div class="conteudo_card">

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

                                              &nbsp;&nbsp;<?php echo $peds['Ped_ENT']; ?><br>

                                              <div onclick="editar(this)">
                                                  <br>

                                                  <button input type="button" name="acao">EDITAR</button>

                                                  <br>
                                              </div>
                                              <br>
                                              <div class="alteracao" id="alteracao" style="display: none;">
                                                  <form action="cmc.php?update3=<?PHP echo $peds['Ped_ENT'] ?>" method="post">

                                                      Inserir o Novo Numero da Caçamba<br><br>

                                                      <input type="text" name="six" size="3">

                                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                      <button input type="submit" name="acao">SALVAR</button>

                                                      <br><br>

                                                  </form>
                                              </div>
                                          </div>


                                      </div>

                                      <?php

                                    } else {

                                        if ($peds['troca']) { ?>

                                          <div class="card_trocas Ctroca">

                                              <h3 class="h3_trocas">(<b style="color: #e72727;">Colocação </b>Caçamba) &nbsp;: &nbsp; <?php echo $peds['Endereco']; ?>, &nbsp;<?php echo $peds['numero']; ?></h3>

                                              <br>
                                              <div class="conteudo_card">
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



                                                  &nbsp;&nbsp;<?php echo $peds['Ped_ENT']; ?><br>

                                                  <br>



                                                  <form action="cmc.php?update3=<?PHP echo $peds['Ped_ENT'] ?>" method="post">

                                                      Inserir o Numero da Caçamba<br><br>

                                                      <input type="text" name="six" size="3">

                                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                      <button input type="submit" name="acao">COLOCAR</button>

                                                      <br><br>

                                                  </form>
                                              </div>

                                          <?php } else {

                                            ?>
                                              <div class="card_colocacao">
                                                  <h3 class="h3_colocacao">Colocação :&nbsp;<?php echo $peds['Endereco']; ?>, &nbsp;<?php echo $peds['numero']; ?></h3>


                                                  <br>
                                                  <div class="conteudo_card">

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



                                                      &nbsp;&nbsp;<?php echo $peds['Ped_ENT']; ?><br>

                                                      <br>



                                                      <form action="cmc.php?update3=<?PHP echo $peds['Ped_ENT'] ?>" method="post">

                                                          Inserir o Numero da Caçamba<br><br>

                                                          <input type="text" name="six" size="3">

                                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

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

                                          <form action="cmcr.php?update3=<?PHP echo $peds['Ped_ret'] ?>" method="post">

                                              <div class="servico_OK card_retirado">
                                                  <h3 class="h3_ok"><b style="color: #e72727;"><?php echo $peds['status']; ?></b> -&nbsp;&nbsp;ATERRO:&nbsp;&nbsp;<?php echo $peds['aterro']; ?> &nbsp;&nbsp;
                                                      ✓&nbsp;OK</h3><br>

                                                  <div class="conteudo_card">
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

                                                      <?php echo $peds['Ped_ret']; ?><br>

                                                      Caçamba&nbsp;:

                                                      <?php echo $peds['cacamba']; ?><br>

                                                      <div onclick="editar(this)">
                                                          <br>

                                                          <button input type="button" name="acao">EDITAR</button>

                                                          <br>
                                                      </div>
                                                      <br>
                                                      <div class="alteracao" id="alteracao" style="display: none;">
                                                          Inserir o Novo Aterro da Caçamba Retirada<br><br>

                                                          <label>Aterro</label>

                                                          <select id="aterro" name="aterro">
                                                              <option value=""></option>

                                                              <?php
                                                                mysqli_data_seek($aterross, 0);

                                                                while ($p_aterros = $aterross->fetch_assoc()) { ?>

                                                                  <option value='<?php echo $p_aterros['Nome_aterro']; ?>'>

                                                                      <?php echo $p_aterros['Nome_aterro']; ?></option>

                                                              <?php } ?>

                                                          </select>

                                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                                                          <button input type="submit" name="acao">SALVAR</button>

                                                          <br><br>


                                                      </div>
                                                  </div>
                                              </div>
                                          </form>
                                          <?php

                                        } else {

                                            if ($peds['troca']  && $peds['tipo_os'] == 'Colocacao' && $peds['status'] == 'Retirar' || $peds['troca'] && $peds['status'] == 'Retirar' && $base_osDados['confirm_troca'] == 1) {
                                            ?>
                                              <form action="cmcr.php?update3=<?PHP echo $peds['Ped_ret'] ?>" method="post">

                                                  <div class="card_trocas Rtroca">
                                                      <h3 class="h3_trocas">(<b style="color: #e72727;">Retirada</b> Caçamba) &nbsp;:&nbsp;<?php echo $peds['Endereco']; ?>, &nbsp;<?php echo $peds['numero']; ?></h3>
                                                      <br>

                                                      <div class="conteudo_card">
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

                                                          <?php echo $peds['Ped_ret']; ?><br>

                                                          Caçamba&nbsp;:

                                                          <?php echo $peds['cacamba']; ?><br> <br>

                                                          Inserir o Aterro da Caçamba Retirada<br><br>

                                                          <label>Aterro</label>

                                                          <select id="aterro" name="aterro">



                                                              <option value=""></option>

                                                              <?php



                                                                mysqli_data_seek($aterross, 0);

                                                                while ($p_aterros = $aterross->fetch_assoc()) { ?>

                                                                  <option value='<?php echo $p_aterros['Nome_aterro']; ?>'>

                                                                      <?php echo $p_aterros['Nome_aterro']; ?></option>

                                                              <?php } ?>

                                                          </select>



                                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                          <button input type="submit" name="acao">RETIRAR</button>


                                                          <br><br>
                                                      </div>
                                                  </div>
                                              </form>
                                          <?php } else if ($peds['troca'] == "" && $peds['tipo_os'] == 'Colocacao' && $peds['status'] == 'Retirar' || $peds['troca'] && $peds['tipo_os'] == 'Troca' && $peds['status'] == 'Retirar' && $base_osDados['confirm_troca'] == 0) { ?>

                                              <form action="cmcr.php?update3=<?PHP echo $peds['Ped_ret'] ?>" method="post">

                                                  <div class="card_retirar">

                                                      <h3 class="h3_retirar">Retirada :&nbsp;&nbsp;<?php echo $peds['Endereco']; ?>, &nbsp;<?php echo $peds['numero']; ?></h3>
                                                      <br>
                                                      <div class="conteudo_card">


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

                                                          <?php echo $peds['Ped_ret']; ?><br>

                                                          Caçamba&nbsp;:

                                                          <?php echo $peds['cacamba']; ?><br> <br>

                                                          Inserir o Aterro da Caçamba Retirada<br><br>

                                                          <label>Aterro</label>

                                                          <select id="aterro" name="aterro">



                                                              <option value=""></option>

                                                              <?php



                                                                mysqli_data_seek($aterross, 0);

                                                                while ($p_aterros = $aterross->fetch_assoc()) { ?>

                                                                  <option value='<?php echo $p_aterros['Nome_aterro']; ?>'>

                                                                      <?php echo $p_aterros['Nome_aterro']; ?></option>

                                                              <?php } ?>

                                                          </select>



                                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                          <button input type="submit" name="acao">RETIRAR</button>

                                                          <br><br>
                                                      </div>

                                                  </div>

                                              </form>
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

            echo "<script>";
            echo "totais_Tresumo();";
            echo "</script>";

            if (isset($_SESSION['motorista'])) {
                echo "<script>";
                echo "filtro_m_servicos('" . $_SESSION['motorista'] . "');";

                echo "</script>";
            }


            ?>

      </div>



  </body>



  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

  </html>