
let get = location.search;
let id = get.replace( '?id=', '');
localStorage.setItem('BookId', id);
const bookInfo = document.querySelector(".wrapper__book");
const commentsBook = document.querySelector(".comment");
async function getBooks(id) {
    return new Promise(resolve => fetch(`http://bookservice:88/books/searchbooksbyid/${id}`).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getRatingByUser(userId, bookId) {
    return new Promise(resolve => fetch('http://bookservice:88/user/getratinguser', { method: 'POST', body: JSON.stringify({userId, bookId})}).then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
$(".form_comment").submit(async function(e){
    if(!localStorage.getItem('id')) {
        window.location.href = './reg.php';
    }
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
        success: async function () {
            await passport();
            console.log('комментарий оставлен');
            $(".form_comment")[0].reset();
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
    bookInfo.innerHTML = ` 
        <div class="leftsite">
        <h2>${object.name}</h2>
        <img  class="img_book"  src="./Static/Images/${object.img}" alt="book">
    </div>
    <div class="information">
        <div style="display: flex; align-items: center;"><div id="BookAvgRating${object.rating['round(AVG(rating),1)']}"></div>
<span style="margin-left: 10px;">${object.rating['round(AVG(rating),1)'] ?? 0}</span></div>
        <h3>Описание</h3>
        <p>${object.description}</p>
        <h4>Авторы</h4>
        <p>${object.author[0].firstName + ' ' + object.author[0].lastname}</p>
        <h4>Год издания</h4>
        <p>${object.releseYear}</p>
        <h4>Жанры</h4>
        <p>${object.genres.name}</p>
    </div>
    `;
    let ratingBook = Number(object.rating['round(AVG(rating),1)']);
    for (let i = 0; i < Math.trunc(ratingBook); i++) {
        document.getElementById(`BookAvgRating${object.rating['round(AVG(rating),1)']}`).innerHTML += '<img  style="width:32px; margin-left: 10px;" src="assets/src/icons/star.svg" alt=""/>'
    }
    let lastStar = ratingBook - Math.trunc(ratingBook);
    if (lastStar > 0) {
        document.getElementById(`BookAvgRating${object.rating['round(AVG(rating),1)']}`).innerHTML += `<svg width="0" height="0" viewBox="0 0 32 32">
  <defs>
    <linearGradient id="halfBook${object.id}" x1="0" x2="100%" y1="0" y2="0">
      <stop offset="${lastStar * 100}%" stop-color="#fed94b"></stop>
      <stop offset="${lastStar * 100}%" stop-color="#f7efc5"></stop>
    </linearGradient>
    
    <symbol viewBox="0 0 32 32" id="starBook${object.id}">
      <path d="M31.547 12a.848.848 0 00-.677-.577l-9.427-1.376-4.224-8.532a.847.847 0 00-1.516 0l-4.218 8.534-9.427 1.355a.847.847 0 00-.467 1.467l6.823 6.664-1.612 9.375a.847.847 0 001.23.893l8.428-4.434 8.432 4.432a.847.847 0 001.229-.894l-1.615-9.373 6.822-6.665a.845.845 0 00.214-.869z" />
    </symbol>
  </defs>
</svg>  <svg class="c-icon" width="32" height="32" viewBox="0 0 32 32">
        <use xlink:href="#starBook${object.id}" fill="url(#halfBook${object.id})"></use>
    </svg>`
    }
    if(ratingBook===0){
        for (let i = 0; i < 5; i++) {
            document.getElementById(`BookAvgRating${object.rating['round(AVG(rating),1)']}`).innerHTML += '<img  style="width:32px; margin-left: 10px;" src="assets/src/icons/grayStar.svg" alt=""/>'
        }
    }
}
const showComment = async (object) => {
    document.querySelectorAll('.comments').forEach(e => e.innerHTML ='');
    commentsBook.innerHTML = '';
    for (const comment of object) {
        commentsBook.innerHTML += `
    <div class="comments">
            <div class="info__usercomment" style="justify-content: space-between">
            <div class="info__usercomment">  <img id="Avavat${comment.author.id}" src="Static/avatars/${comment.author.image}" alt="userIcon">
                 <h4>${comment.author.login}</h4></div>
               <div class="info__usercomment" id="${comment.author.id}"></div>
             </div>
        <div id ="authorId${comment.author.id}" >
      </div>
    </div>
    `;
        let getRating = await getRatingByUser(comment.author.id, id);


        getRating = JSON.stringify(getRating);
        getRating = JSON.parse(getRating);
        console.log(getRating);
        let ratingUser = Number(getRating.rating.rating);
        const commentsAuthor = comment.commentsAuthor.map(comment => comment);
        document.getElementById(`${comment.author.id}`).innerHTML = '';
        for (let i = 0; i < Math.trunc(ratingUser); i++) {
            document.getElementById(`${comment.author.id}`).innerHTML += '<img  style="width:50px;" src="assets/src/icons/star.svg" alt=""/>'
        }
        let lastStar = ratingUser - Math.trunc(ratingUser);
        if (lastStar > 0) {
            document.getElementById(`${comment.author.id}`).innerHTML += `    <svg width="0" height="0" viewBox="0 0 32 32">
  <defs>
    <linearGradient id="half${comment.author.id}" x1="0" x2="100%" y1="0" y2="0">
      <stop offset="${lastStar * 100}%" stop-color="#fed94b"></stop>
      <stop offset="${lastStar * 100}%" stop-color="#f7efc5"></stop>
    </linearGradient>
    
    <symbol viewBox="0 0 32 32" id="star${comment.author.id}">
      <path d="M31.547 12a.848.848 0 00-.677-.577l-9.427-1.376-4.224-8.532a.847.847 0 00-1.516 0l-4.218 8.534-9.427 1.355a.847.847 0 00-.467 1.467l6.823 6.664-1.612 9.375a.847.847 0 001.23.893l8.428-4.434 8.432 4.432a.847.847 0 001.229-.894l-1.615-9.373 6.822-6.665a.845.845 0 00.214-.869z" />
    </symbol>
  </defs>
</svg>
                            

    <svg class="c-icon" width="32" height="32" viewBox="0 0 32 32">
        <use xlink:href="#star${comment.author.id}" fill="url(#half${comment.author.id})"></use>
    </svg>`;
        }
        const commentsHtml = document.getElementById(`authorId${comment.author.id}`);
        commentsHtml.innerHTML = '';
        console.log(commentsHtml);
        commentsAuthor.forEach(e => {
            e.createdAt = e.createdAt.replace('.000', '');
            if (e.writtenById === localStorage.getItem('id')) {
                commentsHtml.innerHTML += `<div class="message"><div style="display: flex; align-items: center"><p>${e.comment}</p>  <button style="margin-left: 20px; background: #be7b7b; color: white" onclick="deleteComment(${e.id})">удалить</button></div><span>${e.createdAt}</span></div>`;
            } else {
                commentsHtml.innerHTML += `<div class="message"><p>${e.comment}</p> <span>${e.createdAt}</span></div>`;
            }
        });
    }
}
$('input[name="rating"]').click(async () => {
    if(!localStorage.getItem('id')) {
        window.location.href = './reg.php';
    }
    let value = $('input[name="rating"]:checked').val();
    $.ajax({
        method: "POST",
        url: `http://bookservice:88/books/setrating`,
        data: JSON.stringify({rating: value, authorById: localStorage.getItem('id'), bookId: id}),
        success: async function () {
            console.log('комментарий оставлен');
            await passport()
        },
        error: function () {
            console.log('error');
        }
    });
});
async function deleteComment(idComment) {
    idComment = Number(idComment);
    console.log(idComment);
    await fetch('http://bookservice:88/admin/deletecomment', {method: 'POST', body: JSON.stringify({id: idComment})});
    const res = await getBooks(id);
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    showComment(res1.comment);
}
passport();