let get = location.search;
let id = get.replace( '?id=', '');
const bookInfo = document.querySelector(".wrapper__book");

setTimeout(function () {
    const el = document.querySelectorAll('.loaded');
    for(let value of el) {
        value.classList.remove('loaded');
    }}, 1000);
const commentsBook = document.querySelector(".comment");
async function getBooks() {
    return new Promise(resolve => fetch(`http://bookservice:88/authors`).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function passport () {
    const res = await getBooks(id);
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    console.log(res);
    showBook(res1);
}
let container_authors = document.querySelector('.container_authors');
const showBook = (arr) => {
    arr.forEach(author => {

        container_authors.innerHTML +=` <div class="card_book" data-pos="${author.id}" data-rating="${author.countRating}" data-avg-rating="${author.rating_Author}">
                <div onclick="window.location.href =\`./author.php?id=${author.id}\`" class="loaded info_book">
                    <div class="header-card">
                        <div style="display: flex; align-items: center;">
                              <svg width="0" height="0" viewBox="0 0 32 32">
  <defs>
    <!-- Градиент, который будет задавать два цвета -->
    <linearGradient id="half${author.id}" x1="0" x2="100%" y1="0" y2="0">
      <stop offset="${(author.rating_Author / 5) * 100}%" stop-color="#fed94b"></stop>
      <stop offset="${(author.rating_Author / 5) * 100}%" stop-color="#f7efc5"></stop>
    </linearGradient>
    
    <!-- Фигура звезды -->
    <symbol viewBox="0 0 32 32" id="star${author.id}">
      <path d="M31.547 12a.848.848 0 00-.677-.577l-9.427-1.376-4.224-8.532a.847.847 0 00-1.516 0l-4.218 8.534-9.427 1.355a.847.847 0 00-.467 1.467l6.823 6.664-1.612 9.375a.847.847 0 001.23.893l8.428-4.434 8.432 4.432a.847.847 0 001.229-.894l-1.615-9.373 6.822-6.665a.845.845 0 00.214-.869z" />
    </symbol>
  </defs>
</svg>
                            

<!-- Пример применения звезды с наложением градиента -->
    <svg class="c-icon" width="32" height="32" viewBox="0 0 32 32">
        <use xlink:href="#star${author.id}" fill="url(#half${author.id})"></use>
    </svg>
                            <span style="margin-left: 10px">${author.rating_Author}</span>
                        </div>
                        <div>
                            <span>${author.countBook}</span>
                            <span>книг.</span>
                        </div>
                    </div>
                    <div class="img_book">
                        <img  src="./Static/authors/${author.avatar_author}" style="width:100%; height: 100%" alt="book">
                    </div>
                </div>
                <h4>${author.firstName + ' ' +author.lastname}</h4>
                <button onclick="window.location.href =\`./author.php?id=${author.id}\`">Подробнее</button>
            </div>`
    })
}
const sort = (typeSort= 1) => {
    const list = Array.prototype.slice.call(container_authors.children);
    container_authors.innerHTML = '';
    switch (typeSort) {
        case 1: {
            const sortedItemsByColDawn = list.sort((a, b) => Number(b.getAttribute('data-avg-rating')) - Number(a.getAttribute('data-avg-rating')));
            console.log(1);
            console.log(sortedItemsByColDawn);
            sortedItemsByColDawn.forEach((el) => {
                container_authors.appendChild(el)
            })
            break;
        }
        case 2: {
            const sortedItemsByMane = list.sort((a, b) => Number(b.getAttribute('data-rating') ) - Number(a.getAttribute('data-rating')));
            container_authors.innerHTML = '';
            sortedItemsByMane.forEach((el) => {
                container_authors.appendChild(el)
            })
            break;
        }
        case 3: {
            const sortedItemsByColDawn = list.sort((a, b) => Number(b.getAttribute('data-pos')) - Number(a.getAttribute('data-pos')));
            container_authors.innerHTML = '';
            sortedItemsByColDawn.forEach((el) => {
                container_authors.appendChild(el)
            })
            break;
        }
    }
}

(async () => {
    await passport()

})();