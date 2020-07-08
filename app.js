// GET RECENT MOVIES Phase 1
const mrecent = document.querySelector('#recent');
const getRecent = async() => {
  const res = await fetch('./api/recent.php');
  return res.json();
}
const addToRecent = (movies => {
  let html = '';
  movies.forEach(movie => {
    const mv = `
      <div class="col s12 m6">
        <div class="card">
          <div class="card-image">
            <img src="https://image.tmdb.org/t/p/w1920_and_h800_multi_faces${movie.backdrop}">
            <span class="card-title">
              <small>(${movie.id})</small>
              ${movie.title}
              <small>(${parseInt(movie.release_date)})</small>
            </span>
          </div>
          <div class="card-content">
            <p>${movie.tagline}</p>
          </div>
        </div>
      </div>
    `;
    html += mv;
  });
  mrecent.innerHTML = html;
});





// GET SINGLE Phase 2 => hardcoded id
const mSingle = document.querySelector('#single');
const btnSearchById = document.querySelector('#searchById');
btnSearchById.addEventListener('click', () => {
  let mid = document.getElementById('m-id').value;
  if (!(mid < 128 || mid > 1674)) {
    getSingle(mid).then( res => addToSingle(res));
  } else {
    alert("value must be between 128 and 1674");
  }
});
const getSingle = async(mid) => {
    const res = await fetch(`./api/single.php?id=${parseInt(mid)}`);
    return res.json();
}
const addToSingle = (movie => {
  const mv = `
    <div class="col s12 m6">
      <div class="card">
        <div class="card-image">
          <img src="https://image.tmdb.org/t/p/w1920_and_h800_multi_faces${movie.backdrop}">
          <span class="card-title">
            <small>(${movie.id})</small>
            ${movie.title}
            <small>(${parseInt(movie.release_date)})</small>
          </span>
        </div>
        <div class="card-content">
          <p>${movie.tagline}</p>
        </div>
      </div>
    </div>
  `;
  mSingle.innerHTML = mv;
});





// DOCUMENT READY
document.addEventListener('DOMContentLoaded', function() {
  getRecent().then(res => addToRecent(res));

});