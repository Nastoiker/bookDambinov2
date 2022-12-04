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
        <div><svg width="0" height="0" viewBox="0 0 32 32">
  <defs>
    <linearGradient id="half${object.id}" x1="0" x2="100%" y1="0" y2="0">
      <stop offset="${(object.rating['round(AVG(rating),1)'] / 5) * 100}%" stop-color="#fed94b"></stop>
      <stop offset="${(object.rating['round(AVG(rating),1)'] / 5) * 100}%" stop-color="#f7efc5"></stop>
    </linearGradient>
    
    <symbol viewBox="0 0 32 32" id="star${object.id}">
      <path d="M31.547 12a.848.848 0 00-.677-.577l-9.427-1.376-4.224-8.532a.847.847 0 00-1.516 0l-4.218 8.534-9.427 1.355a.847.847 0 00-.467 1.467l6.823 6.664-1.612 9.375a.847.847 0 001.23.893l8.428-4.434 8.432 4.432a.847.847 0 001.229-.894l-1.615-9.373 6.822-6.665a.845.845 0 00.214-.869z" />
    </symbol>
  </defs>
</svg>  <svg class="c-icon" width="32" height="32" viewBox="0 0 32 32">
        <use xlink:href="#star${object.id}" fill="url(#half${object.id})"></use>
    </svg>
<span>${object.rating['round(AVG(rating),1)'] ?? 0}</span></div>
        <h3>Описание</h3>
        <p>${object.description}</p>
        <h4>авторы</h4>
        <p>${object.author[0].firstName + ' '+ object.author[0].lastname}</p>
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