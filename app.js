// GET Random Titles
const cards = document.getElementById('cards');

let usrGenre = 'any';
const getRndTitles = async() => {
  const res = await fetch(`./api/rnd.php?genre=${usrGenre}`);
  return res.json();
}

const addRndTitles = (movies => {
  let html = '';
  if (!movies['message']) {
    movies.forEach(movie => {
      // console.log(movie);
      let mv = `
      <div class="card">
        <div class="card-image" style="background-image:url(assets/images/posters${movie.poster});"></div>
        <div class="card-title">${movie.title}</div>
        <div class="card-action"><a href="#">Details</a></div>
        
      </div>
      `;
      html += mv;
    });
    cards.innerHTML = html;
  } else {
    cards.innerHTML = `
      <h4 class="error">ups.. something went wrong, no data for '${usrGenre}'</h4>
    `;
  }
});

document.querySelector('#rnd-btn').addEventListener('click', () => {
  getRndTitles().then(res => addRndTitles(res));
});


// DOCUMENT READY
document.addEventListener('DOMContentLoaded', function() {
  getRndTitles().then(res => addRndTitles(res));

});