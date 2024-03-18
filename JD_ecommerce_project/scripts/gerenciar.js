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