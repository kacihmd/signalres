"use strict";

var ress = null;
var fieldset = null;
var hidden_ids_input = null;
var imprimer = null;

function resSelected(tr) {
    resUnselected();
    tr.classList.add('selected');
    
    //  Réactivation des champs de formulaire
    for (let i = 0; i < fieldset.length; ++i) {
        fieldset[i].removeAttribute('disabled');
    }

    let id = tr.getElementsByTagName('td')[0].innerText;

    imprimer.action = '/print/' + id;

    for (let i = 0; i < hidden_ids_input.length; i++) {
        let e = hidden_ids_input.item(i);
        e.value = id;
    }
}

function resUnselected() {
    for (let i = 0; i < ress.length; i++) {
        let e = ress.item(i);
        e.classList.remove('selected');
    }

    // Désactivation des champs de formulaire
    for (let i = 0; i < fieldset.length; ++i) {
        fieldset[i].setAttribute('disabled', 'true');
    }
}

window.onload = () => {

    ress = document.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    fieldset = document.getElementById('updateCrud').getElementsByTagName('fieldset');
    hidden_ids_input = document.getElementsByClassName('hidden_id_input');
    imprimer = document.getElementById('impr');

    for (let i = 0; i < ress.length; i++) {

        let e = ress.item(i);

        e.onclick = (event) => {
            event.stopPropagation();
            resSelected(e);
        }
    }

    document.onclick = resUnselected;
    resUnselected();

    document.getElementsByClassName('modification')[0].onclick =  (event) => {
        event.stopPropagation();
    }
    
}