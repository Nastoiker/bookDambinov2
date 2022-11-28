let tmp = [];      // два вспомагательных
let tmp2 = [];     // массива
let param = [];

let get = location.search;  // строка GET запроса, то есть все данные после ?
let id = get.replace( '?id=', '');
const bookInfo = document.querySelector(".wrapper__book");
const commentsBook = document.querySelector(".comment");
async function getBooks(id) {
    return new Promise(resolve => fetch(`http://bookservice:88/books/searchbooksbyid/${id}`).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function passport () {
    const res = await getBooks(id);
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    console.log(res1);
    showBook(res1);
    showComment(res1.comment);
}
const showBook = (object) => {
    bookInfo.innerHTML =` 
        <div class="leftsite">
        <h2>${object.name}</h2>
        <img  class="img_book"  src="./Static/Images/${object.img}" alt="book">
    </div>
    <div class="information">
        <div><img src="assets/src/icons/star.svg" alt="star"><span>${object.rating['round(AVG(rating),1)']}</span></div>
        <h3>Описание</h3>
        <p>${object.description}</p>
        <h4>авторы</h4>
        <p>${object.author[0].firstName + object.author[0].lastname}</p>
        <h4>Год издания</h4>
        <p>${object.releseYear}</p>
        <h4>жанры</h4>
        <p>${object.genres.name}</p>
    </div>
    `;
}

const showComment = (object) => {

    object.forEach(comment => {
        commentsBook.innerHTML += `
    <div class="comments">
        <div class="user_comment">
            <div class="info__usercomment">
                <div> <img src="Static/avatars/${comment.author.image}" alt="userIcon"><h4>${comment.author.login}</h4></div> 
            </div>
        </div>
    <div id ="authorId${comment.author.id}" class="message">
      </div>
        
    </div>
    `;
        const commentsAuthor = comment.commentsAuthor.map( comment => comment);

        const commentsHtml = document.getElementById(`authorId${comment.author.id}`);
        commentsAuthor.forEach( e => { e.createdAt = e.createdAt.replace('.000', ''); commentsHtml.innerHTML += `<div><p>${e.comment}</p> <span>${e.createdAt}</span></div>` });
    });

}

//init
(async () => {
    await passport()

})();
