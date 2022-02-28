    const ownerCards = document.querySelectorAll(".product-owner-card");

    ownerCards.forEach(card => {
        card.addEventListener("mouseover", e =>{
            if(e.target.classList.contains('default-card')  ){
                e.target.style.pointerEvents = "none";
                e.target.style.opacity = "0";
            }
        })
        card.addEventListener("mouseleave", e=>{
            let defaultCard = e.target.childNodes[1].childNodes[1].childNodes[1];
            defaultCard.style.pointerEvents = "auto";
            defaultCard.style.opacity = "1";
        })
    })
