let get = location.search;
let id = get.replace( '?id=', '');
const bookInfo = document.querySelector(".wrapper__book");


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
                <div class="info_book">
                    <div class="header-card">
                        <div>
                            <img src="assets/src/icons/star.svg" alt="star">
                            <span>${author.rating_Author}</span>
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
                <h4>${author.firstName + author.lastname}</h4>
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