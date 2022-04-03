let lanUrl = window.location.href;
if(!lanUrl.includes("/ka")){
    let HTMLString = document.getElementById("blog-wrapper");
    console.log(HTMLString)
    HTMLString.innerHTML = "";
    document.getElementById("footer").remove();
}else{
    document.getElementById("disclaimer").remove();
}
console.log(lanUrl)