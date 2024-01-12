var inputs = document.getElementsByTagName('input')



function Submit() {
    for (let index = 0; index < inputs.length; index++) {
        const element = inputs[index];

        if (element.className != 'obrigatorio' && element.value == '') {
            element.removeAttribute("required")
            console.log('removido');
            element.value = "vazio"
            element.style = "color:  rgb(100, 100, 100);"

        }else{
            console.log("não removido");
        }
       
        
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