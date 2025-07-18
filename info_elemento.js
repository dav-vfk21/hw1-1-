function saveFilm(data) {
  const formData = new FormData();
  formData.append('id', data.id);
  formData.append('image', data.image);
  return fetch("salva_film.php", { method: 'POST', body: formData })
    .then(dispatchResponse)
    .catch(dispatchError);
}
function removeFilm(data) {
  const formData = new FormData();
  formData.append('id', data.id);
  formData.append('image', data.image);
  return fetch("rimuovi_film.php", { method: 'POST', body: formData })
    .then(dispatchResponse)
    .catch(dispatchError);
}

let elemento_aggiunto = false;

function clickSave(event) { 

  event.stopPropagation();
  console.log('Bottone salva cliccato!');     
  
  const img = document.querySelector('#salva_elemento img');
  const salvato = document.querySelector('#testo');

   let salvataggio;

  if(!elemento_aggiunto){

  const data = {
    id: elementoDaSalvare.id,
    image: elementoDaSalvare.image
  };
  if (elementoDaSalvare.tipo === 'film') {
     salvataggio = saveFilm(data);
     console.log("Film salvato con successo!");

     salvato.textContent = "Salvataggio effettuato con successo";
     img.src = 'conferma.png';
     elemento_aggiunto = true;
  } else if(elementoDaSalvare.tipo === 'serie') {
    salvataggio =  saveSeries(data);
    console.log("Serie salvata con successo!");
    salvato.textContent = "Salvataggio effettuato con successo";
    img.src = 'conferma.png';
    elemento_aggiunto = true;
  } 
 }else{
  console.log("Elemento rimosso o non aggiunto");
    const data = {
    id: elementoDaSalvare.id,
    image: elementoDaSalvare.image
  };

  if (elementoDaSalvare.tipo === 'film') {
    salvataggio = removeFilm(data);
    console.log("Film rimosso con successo!");
    
  } else if(elementoDaSalvare.tipo === 'serie'){
    salvataggio = removeSeries(data);
    console.log("Serie rimossa con successo!");
  }

  salvato.textContent = "Aggiungi elemento in lista";
  img.src = "salva_elemento.png";
  elemento_aggiunto = false;
 }
}
function saveSeries(data) {
  const formData = new FormData();
  formData.append('id', data.id);
  formData.append('image', data.image);
  return fetch("salva_serie.php", { method: 'POST', body: formData })
    .then(dispatchResponse)
    .catch(dispatchError);
} 
function removeSeries(data) {
  const formData = new FormData();
  formData.append('id', data.id);
  formData.append('image', data.image);
  return fetch("rimuovi_serie.php", { method: 'POST', body: formData })
    .then(dispatchResponse)
    .catch(dispatchError);
}   
 const button_save = document.querySelector('#salva_elemento');
 button_save.addEventListener('click',clickSave);

function dispatchResponse(response) {
  return response.json().then(databaseResponse);
}

function dispatchError(error) {
  console.error('Errore:', error);
}

function databaseResponse(json) {
  if (!json.ok) {
    dispatchError('Risposta non OK dal server');
    return null;
  }
  return json;
}
