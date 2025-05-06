<?php

$user = $_SESSION['usuario'];

?>



<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css">

<script src="./js/jquery.min.js"></script>

<script src="./js/jquery-ui.min.js"></script>

<script src="./js/jquery-ui.multidatespicker.js"></script>




<div class="calendario-servico no-print">
  <form name="select-multiple" action="gc.php" method="post" >

  
    <h2>Ecolher data:</h2>
    <div class="inputGroup">

      <input id="multiple-date-select-r" autocomplete="off" name="data" size="5" value="<?php echo $DFM ?>">
      
      <button input type="submit" name="acao">Gravar data</button>
      <button input type="" name="acao"><a href="./l_c_mot.php" class="botao1">LIMPAR</a></button>
    </div>
   

  </form>
</div>



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