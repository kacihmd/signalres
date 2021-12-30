"use strict";

var tickets = null;
var fieldset = null;
var hidden_ids_input = null;

function ticketSelected(tr) {
    ticketUnselected();
    tr.classList.add('selected');
    
    //  Réactivation des champs de formulaire
    for (let i = 0; i < fieldset.length; ++i) {
        fieldset[i].removeAttribute('disabled');
    }

    let id = tr.getElementsByTagName('td')[0].innerText;
    for (let i = 0; i < hidden_ids_input.length; i++) {
        let e = hidden_ids_input.item(i);
        console.log(id);
        e.value = id;
    }
}

function ticketUnselected() {
    for (let i = 0; i < tickets.length; i++) {
        let e = tickets.item(i);
        e.classList.remove('selected');
    }

    // Désactivation des champs de formulaire
    for (let i = 0; i < fieldset.length; ++i) {
        fieldset[i].setAttribute('disabled', 'true');
    }
}

window.onload = () => {

    tickets = document.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    fieldset = document.getElementById('updateCrud').getElementsByTagName('fieldset');
    hidden_ids_input = document.getElementsByClassName('hidden_id_input');

    for (let i = 0; i < tickets.length; i++) {

        let e = tickets.item(i);

        e.onclick = (event) => {
            event.stopPropagation();
            ticketSelected(e);
        }
    }

    document.onclick = ticketUnselected;
    ticketUnselected();

    document.getElementsByClassName('modification')[0].onclick =  (event) => {
        event.stopPropagation();
    }
    
}