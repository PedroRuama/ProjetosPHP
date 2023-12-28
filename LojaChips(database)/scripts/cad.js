console.log("iniciado");
window.onload = function () {
    //carregar junto com apagina
    console.log("pre load");
    var labelPosition = document.getElementById('id_label');
    var input = document.getElementById('id');

    if (input.value != "") {
        console.log("preenchido")
        labelPosition.classList.toggle('inputNotNull')

    } else { console.log('não preenchido') }
}
//.
//.
//.
//.
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

