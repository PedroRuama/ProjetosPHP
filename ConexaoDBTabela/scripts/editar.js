console.log("iniciado");
window.onload = function () {
    //carregar junto com apagina
    console.log("pre load");
    var labelId = document.getElementById('id_label');
    var inputId = document.getElementById('id');
    if (inputId.value != "") {
        console.log("preenchido")
        labelId.classList.toggle('inputNotNull')

    } else {}

    var labelPro = document.getElementById('prod_label');
    var inputPro = document.getElementById('produto');
    if (inputPro.value != "") {
        console.log("preenchido")
        labelPro.classList.toggle('inputNotNull')

    } else {}
    
    var labelCod = document.getElementById('cod_label');
    var inputCod = document.getElementById('codigo');
    if (inputCod.value != "") {
        console.log("preenchido")
        labelCod.classList.toggle('inputNotNull')

    } else {}
   
    var labelDesc = document.getElementById('desc_label');
    var inputDesc = document.getElementById('descricao');
    if (inputDesc.value != "") {
        console.log("preenchido")
        labelDesc.classList.toggle('inputNotNull')

    } else {}
    
    var labelData = document.getElementById('data_label');
    var inputData = document.getElementById('data');
    if (inputData.value != "") {
        console.log("preenchido")
        labelData.classList.toggle('inputNotNull')

    } else {}
    
    var labelValor = document.getElementById('valor_label');
    var inputValor = document.getElementById('valor');
    if (inputValor.value != "") {
        console.log("preenchido")
        labelValor.classList.toggle('inputNotNull')

    } else {}
}
//.
//.
//.
//.
//.
function InputId(input) {
    var labelPosition = document.getElementById('id_label')
    
    input.setAttribute("maxlength", "3");
    if (input.value != "") {
        console.log("preenchido")
        labelPosition.classList.toggle('inputNotNull')

    } else { console.log('não preenchido') }
}
function InputCod(input) {
    var labelPosition = document.getElementById('cod_label')
    
    if (input.value != "") {
        labelPosition.classList.toggle('inputNotNull')
    }
}
function InputProd(input) {
    var labelPosition = document.getElementById('prod_label')
    if (input.value != "") {
        labelPosition.classList.toggle('inputNotNull')
    }
}
function InputDesc(input) {
    var labelPosition = document.getElementById('desc_label')
    if (input.value != "") {
        labelPosition.classList.toggle('inputNotNull')
    }
}
function InputData(input) {
    var labelPosition = document.getElementById('data_label')
    if (input.value != "") {
        labelPosition.classList.toggle('inputNotNull')
    }
}
function datalabelclick() {
    var labelPosition = document.getElementById('data_label')
    labelPosition.classList.toggle('inputNotNull')
}
function InputPrec(input) {
    var labelPosition = document.getElementById('prec_label')
    if (input.value != "") {
        labelPosition.classList.toggle('inputNotNull')
    }
}

String.prototype.reverse = function () {
    return this.split('').reverse().join('');
};

function mascaraMoeda(campo, evento) {
    var tecla = (!evento) ? window.event.keyCode : evento.which;
    var valor = campo.value.replace(/[^\d]+/gi,'').reverse();
    var resultado = "";
    var mascara = "##.###.###.##".reverse();
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

function confirmExcluir(btn) {
   
    if (confirm("Certeza que deseja excluir o(s) produto(s) selecionado(s)?")) {
      btn.type = "submit"
    } else {}
}

