function fetchSerie() {
        fetch("fetch_serie.php").then(fetchResponse).then(fetchSeriesJson);
}

function fetchFilm() {
        fetch("fetch_film.php").then(fetchResponse).then(fetchFilmsJson);
}

function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}
function fetchSeriesJson(json) {
    const container = document.querySelector('#lista_series');
    container.innerHTML = '';

    if (!json.length) {
        noResultsSeries();
        return;
    }
    
    for(let i = 0; i < json.length;i++){
        const item = json[i];

        const card = document.createElement('div');
        card.classList.add('card');
        card.dataset.id = item.content.id;

        const img = document.createElement('img');
        img.src = item.content.image;

        card.appendChild(img);
        container.appendChild(card);
    }
}

function fetchFilmsJson(json) {
    const container = document.querySelector('#lista_film');
    container.innerHTML = '';

    if (!json.length) {
        noResultsFilm();
        return;
    }
    for(let i = 0; i < json.length;i++){
        const item = json[i];

        const card = document.createElement('div');
        card.classList.add('card');
        card.dataset.id = item.content.id;

        const img = document.createElement('img');
        img.src = item.content.image;

        card.appendChild(img);
        container.appendChild(card);
    }
}

function noResultsFilm() {
    const container = document.querySelector('#lista_film');
    container.innerHTML = '';
    const nores = document.createElement('div');
    nores.className = "nores";
    nores.textContent = "Nessun risultato.";
    container.appendChild(nores);
  }
  function noResultsSeries() {
    const container = document.querySelector('#lista_series');
    container.innerHTML = '';
    const nores = document.createElement('div');
    nores.className = "nores";
    nores.textContent = "Nessun risultato.";
    container.appendChild(nores);
  }

fetchSerie();
fetchFilm();