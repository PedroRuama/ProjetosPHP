document.addEventListener('DOMContentLoaded', function() {
    var openBtn = document.getElementById('open-btn');
    var closeBtn = document.querySelector('.close-btn');
    var sidenav = document.querySelector('.sidenav');
  
    openBtn.addEventListener('click', function() {
      sidenav.style.width = '250px';
    });
  
    closeBtn.addEventListener('click', function() {
      sidenav.style.width = '0';
    });
  });