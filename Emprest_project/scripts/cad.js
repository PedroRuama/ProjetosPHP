var inputs = document.getElementsByTagName('input')

function Submit() {
    for (let index = 0; index < inputs.length; index++) {
        const element = inputs[index];

        if (element.className != 'obrigatorio' && element.value == '') {
            // element.removeAttribute("required")
            console.log('removido');
            element.value = "vazio"

        } else { }


    }
}


String.prototype.reverse = function () {
    return this.split('').reverse().join('');
};

function mascaraMoeda(campo, evento) {
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
    var valor = document.getElementById('val_emp').value
    var juros = document.getElementById('juros').value
    var dev = document.getElementById('val_dev')

    console.log('valor: ' + valor)
    console.log('juros: ' + juros)

    dev.value = valor * juros

}


function data() {
    var emp = document.getElementById('data_emp').value
    var dev = document.getElementById('data_dev').value
    let data1 = new Date(`${emp}`)
    let data2 = new Date(`${dev}`)

    console.log("data 1: " + emp);
    console.log("data 2: " + dev);
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
        
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length-1);
        return;
    }
    
    i.setAttribute("maxlength", "15");
    if (v.length == 1 ) i.value = "(" + i.value;
    if (v.length == 3 ) i.value += ") ";
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