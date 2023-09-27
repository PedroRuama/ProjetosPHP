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


function buscar() {
    var buscar = document.getElementById("pesquisar").value//todos os caracteres pra minusculo
    console.log("click")
    
    for (var i = 0; i < tbody.childNodes.length; i++) {
        console.log('1° for')
        var achou = false
        var tr = tbody.childNodes[3]
        console.log(tr)
        var td = tr.getElementsByTagName("td")[2]
        for (var j = 0; j < td.length; j++) {
            console.log('2° for')
            var value = td[j].childNodes[0];

            console.log(value);

            if(value.indexOf(buscar) >= 0){
                achou = true;
            }
        }
        if (achou) {
            tr.style.display ="table-row";
        } else{}
        
    }


}


