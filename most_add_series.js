  function SezioneSerie(event) {
    const mostraSerie = event.currentTarget;
    const iconaSerie = mostraSerie.querySelector('img');
    const siClick = document.querySelector('#pulsante_giu_serie');

    const chiudiFilm = document.querySelector('#pulsante_giu_film'); 
    chiudiFilm.classList.add('hidden2');
  
    const iconaFilm = document.querySelector('.bottone_film img');
    iconaFilm.src = 'freccia_giu.png'; 
  
    const chiudGeneri = document.querySelector('#pulsante_giu_generi');
    chiudGeneri.classList.add('hidden3');
  
    const iconaGeneri = document.querySelector('.bottone_generi img');
    iconaGeneri.src = 'freccia_giu.png';    
  
    const chiudiLingue = document.querySelector('#lingue');
    chiudiLingue.classList.add('hidden4');
  
    const iconaLingue = document.querySelector('#lingua img');
    iconaLingue.src = 'freccia_giu.png';

    const menuAperto = !siClick.classList.contains('hidden1'); 
    
    if (menuAperto) {
      siClick.classList.add('hidden1');
      console.log("Menu serie chiuso");
      iconaSerie.src='freccia_giu.png';

    } else {
      siClick.classList.remove('hidden1');
      console.log("Menu serie aperto");
      iconaSerie.src='freccia_su.png'
    }
   }
  const mostraSerie = document.querySelector('.dropdown_serie');
  mostraSerie.addEventListener('click',SezioneSerie);

  function SezioneFilm(event){ 
    const mostraFilm = event.currentTarget;
    const iconaFilm = mostraFilm.querySelector('img');
    const siClick = document.querySelector('#pulsante_giu_film');

    const chiudiSerie = document.querySelector('#pulsante_giu_serie'); 
    chiudiSerie.classList.add('hidden1');
    
    const iconaSerie = document.querySelector('.bottone_serie img');
    iconaSerie.src = 'freccia_giu.png';
  
    const chiudGeneri = document.querySelector('#pulsante_giu_generi');
    chiudGeneri.classList.add('hidden3');
  
    const iconaGeneri = document.querySelector('.bottone_generi img');
    iconaGeneri.src = 'freccia_giu.png';
  
    const chiudiLingue = document.querySelector('#lingue');
    chiudiLingue.classList.add('hidden4');
  
    const iconaLingue = document.querySelector('#lingua img');
    iconaLingue.src = 'freccia_giu.png';

    const menuAperto = !siClick.classList.contains('hidden2'); 

    if (menuAperto) {
      siClick.classList.add('hidden2');
      console.log("Menu film chiuso");
      iconaFilm.src='freccia_giu.png';
    } else {
      siClick.classList.remove('hidden2');
      console.log("Menu film aperto");
      iconaFilm.src='freccia_su.png';
    }
   }

  const mostraFilm = document.querySelector('.dropdown_film');
  mostraFilm.addEventListener('click',SezioneFilm);
  

  function SezioneGeneri(event){ 
    const mostraGeneri = event.currentTarget;
    const iconaGeneri = mostraGeneri.querySelector('img');
    const siClick = document.querySelector('#pulsante_giu_generi');

    const chiudiSerie = document.querySelector('#pulsante_giu_serie'); 
    chiudiSerie.classList.add('hidden1');
    
    const iconaSerie = document.querySelector('.bottone_serie img');
    iconaSerie.src = 'freccia_giu.png';
  
    const chiudiFilm = document.querySelector('#pulsante_giu_film');
    chiudiFilm.classList.add('hidden2');
  
    const iconaFilm = document.querySelector('.bottone_film img');
    iconaFilm.src = 'freccia_giu.png';
  
    const chiudiLingue = document.querySelector('#lingue');
    chiudiLingue.classList.add('hidden4');
    
    const iconaLingue = document.querySelector('#lingua img');
    iconaLingue.src = 'freccia_giu.png';

    const menuAperto = !siClick.classList.contains('hidden3'); 

    if (menuAperto) {
      siClick.classList.add('hidden3');
      console.log("Menu generi chiuso");
      iconaGeneri.src='freccia_giu.png';

    } else {
      siClick.classList.remove('hidden3');
      console.log("Menu generi aperto");
      iconaGeneri.src='freccia_su.png';
    }  
   }

  const mostraGeneri = document.querySelector('.dropdown_generi');
  mostraGeneri.addEventListener('click',SezioneGeneri);

  const chiudiSerie = document.querySelector('#pulsante_giu_serie'); 
  chiudiSerie.classList.add('hidden1');

  function apriLingue(event){
    const mostraLingue = event.currentTarget;
    const iconaLingue= mostraLingue.querySelector('img');
    const siClick = document.querySelector('#lingue');

    const chiudiSerie = document.querySelector('#pulsante_giu_serie'); 
    chiudiSerie.classList.add('hidden1');
  
    const iconaSerie = document.querySelector('.bottone_serie img');
    iconaSerie.src = 'freccia_giu.png';
  
    const chiudiFilm = document.querySelector('#pulsante_giu_film');
    chiudiFilm.classList.add('hidden2');
  
    const iconaFilm = document.querySelector('.bottone_film img');
    iconaFilm.src = 'freccia_giu.png'; 
  
    const chiudGeneri = document.querySelector('#pulsante_giu_generi');
    chiudGeneri.classList.add('hidden3');
    
    const iconaGeneri = document.querySelector('.bottone_generi img');
    iconaGeneri.src = 'freccia_giu.png';
  
    const menuAperto = !siClick.classList.contains('hidden4'); 
    
    if (menuAperto) {
      siClick.classList.add('hidden4');
      console.log("Menu lingue chiuso");
      iconaLingue.src='freccia_giu.png';

    } else {
      siClick.classList.remove('hidden4');
      console.log("Menu lingue aperto");
      iconaLingue.src='freccia_su.png';
    }

  }
  const mostraLingue = document.querySelector('.dropdown_lingua');
  mostraLingue.addEventListener('click',apriLingue);

  function onSuccess(response){
    console.log(response.status);
  }

  function onError(error){
    console.log('Error:'+ error);
  }

   function onText(text){
    if(!text){
      console.log('Nessun testo');
    }
    else{
      const urls = text.split('\n');
      const links = document.querySelectorAll('.header_generi_container a')
       for(let i = 0; i < urls.length && i < links.length; i++){
          const image = document.createElement('img');
          image.src = urls[i];
          links[i].append(image);
        }
      console.log(text)
    }
  }

  function onResponseText(response){
    if(!response.ok){
      console.log('Risposta non valida');
      return null;
    }
    else
    return response.text();
  }

  const responsePromiseText = fetch('cercaGeneri.txt').then(onResponseText,onError).then(onText);
  function onJsonFilm(json){
    console.log('Json ricevuto con correttezza!');
    const titoli = document.querySelector('#generi-view-film');
    titoli.innerHTML = '';

    let result = json.results;
    let num_result = result.length;
    if(num_result > 10)
      num_result = 10;

    for(let i=0; i < num_result; i++){
      const movie = result[i];
      const title = movie.title;
      let cover_url;

    if (movie.poster_path) {
          cover_url = 'https://image.tmdb.org/t/p/w342' + movie.poster_path;
      } 
      else {
          cover_url = 'placeholder.jpg';
      }
  
      const Film = document.createElement('div');
      Film.classList.add('Film');
  
      const img = document.createElement('img');
      img.src = cover_url;
      
      img.addEventListener('click', openModal);
  
      const caption = document.createElement('span');
      caption.textContent = title;
  
      Film.appendChild(img);
      Film.appendChild(caption);
      titoli.appendChild(Film);
    }
  }
  function onJsonSerieTV(json){
    console.log('Json ricevuto con correttezza!');
    const titoli = document.querySelector('#generi-view-serie');
    titoli.innerHTML = '';

    let result = json.results;
    let num_result = result.length;
    if(num_result > 5)
      num_result = 5;
  
    for(let i=0; i < num_result; i++){
      const show = result[i];
      const title = show.name;
      let cover_url;

    if (show.poster_path) {
          cover_url = 'https://image.tmdb.org/t/p/w342' + show.poster_path;
      } 
      else {
          cover_url = 'placeholder.jpg';
      }
  
      const SerieTV = document.createElement('div');
      SerieTV.classList.add('SerieTV');
  
      const img = document.createElement('img');
      img.src = cover_url;
      img.addEventListener('click', openModal);
  
      const caption = document.createElement('span');
      caption.textContent = title;
  
      SerieTV.appendChild(img);
      SerieTV.appendChild(caption);
      titoli.appendChild(SerieTV);
    }
  }

  function onResponseJson(response){
    if(!response.ok){
      console.log('Risposta non valida');
      return null;
    }
    else
    return response.json();
  }

  let paginaCorrente = 1;
  let pagineMax = 5;

  function search(event){
    event.preventDefault();
    const titolo_input = document.querySelector('#titolo');
    const titolo_value = encodeURIComponent(titolo_input.value);
    console.log('Eseguo ricerca: ' + titolo_value);
    const API_KEY = '8394c5526d833373a7389670d508ee9f';
    const element_url_film = 'https://api.themoviedb.org/3/search/movie?include_adult=false&language=en-US&page=1&query=' + titolo_value + '&api_key=' + API_KEY;
    const element_url_serieTV = 'https://api.themoviedb.org/3/search/tv?include_adult=false&language=en-US&page=1&query='+ titolo_value + '&api_key=' + API_KEY;
    console.log('URL:' + element_url_film);
    console.log('URL:' + element_url_serieTV);
    if(titolo_value === '') {  
      form.removeEventListener('submit',search);
      alert('Inserisci un titolo!');   
      return;
    }
    fetch(element_url_film).then(onResponseJson).then(onJsonFilm);
    fetch(element_url_serieTV).then(onResponseJson).then(onJsonSerieTV);
  }
  const form = document.querySelector('.ricerca');
  form.addEventListener('submit',search);
  console.log(form);

  function openModal(event){
     const modale = document.querySelector('#modal-view');
     console.log('Immagine Cliccata!');
     modale.innerHTML = '';

     const img_source = event.currentTarget.src;
     console.log(img_source);

     const img = document.createElement('img');
     img.src = img_source;

     modale.appendChild(img);
     modale.classList.remove('hiddenPhotos');
     document.body.classList.add('no-scroll');
  }

  function closeModal(event){
    if(event.key == 'Escape'){
      console.log('CHIUDI MODALE');
      const modale = document.querySelector('#modal-view');
      modale.classList.add('hiddenPhotos');
      modale.innerHTML = '';
      document.body.classList.remove('no-scroll');
    }
  }
  document.addEventListener('keydown', closeModal);
  