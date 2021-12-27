"use strict";

var users = null;
var fieldset = null;
var hidden_ids_input = null;

function userSelected(tr) {
    userUnselected();
    tr.classList.add('resSelected');
    
    console.log(tr);

    //  Réactivation des champs de formulaire
    for (let i = 0; i < fieldset.length; ++i) {
        fieldset[i].removeAttribute('disabled');
    }

    let id = tr.getElementsByTagName('td')[0].innerText;
    for (let i = 0; i < hidden_ids_input.length; i++) {
        let e = hidden_ids_input.item(i);
        e.value = id;
    }
}

function userUnselected() {
    for (let i = 0; i < users.length; i++) {
        let e = users.item(i);
        e.classList.remove('resSelected');
    }

    // Désactivation des champs de formulaire
    for (let i = 0; i < fieldset.length; ++i) {
        fieldset[i].setAttribute('disabled', 'true');
    }
}

window.onload = () => {

    users = document.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    fieldset = document.getElementById('updateRes').getElementsByTagName('fieldset');
    hidden_ids_input = document.getElementsByClassName('hidden_id_input');

    for (let i = 0; i < users.length; i++) {

        let e = users.item(i);

        e.onclick = (event) => {
            event.stopPropagation();
            userSelected(e);
        }
    }

    document.onclick = userUnselected;
    userUnselected();

    document.getElementsByClassName('modification')[0].onclick =  (event) => {
        event.stopPropagation();
    }
    
}