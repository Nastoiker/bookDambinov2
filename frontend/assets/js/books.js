async function getBooks() {
    return new Promise(resolve => fetch('http://bookservice:80/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
const container_book = document.querySelector('.container_book');
setTimeout(function () {
    const el = document.querySelectorAll('.loaded');
    for(let value of el) {
        value.classList.remove('loaded');
    }}, 1000);
const showBook = (arr) => {
    let count = 0;
    let classcheck = 'card_book';
    arr.forEach(book => {
        count++;
        if(count >=8) {
            classcheck = 'card_book' + ' ' + 'displayNoneBook';
        }
        container_book.innerHTML +=` <div class="${classcheck}" data-pos="${book.book.id}"data-rating="${book.ratingCount}" data-avg-rating="${book.ratingAvg}">
                <div onclick="window.location.href =\`./book.php?id=${book.book.id}\`" class="loaded info_book">
                    <div class="header-card">
                        <div>
                             <svg width="0" height="0" viewBox="0 0 32 32">
  <defs>
    <linearGradient id="half${book.book.id}" x1="0" x2="100%" y1="0" y2="0">
      <stop offset="${(book.ratingAvg / 5) * 100}%" stop-color="#fed94b"></stop>
      <stop offset="${(book.ratingAvg / 5) * 100}%" stop-color="#f7efc5"></stop>
    </linearGradient>
    
    <symbol viewBox="0 0 32 32" id="star${book.book.id}">
      <path d="M31.547 12a.848.848 0 00-.677-.577l-9.427-1.376-4.224-8.532a.847.847 0 00-1.516 0l-4.218 8.534-9.427 1.355a.847.847 0 00-.467 1.467l6.823 6.664-1.612 9.375a.847.847 0 001.23.893l8.428-4.434 8.432 4.432a.847.847 0 001.229-.894l-1.615-9.373 6.822-6.665a.845.845 0 00.214-.869z" />
    </symbol>
  </defs>
</svg>
                            

<!-- Пример применения звезды с наложением градиента -->
    <svg class="c-icon" width="32" height="32" viewBox="0 0 32 32">
        <use xlink:href="#star${book.book.id}" fill="url(#half${book.book.id})"></use>
    </svg>
                            <span>${book.ratingAvg}</span>
                            </div>
                        <div>
                            <span>${book.ratingCount}</span>
                            <span>отзыв.</span>
                        </div>
                    </div>
                    <div class="img_book">
                        <img  src="./Static/images/${book.book.img}" style="width:100%; height: 100%" alt="book">
                    </div>
                </div>
                <h4>${book.book.name}</h4>
                <button onclick="window.location.href =\`./book.php?id=${book.book.id}\`">Подробнее</button>
            </div>`
    })
}
const sort = (typeSort= 1) => {
    const list = Array.prototype.slice.call(container_book.children);
    container_book.innerHTML = '';
    switch (typeSort) {
        case 1: {
            const sortedItemsByColDawn = list.sort((a, b) => Number(b.getAttribute('data-avg-rating')) - Number(a.getAttribute('data-avg-rating')));
            console.log(1);
            console.log(sortedItemsByColDawn);
            sortedItemsByColDawn.forEach((el) => {
                container_book.appendChild(el)
            })
            break;
        }
        case 2: {
            const sortedItemsByMane = list.sort((a, b) => Number(b.getAttribute('data-rating') ) - Number(a.getAttribute('data-rating')));
            container_book.innerHTML = '';
            sortedItemsByMane.forEach((el) => {
                container_book.appendChild(el)
            })
            break;
        }
        case 3: {
            const sortedItemsByColDawn = list.sort((a, b) => Number(b.getAttribute('data-pos')) - Number(a.getAttribute('data-pos')));
            container_book.innerHTML = '';
            sortedItemsByColDawn.forEach((el) => {
                container_book.appendChild(el)
            })
            break;
        }
    }
}

async function passport ()
{
    const res = await getBooks();
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    console.log(res1.books);
    showBook(res1.books);
}
passport();