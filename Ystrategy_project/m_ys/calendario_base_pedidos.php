<?php

include('conexao.php');

?>

<?php

if (!isset($_SESSION)) {

  session_start();
}

$user = $_SESSION['usuario'];

?>



<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css">

<link rel="stylesheet" href="./css/indexm.css">

<script src="./js/jquery.min.js"></script>

<script src="./js/jquery-ui.min.js"></script>

<script src="./js/jquery-ui.multidatespicker.js"></script>



<form name="select-multiple" action="filtro_geral_pedido.php" method="post" style="background: white;">
  <h2 class="h2filtro_form">
    <button class="btn_Maxmin" type="button" onclick="maxmize(this), divAcao()">➕</button>
     Pesquisa Banco
  </h2>
  <div class="forms__ minimize">
    <div class="inputGroup">
      <input size="25" onkeyup="maiuscula(this)" maxlength="45" type="name" name="filtro_nome_pedido"
        value="<?php echo $ncp ?>">
      <label>Nome</label>
    </div>

    <div class="inputGroup">

      <input size="25" onkeyup="maiuscula(this)" maxlength="45" type="name" name="filtro_endereco_pedido"
        value="<?php echo $ecp ?>">
      <label>Endereço</label>
    </div>

    <div class="inputGroup">

      <p class="label_select">Motorista</p>

      <select name="filtro_motorista_pedido">

        <option value="<?php echo $mcp ?>"><?php echo $mcp ?></option>

        <option value=""></option>

        <?php



        while ($b_motorista_f = $sql_c_motorista_f->fetch_assoc()) { ?>

          <option value='<?php echo $b_motorista_f['nome_motorista']; ?>'>

            <?php echo $b_motorista_f['nome_motorista']; ?></option>

        <?php } ?>



      </select>


    </div>


    <div class="inputGroup">

      <p class="label_select">Aterro</p>


      <select name="filtro_aterro_pedido">

        <option value="<?php echo $acp ?>"><?php echo $acp ?></option>

        <option value=""></option>



        <?php



        while ($p_aterro_f = $aterros_f->fetch_assoc()) { ?>

          <option value='<?php echo $p_aterro_f['Nome_aterro']; ?>'>

            <?php echo $p_aterro_f['Nome_aterro']; ?></option>

        <?php } ?>

      </select>


    </div>

    <div class="inputGroup">

      <input size="15" maxlength="15" type="text" name="telefone" id="telefone" value="<?php echo $tcp ?>">
      <label>Telefone</label>

    </div>


    <div class="inputGroup">

      <p class="label_select">Status</p>

      <select name="filtro_status">

        <option value="<?php echo $scp ?>"><?php echo $scp ?></option>

        <option value=""></option>



        <?php



        while ($status = $sql_status->fetch_assoc()) { ?>

          <option value='<?php echo $status['status']; ?>'>

            <?php echo $status['status']; ?></option>

        <?php } ?>

      </select>
    </div>


    <div class="inputGroup">

      <p class="label_select">Entrega:</p>

      <input id="multiple-date-select-e" autocomplete="off" name="data_entrega" style="color: black" size="5" value="<?php echo $diecp ?>">

    </div>

    <div class="inputGroup">
      <p class="label_select">Retirada:</p>
      <input id="multiple-date-select-r" autocomplete="off" name="data_retirada" style="color: black" size="5" value="<?php echo $dfecp ?>">
    </div>
    <br>
    <button class="btn_filtro" input type="submit" name="acao" >FILTRAR</button>
    &nbsp;&nbsp;&nbsp;
    <button class="btn_filtro"><a href="l_c_ped.php" >LIMPAR</a></button>
    &nbsp;&nbsp;&nbsp;
    <button class="btn_filtro"><a href="Exportar_OS.php" >EXPORTAR</a></button>
  </div>
</form>




<!-- <table id="table-data" border="1"></table> -->



<script>
  var arr1 = [];



  function removeRow(r) {

    var index = arr1.indexOf(r);

    if (index > -1) {

      arr1.splice(index, 1);

    }

  }

  $('#multiple-date-select-r').multiDatesPicker({

    onSelect: function(datetext) {

      let table = $('#table-data');

      let rowLast = table.data('lastrow');

      let rowNext = rowLast + 1;

      let r = table.find('tr').filter(function() {

        return ($(this).data('date') == datetext);

      }).eq(0);

      // a little redundant checking both here

      if (!!r.length && arr1.includes(datetext)) {

        removeRow(datetext);

        r.remove();

      } else {

        // not found so add it

        let col = $('<td></td>').html(datetext);

        let row = $('<tr></tr>');

        row.data('date', datetext);

        row.attr('id', 'newrow' + rowNext);

        row.append(col).appendTo(table);

        table.data('lastrow', rowNext);

        arr1.push(datetext);

      }

    }

  });

  // set start, first row will be 0 could be in markup

  $('#table-data').data('lastrow', -1);
</script>

<script>
  var arr2 = [];



  function removeRow(r) {

    var index = arr2.indexOf(r);

    if (index > -1) {

      arr2.splice(index, 1);

    }

  }

  $('#multiple-date-select-e').multiDatesPicker({

    onSelect: function(datetext) {

      let table = $('#table-data');

      let rowLast = table.data('lastrow');

      let rowNext = rowLast + 1;

      let r = table.find('tr').filter(function() {

        return ($(this).data('date') == datetext);

      }).eq(0);

      // a little redundant checking both here

      if (!!r.length && arr2.includes(datetext)) {

        removeRow(datetext);

        r.remove();

      } else {

        // not found so add it

        let col = $('<td></td>').html(datetext);

        let row = $('<tr></tr>');

        row.data('date', datetext);

        row.attr('id', 'newrow' + rowNext);

        row.append(col).appendTo(table);

        table.data('lastrow', rowNext);

        arr2.push(datetext);

      }

    }

  });

  // set start, first row will be 0 could be in markup

  $('#table-data').data('lastrow', -1);
</script>