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



    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const cardsContainer = document.querySelector('.cards-container');
  
    let cardIndex = 0;
    const cardWidth = document.querySelector('.card').offsetWidth;
  
    nextBtn.addEventListener('click', function () {
      console.log(cardIndex);
      if (cardIndex <= cardsContainer.children.length - 1 ) {
        cardIndex++;
        if (cardIndex >= cardsContainer.children.length) {
          cardIndex = 0;
        }
        updateCardsPosition();
      }
    });
  
    prevBtn.addEventListener('click', function () {
      if (cardIndex > 0) {
        cardIndex--;
        
        updateCardsPosition();
      }
    });
  
    function updateCardsPosition() {
      const newPosition = -cardIndex * cardWidth;
      cardsContainer.style.transform = `translateX(${newPosition}px)`;
    }
  
    function autoNext() {
      cardIndex++;
      if (cardIndex == cardsContainer.children.length - 1) {
        cardIndex = 0;
      }
      updateCardsPosition()
    }
    // setInterval(autoNext, 5000)
  });

  function hrefGo() {
      window.location.href = "routes/produtos.php"
  }