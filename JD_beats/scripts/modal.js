function PopUpCard(card) {
    var modal = card.getElementsByClassName("audioModal")[0];
    var btn = card.getElementsByClassName("openPopupBtn")[0];
    var span = card.getElementsByClassName("close")[0];
    var audio = card.getElementsByClassName("audioPlayer")[0];


    modal.style.display = "flex";
    // audio.play();


    span.onclick = function() {
        modal.style.display = "none";
        // audio.pause();
        // audio.currentTime = 0; // Reseta o áudio ao início
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            // audio.pause();
            // audio.currentTime = 0; // Reseta o áudio ao início
        }
    }
}