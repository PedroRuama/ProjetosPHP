document.addEventListener('DOMContentLoaded', function () {
  

  const prevBtn = document.querySelector('.prev-btn');
  const nextBtn = document.querySelector('.next-btn');
  const cardsContainer = document.querySelector('.cards-container');

  let cardIndex = 0;
  const cardWidth = document.querySelector('.card').offsetWidth;

  nextBtn.addEventListener('click', function () {
    console.log(cardIndex);
    if (cardIndex <= cardsContainer.children.length - 1) {
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

