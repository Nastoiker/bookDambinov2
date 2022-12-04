switch (localStorage.role) {
    case 'admin': {
        window.location.href = './admin.php'
    }
    case 'user': {

    }
}
var hiddenElement = document.querySelector(".container_genres");
function handleButtonClick() {
    hiddenElement.scrollIntoView({block: "center", behavior: "smooth"});
}
let get = location.search;
let genre = get.replace( '?', '');
if(genre === 'genres') {
    handleButtonClick();
}
const el = document.querySelectorAll('.info_book');
// document.onload =  () => {
//     for(let i = 0; i < el.length; i++) {
//         el[i].classList.remove('loaded');
//     }
// };
window.addEventListener('DOMContentLoaded', () => {
    setTimeout(function () {
    const el = document.querySelectorAll('.loaded');
    for(let value of el) {
        value.classList.remove('loaded');
    }}, 2000);
});
// if (document.readyState === 'loading ') {
//     console.log(1);
//     const el = document.querySelectorAll('.loaded');
//     for(let value of el) {
//         value.classList.remove('loaded');
//     }
// }
// setTimeout(function () {
//     const el = document.querySelectorAll('.loaded');
//     for(let value of el) {
//         value.classList.remove('loaded');
//     }}, 1000);
localStorage.clear();
console.log(localStorage.getItem('email'));
console.log(localStorage.getItem('role'));

if(localStorage.status === 'Banned') {
    window.location.href = "";
}
async function getBooks() {
    return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllGenre() {
    return new Promise(resolve => fetch('http://bookservice:88/books/getgenres').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}


async function passport ()
{
    const res = await getBooks();
    const genre = await getAllGenre();
    let genres = JSON.stringify(genre);
    genres = JSON.parse(genres);
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    showGenre(genres);
    console.log(res1.books);
    showBook(res1.books);
}
document.getElementById('more_book').addEventListener( 'click',(e) => {
    const el = document.querySelectorAll('.card_book');
    let count = 0;
    for(let value of el) {
        count++;
        if( value.classList.contains('displayNoneBook')) {
            value.classList.remove('displayNoneBook');
            document.getElementById('more_book').innerHTML = ' <a><h3>Скрыть</h3></a>';
        } else {
            if(count > 8) {
                value.classList.add('displayNoneBook');
            }
            document.getElementById('more_book').innerHTML = '<a><h3>Посмотреть все</h3> <img src="assets/src/icons/arrow_more.svg" alt=""></a>';
        }
    }
});
const container_book = document.querySelector('.container_book');
async function getBooksBygenre(id) {
    return new Promise(resolve => fetch(`http://bookservice:88/books/getbooksbygenre/${id}`).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}

const getCountBygenres = async (id) => {
    const res = await getBooksBygenre(id);
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    const genres = document.getElementById(`genres${id}`)
    const genreCard = document.getElementById(`genreCard${id}`)
    genreCard.setAttribute('countBooksByGenre', res1.length);
    genres.innerHTML = res1.length;
    genres.setAttribute('countBooksByGenre', res1.length)
}
const sortGenre = (typeSort= 1) => {
    const container_genres = document.querySelector('.container_genres');
    const list = Array.prototype.slice.call(container_genres.children);
    document.querySelector('.container_genres').innerHTML = '';
    switch (typeSort) {
        case 1: {
            const sortedItemsByPopular = list.sort((a, b) => Number(b.getAttribute('countBooksByGenre')) - Number(a.getAttribute('countBooksByGenre')));
            console.log(1);
            console.log(sortedItemsByPopular);
            sortedItemsByPopular.forEach((el) => {
                container_genres.appendChild(el)
            })
            break;
        }
    }
}
const showGenre = (arr) => {
    let count = 0;
    let classcheck = 'card_book';
    const container_genres = document.querySelector('.container_genres');
    arr.forEach(genre => {

        count++;
        if(count >=8) {
            classcheck = 'card_book' + ' ' + 'displayNoneBook';
        }
        container_genres.innerHTML +=` 
        <div class="" onclick="window.location.href =\`./genre.php?id=${genre.id}\`" id="genreCard${genre.id}" data-genres=${genre.name}>
                    <div class="info_genre"><h3>${genre.name}</h3><span id="genres${genre.id}" class="count_Bygenres"></span></div>
                    <img src="Static/genres/${genre.img}" alt="genres">
                </div>
        `;
        getCountBygenres(genre.id)
    });

}
//вывод всех книг
const showBook = (arr) => {
    let count = 0;
    let classcheck = 'card_book';
    sort(2);
    arr.forEach(book => {
        count++;
        if(count >8) {
            classcheck = 'card_book' + ' ' + 'displayNoneBook';
        }
        container_book.innerHTML +=` <div class="${classcheck}" data-pos="${book.book.id}" data-rating="${book.ratingCount}" data-avg-rating="${book.ratingAvg}">
                <div onclick="window.location.href =\`./book.php?id=${book.book.id}\`" class="info_book loaded">
                    <div class="header-card">
                        <div  style="display: flex; align-items: center;">
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

                            <span style="margin-left: 10px">${book.ratingAvg}</span>
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

// setTimeout( (async () => {
//     await passport()
//
// })(), '1231231678967868668768767');
// setInterval(async () => {
//     await passport()
// }, '12312')
passport();
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



