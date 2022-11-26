async function getBooks() {
    return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
const passport = async () =>
{
    const res = await getBooks();
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    console.log(res1.books);
    showBook(res1.books);
}
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
                        <img  src="../backend/Uploaded/Images/${book.book.img}" style="width:100%; height: 100%" alt="book">
                    </div>
                </div>
                <h4>${book.book.name}</h4>
                <button>Подробнее</button>
            </div>`
    })
}
passport();
class Products {

    render() {
        let htmlCatalog = '';

        CATALOG.forEach(({ id, name, price, img }) => {
            htmlCatalog += `
                <li>
                    <span>${name}</span>
                    <img src="${img}" />
                    <span>${price}</span>
                    <button>Добавить в корзину</button>
                </li>
            `;
        });

        const html = `
            <ul>
                ${htmlCatalog}
            </ul>
        `;

        ROOT_PRODUCTS.innerHTML = html;
    }
}

const productsPage = new Products();
productsPage.render();