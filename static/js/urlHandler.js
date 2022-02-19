let languageButton = document.getElementById("language-button");
let georgianUrl = "/ka";
let engUrl = "";
let newUrl;

function ChangeLanguage(){
    let url = window.location.href;
    let domain = window.location.origin;
    if(url.includes("/ka")){
        console.log("includes");
        newUrl = url.replace('/ka','');;
        console.log(newUrl);    
    }else{
        newUrl = domain + georgianUrl + url.replace(domain, '');
    }
    window.location.href = newUrl;
    console.log(url)
    
}

let url = window.location.pathname;
if(url.includes("/ka")){
    languageButton.innerHTML = "GEO";
}else{
    languageButton.innerHTML = "EN";
}