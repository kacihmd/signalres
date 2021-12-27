"use strict";

window.onload = () => {
    let anoSelect = document.getElementById('anoSelect');
    let newAno = document.getElementById('newAnomalie');
    
    anoSelect.onchange = (e) => {
        if (anoSelect.selectedIndex != anoSelect.length - 1) {
            newAno.setAttribute('disabled', 'true');
        } else {
            newAno.removeAttribute('disabled');
        }
    }

    anoSelect.onchange();
}