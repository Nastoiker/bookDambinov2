let get = location.search;
let id = get.replace( '?id=', '');
const bookInfo = document.querySelector(".wrapper__book");
const genres = ['Мистика',  'Драмма', 'Фанстастика', 'Детектив','Приключения']
async function getGenre() {
    return new Promise(resolve => fetch(`http://bookservice:88/books/getgenres`).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}

const commentsBook = document.querySelector(".comment");
async function getBooks(id) {
    return new Promise(resolve => fetch(`http://bookservice:88/books/getbooksbygenre/${id}`).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function passport () {
    const res = await getBooks(id);
    let books = JSON.stringify(res);

    let  genres = await getGenre();
    genres =  JSON.stringify(genres);
    genres = JSON.parse(genres);
    genres.forEach(
        genre => {
            if(genre.id===id) {
                document.getElementById('titleGenre').innerHTML = genre.name;
            }
        }
    )
    const res1 = JSON.parse(books);
    console.log(res);
    showBook(res1);
}
let container_book = document.querySelector('.container_book');
const showBook = (arr) => {
    arr.forEach(book => {

        container_book.innerHTML +=` <div class="card_book" data-pos="${book.id}" data-rating="${book.rating["COUNT(rating)"]}" data-avg-rating="${book.rating['round(AVG(rating),1)']}">
                <div class="info_book">
                    <div class="header-card">
                        <div>
                            <img src="assets/src/icons/star.svg" alt="star">
                            <span>${book.rating['round(AVG(rating),1)']}</span>
                        </div>
                        <div>
                            <span>${book.rating["COUNT(rating)"]}</span>
                            <span>отзыв.</span>
                        </div>
                    </div>
                    <div class="img_book">
                        <img  src="./Static/images/${book.img}" style="width:100%; height: 100%" alt="book">
                    </div>
                </div>
                <h4>${book.name}</h4>
                <button onclick="window.location.href =\`./book.php?id=${book.id}\`">Подробнее</button>
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

(async () => {
    await passport()

})();