
var i = 1;
function editCaixa() {
    var div_caixa = document.getElementById('EditCaixa_div')
    i = i * (-1)
    console.log(i);
    if (i < 0) {
        div_caixa.style.display = 'flex'
    }
    else {
        div_caixa.style.display = 'none'
    }
}

function subFormCaixa(btn) {
    var acao = document.getElementById('acao')
    var editVal =  document.getElementById('editVal')
    editVal.value = editVal.value.replace(/\D/g, '')
    if (btn.value == 'Retirar') {
        if (editVal.value=="") {
            document.getElementById('editVal').value = '0'
        }
        
        acao.value = 1
        btn.type = 'submit'
    }
    if (btn.value == 'Adicionar') {
        
        if (editVal.value=="") {
            document.getElementById('editVal').value = 0
        }
        acao.value = 2
        btn.type = 'submit'
    }
}

function mascaraMoedaIn(i) {
    const v = i.value;
        
    if(isNaN(v[v.length-1])){ 
        i.value = v.substring(0, v.length-1);
        return;
    }
    
    i.setAttribute("maxlength", "15");
    if (v.length == 3 ) i.value += ") ";
    if (v.length == 10) i.value += "-";
}


String.prototype.reverse = function () {
    return this.split('').reverse().join('');
};

function mascaraMoedaIn(campo, evento) {
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

