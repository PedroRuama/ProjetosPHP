
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
    editVal.value = editVal.value.replace(/[^\d,]/g, '')
    editVal.value = editVal.value.replace(',', '.')
    console.log(editVal.value);


    if (btn.value == 'Retirar') {
        if (editVal.value=="") {
            document.getElementById('editVal').value = 0
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



String.prototype.reverse = function () {
    return this.split('').reverse().join('');
};

function mascaraMoedaIn(campo, evento) {
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

