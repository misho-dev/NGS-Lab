const serviceButtons = document.querySelectorAll(".menu-item");
const serviceContainer = document.querySelectorAll(".service-container")[0];
const services = document.querySelectorAll(".service");
const divider = document.getElementById("divider");
let rolledOut = false;

document.querySelectorAll(".service-button")[0].addEventListener("click", (e) =>{
    let offsets = getOffsetFromPoint(0, serviceButtons.length+1, 225);
    offsets.forEach(elem =>{
        elem.print();
    })
    if(rolledOut == false){
            divider.style.height = "150px";
            for(let i=0; i<serviceButtons.length; i++){
                serviceButtons[i].style.transform = `translate3d(${offsets[i+1].elem1}px, ${offsets[i+1].elem2}px, 0)`
            }
            serviceContainer.style.zIndex = "100";
            rolledOut = true;
    }else{
        divider.style.height = "0px";
        for(let i=0; i<serviceButtons.length; i++){
            serviceButtons[i].style.transform = `translate3d(0, 0, 0)`
        }
        serviceContainer.style.zIndex = "0";
        rolledOut = false;
    }
})

document.querySelectorAll(".service-container")[0].addEventListener("click", (e)=>{
    if(e.target.classList.contains('service-container') ){
        divider.style.height = "0px";
        for(let i=0; i<serviceButtons.length; i++){
            serviceButtons[i].style.transform = `translate3d(0, 0, 0)`
        }
        serviceContainer.style.zIndex = "0";
        rolledOut = false;
    }

    console.log(e.target);
    if(e.target.classList.contains('service') || e.target.parentElement.classList.contains('service')){
        hideAllServices();
        divider.style.height = "0px";
        for(let i=0; i<serviceButtons.length; i++){
            serviceButtons[i].style.transform = `translate3d(0, 0, 0)`
        }
        serviceContainer.style.zIndex = "0";
        rolledOut = false;
    }
})


serviceButtons.forEach(button => {
    button.addEventListener("click", (e)=>{
        let elem = e.currentTarget;
        toggleRelevantServiceAndDisableOthers(findIndexOfElement(elem, serviceButtons))
    })
})

function findIndexOfElement(src, arr) {
    for (var i = 0; i < arr.length; i++) {
        if (src === arr[i]) {
            return i;
        }
    }
}

function hideAllServices(){
    services.forEach(elem =>{
        if(!elem.classList.contains('hidden')){
            elem.classList.toggle('hidden');
        }
    })
}

function toggleRelevantServiceAndDisableOthers(index){
    services.forEach(elem =>{
        if(!elem.classList.contains('hidden')){
            elem.classList.toggle('hidden');
        }
    })
    services[index].classList.toggle('hidden');
}

class tuple{
    constructor(elem1, elem2){
        this.elem1 = elem1;
        this.elem2 = elem2;
    }
    multiply(scalar){
        this.elem1 *= scalar;
        this.elem2 *= scalar;
    }
    swap(){
        let tmp = this.elem1;
        this.elem1 = this.elem2;
        this.elem2 = tmp;
    }
    print(){
        console.log("elem1: "+this.elem1+ ", elem2: " + this.elem2);
    }
}

function getOffsetFromPoint(startingAngle, numButtons, scalar) {
    let result = [];
    let angleDiff =  Math.PI / numButtons;
    for (let i = 0; i < numButtons; i++) {
        let buttonOffset = new tuple(( Math.cos(startingAngle - i * angleDiff)).toFixed(5), //marcxniv
            (Math.sin(startingAngle) - Math.sin(startingAngle - i * angleDiff)).toFixed(5)); //qvemot
        buttonOffset.multiply(scalar);
        result.push(buttonOffset);
    }
    return result;
}

function getOffsetFromCenter(numButtons, scalar) {
    let result = [];
    result.push(new tuple(0, 0));
    for (let i = 0; i < numButtons; i++) {
        let buttonOffset = new tuple(Math.cos(Math.PI - (2 * Math.PI / numButtons) * i).toFixed(5),
            Math.sin(Math.PI - (2 * Math.PI / numButtons) * i).toFixed(5));
        buttonOffset.multiply(scalar);
        result.push(buttonOffset);
    }
    return result;
}
