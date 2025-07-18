function validazione(event)
{
    if(form.username.value.length == 0 ||
       form.password.value.length == 0)
    {
        alert("Compilare tutti i campi.");
        event.preventDefault();
    }
        
}

const form = document.forms['nome_form'];
form.addEventListener('submit', validazione);