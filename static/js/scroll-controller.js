const owners = document.getElementById("product-owners-component");
const projects = document.getElementById("our-projects-component");


document.getElementById("snapping-parent").addEventListener("scroll", el=>{
    if(isScrolledIntoView(owners)){
        document.getElementById("owners-nav").style.color = "#23af4d";
    }else{
        document.getElementById("owners-nav").style.color = "#313131";
    }

    if(isScrolledIntoView(projects)){
        document.getElementById("projects-nav").style.color = "#23af4d";
    }else{
        document.getElementById("projects-nav").style.color = "#313131";
    }
});

function isScrolledIntoView(el) {
    var rect = el.getBoundingClientRect();
    var elemTop = rect.top;
    var elemBottom = rect.bottom;

    // Only completely visible elements return true:
    var isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
    // Partially visible elements return true:
    //isVisible = elemTop < window.innerHeight && elemBottom >= 0;
    return isVisible;
}