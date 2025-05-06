<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css">

                
<form name="select-multiple"  method="post" action="data_consulta_motorista1.php" >
  <label>Calendario:</label>
  &nbsp;&nbsp;
  <input id="multiple-date-select-g" name = "multiple-date-select-g" style="background-color: black; color: black" size = "5"  >
  <button input type="submit" name="acao">Gravar data</button>
                <button a href="logout.php"></a>sair</button>
            
            </form>
<!-- <table id="table-data" border="1"></table> -->

<script>

var arr3 = [];

function removeRow(r) {
  var index = arr3.indexOf(r);
  if (index > -1) {
    arr3.splice(index, 1);
  }
}
$('#multiple-date-select-g').multiDatesPicker({
  onSelect: function(datetext) {
    let table = $('#table-data');
    let rowLast = table.data('lastrow');
    let rowNext = rowLast + 1;
    let r = table.find('tr').filter(function() {
      return ($(this).data('date') == datetext);
    }).eq(0);
    // a little redundant checking both here
    if (!!r.length && arr3.includes(datetext)) {
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
      arr3.push(datetext1);
    }
  }
});
// set start, first row will be 0 could be in markup
$('#table-data').data('lastrow', -1);
</script>
<script src="./js/jquery.min.js"></script>
<script src="./js/jquery-ui.min.js"></script>
<script src="./js/jquery-ui.multidatespicker1.js"></script>
 