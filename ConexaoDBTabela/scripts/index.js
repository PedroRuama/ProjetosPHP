//selecão da linha: 
let i = 0 //linhas atiivas

Selecionado = new Array();

function trOn(tr) {
    var btnExcluir = document.getElementById('excluir');
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
    } else {
        btnExcluir.style = "opacity: 30%;  cursor: not-allowed;";
        btnExcluir.disabled = true;
    }


    let InputSub = document.getElementById("inputIds");
    InputSub.value = Selecionado;

}

function confirmExcluir(btn) {
   
    if (confirm("Certesa que deseja excluir o(s) produto(s) cadastrados?")) {
      btn.type = "submit"
    } else {}
    document.getElementById("demo").innerHTML = txt;
  }



function buscar() {
    console.log("click");
    var buscar = document.getElementById("pesquisar").value//todos os caracteres pra minusculo
    buscar = buscar.toLowerCase()

    console.log(buscar);
    // var y = document.getElementsByClassName("tdValue");
    var x = document.getElementsByClassName("trValue");    
   
    for (var j = 0; j < x.length; j++) {
        // var value = td[j].childNodes[0];
        if(!x[j].innerHTML.toLowerCase().includes(buscar)){
            x[j].style.display = "none";
        }
        else{
            x[j].style.display = "flex";
        }
    }
    
   

    // console.log(tbody.childNodes.length);
    // for (var i = 0; i < tbody.childNodes.length; i++) {
        
    //    //    console.log(tbody.childNodes.length);
    //     var achou = false
    //     var x = document.getElementsByClassName("tdValue");
    //     var y = document.getElementsByClassName("trValue");
    //     // var tr = tbody.childNodes[2]
    //     // var td = tr.getElementsByTagName("td")
        
        
        
    // }


}


