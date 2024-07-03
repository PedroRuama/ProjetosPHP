window.onload = function () {
    //carregar junto com a pagina
    var situacao = document.getElementById("situacao").value
    
    var inp1 = document.getElementById('inp-divida');
    var inp2 = document.getElementById('inp-quitado');
    if (situacao == 'Em Divida') {
        inp1.checked = true
    }

    if (situacao == 'Quitado') {
        inp2.checked = true
    }

    var forma_pag = document.getElementsByTagName('option')
    var pag = document.getElementById('pagamento').value
    for (let index = 0; index < forma_pag.length; index++) {
        const option = forma_pag[index];
        if (option.value == pag) {
            option.selected = true
        }
    }

    var SelecParcelas = document.getElementById('SelecParcelas')
    var parcelas = document.getElementById('parcelas').value
    for (let index = 0; index < SelecParcelas.length; index++) {
        const par = SelecParcelas[index];
        if (par.value == parcelas) {
            par.selected = true
        }
    }
    
    var SelecParcelas_pagas = document.getElementById('SelecParcelas_pagas')
    var parcelas_pagas = document.getElementById('parcelas_pagas').value
    for (let index = 0; index < SelecParcelas_pagas.length; index++) {
        const pag = SelecParcelas_pagas[index];
        if (pag.value == parcelas_pagas) {
            pag.selected = true
        }
    }




    for (let index = 0; index < inputs.length; index++) {
        const element = inputs[index];
        if (element.className != 'obrigatorio' && element.value == 'vazio') {
            element.value = ""
        }
    }
    dev()
}


var inputs = document.getElementsByTagName('input')

function Submit() {
    for (let index = 0; index < inputs.length; index++) {
        const element = inputs[index];

        if (element.className != 'obrigatorio' && element.value == '') {

            
            element.value = "vazio"

        }
        if (element.disabled) {
            element.removeAttribute("disabled")

        }
        if (document.getElementById("detalhes").value == "") {
            document.getElementById("detalhes").value = "vazio"
        }
        document.getElementById("detalhes").disabled = false
        document.getElementById("pag").disabled = false;
        var val_emp = document.getElementById('val_emp')
        val_emp.value = val_emp.value.replace(/\D/g, '')
        document.getElementById('val_parcela').value =  adicionarPonto(document.getElementById('val_parcela').value.replace(/[.,]/g, ''))
    }
    var inp1 = document.getElementById('inp-divida');
    var inp2 = document.getElementById('inp-quitado');
    if (inp1.checked == false && inp2.checked == false) {
        inp1.checked = true
    }

}

function adicionarPonto(str) {

    if (str.length >= 3) {
        var primeiraParte = str.substring(0, str.length - 2);
        var ultimosDoisCaracteres = str.substring(str.length - 2);
        return primeiraParte + '.' + ultimosDoisCaracteres;
    } else {
        return str;
    }
}

String.prototype.reverse = function () {
    return this.split('').reverse().join('');
};


function mascaraMoeda(campo, evento) {
    var tecla = (!evento) ? window.event.keyCode : evento.which;
    var valor = campo.value.replace(/[^\d]+/gi, '').reverse(); // Permitindo vírgula e ponto como separadores
    var resultado = "";
    var mascara = "###.###.###,##".reverse(); // Adicionando suporte para duas casas decimais
    for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
        if (mascara.charAt(x) != '#') {
            resultado += mascara.charAt(x);
            x++;
        } else {
            resultado += valor.charAt(y);
            y++;
            x++;
        }
    }
    campo.value = resultado.reverse();
}
function mascaraMoeda2(campo, evento) {
    var tecla = (!evento) ? window.event.keyCode : evento.which;
    var valor = campo.value.replace(/[^\d]+/gi, '').reverse();
    var resultado = "";
    var mascara = "###.###.###".reverse();
    for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
        if (mascara.charAt(x) != '#') {
            resultado += mascara.charAt(x);
            x++;
        } else {
            resultado += valor.charAt(y);
            y++;
            x++;
        }
    }
    campo.value = resultado.reverse();
}




function check(x) {
    var inp1 = document.getElementById('inp-divida');
    var inp2 = document.getElementById('inp-quitado');
    var check1 = document.getElementById('divida_label');
    var check2 = document.getElementById('quitado_label');
    if (check1 == x) {
        inp2.checked = false
    }
    if (check2 == x) {
        inp1.checked = false
    }
}

function dev() {
    var valor = parseInt(document.getElementById('val_emp').value.replace(/\D/g, '')); //capital   replace tira os .
   

    var data_emp = document.getElementById('data_emp').value
    var data_dev = document.getElementById('data_dev').value
    let data1 = new Date(`${data_emp}`)
    let data2 = new Date(`${data_dev}`)
    var [ano, mes, diaDev] = data_emp.split('-');

    let diferencaEmDias = Math.round((data2 - data1) / (1000 * 60 * 60 * 24))
    let quantidadeDeMeses = Math.round(diferencaEmDias / 30.44)

    var juros

    var select_parcelas = document.getElementById('SelecParcelas')

    var select_parcelaspagas = document.getElementById('SelecParcelas_pagas')
    var select_parcelasPgs = select_parcelaspagas.getElementsByTagName('option')

    

   
    for (let index = 1; index < 13; index++) {
        const elementpg = select_parcelasPgs[index]
        if (parseInt(elementpg.value) <= select_parcelas.value) {
            elementpg.style.display = 'flex'
           
        } else { elementpg.style.display = 'none'}

    }
    
    
    

    
    

    var parcelasSelc = parseInt(select_parcelas.value)

    
    var mesemp = parseInt([mes])
    var newAno = parseInt(data1.getFullYear())
    
    var newMes = mesemp  + parcelasSelc 
    if (newMes > 12) {
        newAno = newAno + 1
        newMes = newMes - 12; 
    }
   
    var FnewMes = newMes.toString().padStart(2, '0')

    document.getElementById('data_dev').value = `${[newAno]}-${FnewMes}-${[diaDev]}`

    
    var dev = document.getElementById('val_dev')
    var valParcela = document.getElementById('val_parcela')
    var diaPag = document.getElementById('dia_pag')
    
    var valParcelaFormat = adicionarPonto(valParcela.value.replace(/[.,]/g, ''))
  

    dev.value = (valParcelaFormat * parcelasSelc).toFixed(2)

    juros  = dev.value*100/valor

    juros = juros - 100

    document.getElementById('juros').value = juros.toFixed(0)

    // valParcela.value = parseFloat(dev.value / parcelasSelc).toFixed(2)
    diaPag.value = parseInt([diaDev])
    


    var inp1 = document.getElementById('inp-divida');
    var inp2 = document.getElementById('inp-quitado');

    var situacao = document.getElementById("situacao").value

    if (select_parcelas.value == select_parcelaspagas.value) {
        inp1.checked = false
        inp2.checked = true
    }
    if(select_parcelas.value != select_parcelaspagas.value && situacao == 'Em Divida'){ 
        inp2.checked = false
        inp1.checked = true
    }
    
     
    // console.log(select_parcelas.value);
    // console.log(select_parcelaspagas.value);
    
    
    
   
    
    
}










function jurosmascara(i) {
    const v = i.value;

    if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length - 1);
        return;
    }

}


function mascaraTel(i) {
    const v = i.value;

    if (isNaN(v[v.length - 1])) {
        i.value = v.substring(0, v.length - 1);
        return;
    }

    i.setAttribute("maxlength", "15");
    if (v.length == 1) i.value = "(" + i.value;
    if (v.length == 3) i.value += ") ";
    if (v.length == 10) i.value += "-";
}

function mascaraRg(i) {
    const v = i.value;

    if (isNaN(v[v.length - 1])) {
        i.value = v.substring(0, v.length - 1);
        return;
    }

    i.setAttribute("maxlength", "13");

    if (v.length == 2 || v.length == 6) i.value += ".";
    if (v.length == 10) i.value += "-";
}

function mascaraCpf(i) {
    const v = i.value;

    if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length - 1);
        return;
    }

    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";


}



function confirmExcluir(btn) {
    if (confirm("Certeza que deseja excluir?")) {
        btn.type = "submit"
    } else { }
}

function editar() {
    for (let index = 0; index < inputs.length; index++) {
        const element = inputs[index];

        if (element.disabled) {
            element.removeAttribute("disabled")
        }
    }
    document.getElementById("detalhes").disabled = false
    // document.getElementById("disabili").style.pointerEvents = 'all'
    document.getElementById("pag").disabled = false
    // document.getElementById("btn_salvar").disabled = false

}




var i = 1;
function divParcelas() {
    var img = document.getElementById('img_parcela')
    var div_parcelas = document.getElementById('div_parcelas')
    i = i * (-1)
    
    if (i < 0) {
        img.style = 'rotate: 270deg;'
        div_parcelas.style.display = 'flex'

    }
    else {
        img.style = 'rotate: 90deg;'
        div_parcelas.style.display = 'none'

    }
}