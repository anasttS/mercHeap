/*window.addEventListener('mousedown', hoverEnter, false);
window.addEventListener('mouseut',hoverLeave,false);
hoverEnter = function (evt) {
    let target = evt.target;
    //if(target.className == 'good'){
        target.style.backgroundColor ='grey';
    }

}
hoverLeave = function (evt) {
    let target = evt.target;
    if(target.className == 'good'){
        target.style.backgroundColor ='white';
    }
}*/
window.onmousedown = function (evt) {
    let target = evt.target;
    if (target.className == 'good') {
        target.style.backgroundColor = 'grey';
    }
}
window.onmouseup = function (evt) {
    let target = evt.target;
    if (target.className == 'good') {
        target.style.backgroundColor = 'white';
    }
}

