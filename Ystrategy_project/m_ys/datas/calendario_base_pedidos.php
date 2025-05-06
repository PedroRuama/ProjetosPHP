<?php
include('conexao.php');
?>
<?php
if(!isset($_SESSION)){
  session_start();
}
$user = $_SESSION['usuario'];
?>

<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css">
<script src="./js/jquery.min.js"></script>
<script src="./js/jquery-ui.min.js"></script>
<script src="./js/jquery-ui.multidatespicker.js"></script>
 
                
<form name="select-multiple"  action="filtro_geral_pedido.php" method="post" style="background: white;">
<br>&nbsp;
                   <label>Nome</label>
                    <input size="30" onkeyup="maiuscula(this)" maxlength="45" type="name" name="filtro_nome_pedido"
                        value="<?php echo $ncp ?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>Endereço</label>
                    <input size="30" onkeyup="maiuscula(this)" maxlength="45" type="name" name="filtro_endereco_pedido"
                        value="<?php echo $ecp ?>">
                      &nbsp;&nbsp;
                    <label>Motorista</label>

                    <select name="filtro_motorista_pedido">
                        <option value="<?php echo $mcp ?>"><?php echo $mcp ?></option>
                        <option value=""></option>
                        <?php
                   
                   while ($b_motorista_f = $sql_c_motorista_f->fetch_assoc()) { ?>
                        <option value='<?php echo $b_motorista_f['nome_motorista']; ?>'>
                            <?php echo $b_motorista_f['nome_motorista']; ?></option>
                        <?php } ?>

                    </select>
                   

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>Aterro</label>
                    <select name="filtro_aterro_pedido">
                        <option value="<?php echo $acp ?>"><?php echo $acp ?></option>
                        <option value=""></option>

                        <?php
                   
                   while ($p_aterro_f = $aterros_f->fetch_assoc()) { ?>
                        <option value='<?php echo $p_aterro_f['Nome_aterro']; ?>'>
                            <?php echo $p_aterro_f['Nome_aterro']; ?></option>
                        <?php } ?>
                    </select>
                    &nbsp;
                    <br><br>
                    &nbsp;
                    <label>Telefone</label>
                    <input size="15"  maxlength="15" type="text" name="telefone" id="telefone"  value="<?php echo $tcp ?>">
                    &nbsp;
                    
                    <label>Status</label>
                    <select name="filtro_status">
                        <option value="<?php echo $scp ?>"><?php echo $scp ?></option>
                        <option value=""></option>

                        <?php
                   
                   while ($status = $sql_status->fetch_assoc()) { ?>
                        <option value='<?php echo $status['status']; ?>'>
                            <?php echo $status['status']; ?></option>
                        <?php } ?>
                    </select>
                    &nbsp;
                    
                    <label>Entrega:</label>
  &nbsp;&nbsp;
  <input id="multiple-date-select-e" name = "data_entrega" style="background-color: black; color: black" size = "5" value="<?php echo $diecp?>"  >
  &nbsp;&nbsp;

  <label>Retirada:</label>
  &nbsp;&nbsp;
  <input id="multiple-date-select-r" name = "data_retirada" style="background-color: black; color: black" size = "5" value="<?php echo $dfecp?>"  >
  <button input type="submit" name="acao">Gravar data</button>
                                       </form>
                                       <button><a href="l_c_ped.php" class="botao1">LIMPAR</a></button>

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
