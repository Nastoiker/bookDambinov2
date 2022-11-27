let get = location.search;
let id = get.replace( '?id=', '');
const bookInfo = document.querySelector(".wrapper__book");
const commentsBook = document.querySelector(".comment");
async function getBooks(id) {
    return new Promise(resolve => fetch(`http://bookservice:88/books/getbooksbygenre/${id}`).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function passport () {
    const res = await getBooks(id);
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    console.log(res);
    showBook(res1);
}
const showBook = (arr) => {
    arr.forEach(book => {
        let container_book = document.querySelector('.container_book');
        container_book.innerHTML +=` <div class="card_book">
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
(async () => {
    await passport()

})();