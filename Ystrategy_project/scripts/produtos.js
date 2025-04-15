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

function selectImagem(img) {
  var mainImg = document.getElementById('mainImg')
  imgClick = img.getElementsByTagName('img')[0].src
  
  mainImg.src = imgClick
  
}