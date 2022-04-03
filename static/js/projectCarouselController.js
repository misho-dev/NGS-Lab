console.log(imageArray);

let myIndex = 0;
carousel();

function carousel() {
    if (myIndex >= imageArray.length) {
        myIndex = 0;
    } else if (myIndex < 0) {
        myIndex = imageArray.length - 1;
    }

    document.getElementById("inner-carousel").style.backgroundImage = `url('${imageArray[myIndex]}')`;
    myIndex++;
    setTimeout(carousel, 15000); // Change image every 2 seconds
}

function plusDivs(n) {
    showDivs(myIndex += n);
}

function showDivs(n) {
    if (myIndex >= imageArray.length) {
        myIndex = 0;
    } else if (myIndex < 0) {
        myIndex = imageArray.length - 1;
    }
    document.getElementById("inner-carousel").style.backgroundImage = `url('${imageArray[myIndex]}')`;
}
