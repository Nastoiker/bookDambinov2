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
    document.getElementById("sortBtnBook").onclick = () => { res1.books = sortByRating(res1.books)};
    showBook(res1.books);
}
(async () => {
    await passport()

})();
const showBook = (arr) => {
    arr.forEach(book => {
        let container_book = document.querySelector('.container_book');
        container_book.innerHTML +=` <div class="card_book">
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
const sortByRating= (arr) => {
    arr = arr.sort( (a, b) => a.ratingAvg - b.ratingAvg);
    return arr;
}


// import axios from '../plugins/axios';
//
//
