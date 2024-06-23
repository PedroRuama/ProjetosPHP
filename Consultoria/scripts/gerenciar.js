document.addEventListener('DOMContentLoaded', function() {
    var openBtn = document.getElementById('open-btn');
    var closeBtn = document.getElementById('close-btn');
    var sidenav = document.getElementById('sidenav');

    var openBtn2 = document.getElementById('open-btn2');
    var closeBtn2 = document.getElementById('close-btn2');
    var sidenav2 = document.getElementById('sidenav2');
  
    openBtn.addEventListener('click', function() {
      sidenav.style.width = '250px';
    });
  
    closeBtn.addEventListener('click', function() {
      sidenav.style.width = '0';
    });

    openBtn2.addEventListener('click', function() {
        sidenav2.style.width = '250px';
      });
    
    closeBtn2.addEventListener('click', function() {
        sidenav2.style.width = '0';
    });
});

let i = 1

function divAcao() {
    i=i*(-1)
}
function focusAcao(acao) {
    var alingH = acao.querySelector('.alingH')
    var txt = acao.querySelector('.txt')
    var seta = acao.querySelector('#setaDesc')
    
    if (i < 0 ) {
        txt.style.height = '35rem';
        seta.style.transform = 'rotate(-180deg)';
    } else{
        txt.style.height = '0rem';
        seta.style.transform = 'rotate(0deg)';
    }
};



function submitAdd(btn) {
    var form = document.getElementById('form_produto')
    var inputs= form.getElementsByTagName('input')

    for (let index = 0; index < inputs.length; index++) {
        const element = inputs[index];
        if (element.disabled = true) {
            element.disabled = false
        }
    }

    btn.type = 'submit'
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