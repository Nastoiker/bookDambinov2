let tmp = [];      // два вспомагательных
let tmp2 = [];     // массива
let param = [];

let get = location.search;  // строка GET запроса, то есть все данные после ?
let id = get.replace( '?id=', '');
localStorage.setItem('BookId', id);
const bookInfo = document.querySelector(".wrapper__book");
const commentsBook = document.querySelector(".comment");
async function getBooks(id) {
    return new Promise(resolve => fetch(`http://bookservice:88/books/searchbooksbyid/${id}`).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
$(".form_comment").submit(function(e){
    let BookId = localStorage.getItem('BookId');
    e.preventDefault();
    let comment = $('.comment_text').val();
    let id = Number(localStorage.getItem('id'))
    const res1 = { comment: comment, writtenById: id, bookId: BookId};
    const jsonres = JSON.stringify(res1);
    $.ajax({
        method: "POST",
        url: `http://bookservice:88/books/setcomment`,
        data: jsonres,
        success: function () {
            console.log('комментарий оставлен');
        },
        error: function () {
            console.log('error');
        }
    });});
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
            <div class="info__usercomment">
                 <img id="Avavat${comment.author.id}" src="Static/avatars/${comment.author.image}" alt="userIcon">
                 <h4>${comment.author.login}</h4>
             </div>
        <div id ="authorId${comment.author.id}" >
      </div>
    </div>
    `;
        const commentsAuthor = comment.commentsAuthor.map( comment => comment);

        const commentsHtml = document.getElementById(`authorId${comment.author.id}`);
        console.log(commentsHtml);
        commentsAuthor.forEach( e => { e.createdAt = e.createdAt.replace('.000', ''); commentsHtml.innerHTML += `<div class="message"><p>${e.comment}</p> <span>${e.createdAt}</span></div>` });
    });
}
$(function() {
    $('.info__usercomment').find('img[src=""]').each(function() {
        this.src = 'name.gif'
    })
});
$('input[name="rating"]').click(() => {
    let value =  $('input[name="rating"]:checked').val();
    alert(value);
    $.ajax({
        method: "POST",
        url: `http://bookservice:88/books/setrating`,
        data: JSON.stringify({rating: value, authorById: 1, bookId: id}),
        success: function () {
            console.log('комментарий оставлен');
        },
        error: function () {
            console.log('error');
        }
    });
});
//init
// (async () => {
//     await passport()
//
// })();
passport()