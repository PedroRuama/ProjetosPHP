var i = 1;
function PopUpCard(card) {
    i *= -1;
    var modal = card.getElementsByClassName("audioModal")[0];
    var span = card.getElementsByClassName("closess")[0];
    console.log("função rodada"); 
    
    if (i < 0) {
        modal.style.display = "flex";        
    }
   

    span.onclick = function() {
        modal.style.display = "none";

    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}


// function closess(modal_) {
//     var close_btn = modal_.getElementsByClassName("close_btn")[0];

    
// }


// function PopUpCard(card) {
//     var modal = card.getElementsByClassName("audioModal")[0];
//     var btn = card.getElementsByClassName("openPopupBtn")[0];
//     var span = card.getElementsByClassName("close_btn")[0];
//     var audio = card.getElementsByClassName("audioPlayer")[0];


//     modal.style.display = "flex";



//     span.onclick = function() {
//         modal.style.display = "none";

       
//     }

//     window.onclick = function(event) {
//         if (event.target == modal) {
//             modal.style.display = "none";
//             // audio.pause();
//             // audio.currentTime = 0; // Reseta o áudio ao início
//         }
//     }
// }
