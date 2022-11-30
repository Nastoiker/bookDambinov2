switch (localStorage.role) {
    case 'admin': {
        window.location.href = './admin.php'
    }
    case 'user': {
    }
}
console.log(localStorage.getItem('email'));
console.log(localStorage.getItem('role'));
console.log(localStorage.getItem('image'));

if(localStorage.status === 'Banned') {
    window.location.href = "";
}
async function getBooks() {
    return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getGenres() {
    return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function showGenres() {
    const arr = await getGenres();
}
function showGenresHtml(arr) {
    let genresWrapper = document.getElementById("container_genres");
    arr.forEach(genres => {
        genresWrapper+= `
            
        `
    })
}
async function passport ()
{
    const res = await getBooks();
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    console.log(res1.books);
    showBook(res1.books);
}
const container_book = document.querySelector('.container_book');
//Подсчет книг по жанрам
async function getBooksBygenre(id) {
    return new Promise(resolve => fetch(`http://bookservice:88/books/getbooksbygenre/${id}`).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}

const arrGenres = [1, 2, 3, 4 ,5];
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
arrGenres.forEach( genresId => getCountBygenres(genresId));
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
//вывод всех книг
const showBook = (arr) => {

    arr.forEach(book => {
        container_book.innerHTML +=` <div class="card_book"  data-pos="${book.book.id}"data-rating="${book.ratingCount}" data-avg-rating="${book.ratingAvg}">
                <div class="info_book">
                    <div class="header-card">
                        <div>
                            <img src="assets/src/icons/star.svg" alt="star">
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



