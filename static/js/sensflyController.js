const map = new Map();
let currentlyActiveRoute = "";

map.set('drone1', ["ind1", "ind2", "ind3", "ind4", "ind5", "ind6", "camera1", "camera2", "camera3", "camera4", "camera5", "camera6", "camera7", "camera8"]);
map.set('drone2', ["ind1", "ind2", "ind3", "ind6", "camera2"]);
map.set('drone3', ["ind4", "ind5", "camera8"]);
map.set('ind1', ["drone1", "drone2", "camera2", "camera3", "camera4", "camera6", "camera7"]);
map.set('ind2', ["drone1", "drone2", "camera2", "camera4"]);
map.set('ind3', ["drone1", "drone2", "camera2","camera3", "camera4", "camera6"]);
map.set('ind4', ["drone1", "drone3", "camera8", "camera5", "camera1"]);
map.set('ind5', ["drone1", "drone3", "camera7", "camera8", "camera5", "camera1"]);
map.set('ind6', ["drone1", "drone2", "camera2", "camera4", "camera7", "camera8"]);
map.set('camera1', ["drone1", "ind4", "ind5"]);
map.set('camera2', ["drone1", "drone2", "ind2", "ind5", "ind1"]);
map.set('camera3', ["drone1", "drone2", "ind1", "ind3"]);
map.set('camera4', ["drone1", "ind2", "ind3", "ind1"]);
map.set('camera5', ["drone1", "ind4", "ind5"]);
map.set('camera6', ["drone1", "ind1", "ind3"]);
map.set('camera7', ["drone1", "ind1", "ind5", "ind6"]);
map.set('camera8', ["drone1", "drone3", "ind4", "ind5"]);

function clearAll(){
    if(currentlyActiveRoute != ""){
        let elems = map.get(currentlyActiveRoute);
        disableBorderColor(currentlyActiveRoute);
        elems.forEach(element => {
            disableBorderColor(element);
        });
    }
}

clearAll();
function setBorderColor(objectId, color){
    document.getElementById(objectId).style.borderColor = color;
}

function disableBorderColor(objectId){
    document.getElementById(objectId).style.borderColor = "rgba(0,0,0,0)";
}

document.querySelectorAll('.clickable-item').forEach(item =>{
    item.addEventListener('click', e =>{
        let id = e.currentTarget.id;
        clearAll();
        currentlyActiveRoute = id;
        highlightRoute(id);
    })
})

function highlightRoute(id){
    let route = map.get(id);
    let color;
    if(id == "drone1"){
        color = "yellow";
    }else if(id =="drone2"){
        color = "blue";
    }else if(id == "drone3"){
        color = "red";
    }else{
        color = "black";
    }
    setBorderColor(id, color);
    route.forEach(elem =>{
        setBorderColor(elem, color);
    })
}

console.log(map.get("drone1"));