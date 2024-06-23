
var inputs = document.getElementsByTagName('input')

window.onload = function(){
    dev()
}

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
      
    }
    var val_emp = document.getElementById('val_emp')
    val_emp.value = val_emp.value.replace(/\D/g, '')
    document.getElementById('val_parcela').value =  adicionarPonto(document.getElementById('val_parcela').value.replace(/[.,]/g, ''))
    
    
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
    var check1 = document.getElementById('divida_label');
    var check2 = document.getElementById('quitado_label');
    var inp1 = document.getElementById('inp-divida');
    var inp2 = document.getElementById('inp-quitado');
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
    
    
    var juros //juros
    

    
    var select_parcelas = document.getElementById('parcelas')

    var select_parcelaspagas = document.getElementById('SelecParcelas_pagas')
    var select_parcelasPgs = select_parcelaspagas.getElementsByTagName('option')
    
    
    for (let index = 1; index < 13; index++) {
        const elementpg = select_parcelasPgs[index]
        if (parseInt(elementpg.value) <= select_parcelas.value) {
            elementpg.style.display = 'flex'
           
        } else { elementpg.style.display = 'none'}

    }

    // console.log('-------------------------------------')
    // console.log('capital: ' + valor)
    // console.log('taxa: ' + i)
    // console.log("tempo: " + quantidadeDeMeses);
    // console.log('juros: ' + juros)
    
    var parcelas = parseInt(document.getElementById('parcelas').value.replace("x"))
     
    
    var mesemp = parseInt([mes])
    var newAno = parseInt(data1.getFullYear())
    
    var newMes = mesemp  + parcelas
    if (newMes > 12) {
        newAno = newAno + 1
        newMes = newMes - 12; 
    }
   
    var FnewMes = newMes.toString().padStart(2, '0')

    document.getElementById('data_dev').value = `${[newAno]}-${FnewMes}-${[diaDev]}`


    var dev = document.getElementById('val_dev')
    var valParcela = document.getElementById('val_parcela')
    var diaPag = document.getElementById('dia_pag')
    

    console.log("---------------");
    var valParcelaFormat = adicionarPonto(valParcela.value.replace(/[.,]/g, ''))
    console.log(valParcelaFormat);
 
 
 
  
   
    
    dev.value = (valParcelaFormat * parcelas).toFixed(2)

    juros  = dev.value*100/valor

    
    juros = juros - 100

 

    document.getElementById('juros').value = juros.toFixed(0)
    
    // console.log(i);
    //dev.value = valor + juros montante
    // valParcela.value =  parseFloat(dev.value/parcelas).toFixed(2)

    diaPag.value = parseInt([diaDev])

}










function jurosmascara(i) {
    const v = i.value;
        
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length-1);
        return;
    }
        
}


function mascaraTel(i) {
    const v = i.value;
        
    if(isNaN(v[v.length-1])){ 
        i.value = v.substring(0, v.length-1);
        return;
    }
    
    i.setAttribute("maxlength", "15");
    if (v.length == 1 ) i.value = "(" + i.value;
    if (v.length == 3 ) i.value += ") ";
    if (v.length == 10) i.value += "-";
}



function mascaraRg(i) {
    const v = i.value;
        
    if(isNaN(v[v.length-1])){ 
        i.value = v.substring(0, v.length-1);
        return;
    }
    
    i.setAttribute("maxlength", "13");
    
    if (v.length == 2 || v.length == 6 ) i.value += ".";
    if (v.length == 10) i.value += "-";
}

function mascaraCpf(i) {
    const v = i.value;
        
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length-1);
        return;
    }
    
    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";

    
}


var i = 1;
function divParcelas(){
    var img = document.getElementById('img_parcela')
    var div_parcelas = document.getElementById('div_parcelas')
    i = i*(-1)
    
    if (i < 0) {
        img.style = 'rotate: 270deg;'
        div_parcelas.style.display= 'flex'
       
    }
    else{
        img.style = 'rotate: 90deg;'
        div_parcelas.style.display= 'none'
       
    }
}