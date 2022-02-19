const ownerCards = document.querySelectorAll(".product-owner-card");

ownerCards.forEach(card => {
    card.addEventListener("mouseover", e =>{
        if(e.target.classList.contains('default-card')  ){
            e.target.style.opacity = "0";
            setTimeout(() => {e.target.style.visibility = "hidden"}, 300);
        }
    })
    card.addEventListener("mouseleave", e=>{
        let defaultCard = e.target.childNodes[1].childNodes[1].childNodes[1];
        defaultCard.style.opacity = "1";
        defaultCard.style.visibility = "visible"
    })
})