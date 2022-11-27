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
        <label for="">комментарии</label>
        <textarea name="comment" id="" cols="30" rows="3" placeholder="Оставить комментарий"></textarea>
        
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
                <h4>${comment.author.login}</h4>
                <img src="Static/avatars/${comment.author.img}" alt="userIcon">
            </div>
        </div>
    <div>
    <p class="message">
        ${comment.comment.comment}
      </p>
</div>
        
    </div>
    `});
}
//init
(async () => {
    await passport()

})();
