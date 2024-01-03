

window.onload = function () {
    //carregar junto com apagina
    var tabela = document.getElementById("table")
    var cadastros = document.getElementsByTagName("tr")
    if(cadastros.length > 8){
        tabela.style.overflowY = "scroll";
    }else{
        tabela.style.removeProperty("overflowY");
        
    }
}

//selecão da linha: 
let i = 0 //linhas atiivas

Selecionado = new Array();

function trOn(tr) {
    var btnEditar = document.getElementById('editar');
    var btnExcluir = document.getElementById('excluir');
    
    console.log(btnEditar);

    var trOn = tr.classList.toggle('colorir');  //colorir linha tr

    //id(td) da tr selecionada:
    var td = tr.getElementsByTagName("td")[0]; //[0]= id  [2]=nome
    var idSelec = td.innerHTML;
    

    if (trOn) {
        console.log('trOn');
        i = i + 1 //controle de qunatas linhas selecionadas/ligadas 
        console.log("linhas ativas: ", i)

        Selecionado.push(idSelec) //adiciona o item selecionada á array
        console.log(Selecionado)

    }
    else {
        tr.classList.remove('colorir');
        i = i - 1
        
        console.log('trOff');
        console.log("linhas ativas: ", i)
        let index = Selecionado.indexOf(idSelec) //busca se existe e a posiçao do item na array
        Selecionado.splice(index, 1) //apaga o item

        console.log(Selecionado)

    }

    if (i > 0) { //liga e desliga o btn excluir de acordo com o numero de linhas ligadas
        btnExcluir.style = "opacity: 100%; cursor: pointer;";
        btnExcluir.disabled = false;
    } 
    
    else {
        btnExcluir.style = "opacity: 30%;  cursor: not-allowed;";
        btnExcluir.disabled = true;
    }
    
    
    if (i == 1 ) { //liga e desliga o btn editar de acordo com o numero de linhas ligadas
        btnEditar.style = "opacity: 100%; cursor: pointer;";
        btnEditar.disabled = false;
        btnEditar.type = "submit";
    }
    else{
        btnEditar.style = "opacity: 30%;  cursor: not-allowed;";
        btnEditar.disabled = true;
    }

    
    let Input_excluir = document.getElementById("inputIds_excluir");
    Input_excluir.value = Selecionado;

    let Input_editar = document.getElementById("inputIds_editar");
    Input_editar.value = Selecionado;
}
function confirmExcluir(btn) {
   
    if (confirm("Certeza que deseja excluir o(s) produto(s) selecionado(s)?")) {
      btn.type = "submit"
    } else {}
  }



function buscar() {
    var buscar = document.getElementById("busc").value//todos os caracteres pra minusculo
    buscar = buscar.toLowerCase()

   
    // var y = document.getElementsByClassName("tdValue");
    var x = document.getElementsByClassName("trValue");    
   
    for (var j = 0; j < x.length; j++) {
        // var value = td[j].childNodes[0];
        if(!x[j].innerHTML.toLowerCase().includes(buscar)){
            x[j].style.display = "none";
        }
        else{
            x[j].style.removeProperty("display");
        }
    }
    
   

    var lupa = document.getElementById("lupa")
    
   if (buscar != "") {
       lupa.style.translate = "210px"
       lupa.style.filter = "grayscale(0%);"
    } else{
        lupa.style.translate = "0px"
        console.log('out');
    }
    console.log('x');

}
