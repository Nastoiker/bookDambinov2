async function getBooks() {
    return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllUsers() {
    return new Promise(resolve => fetch('http://bookservice:88/admin/users').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllAuthor() {
    return new Promise(resolve => fetch('http://bookservice:88/books/authors').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllGenre() {
    return new Promise(resolve => fetch('http://bookservice:88/books/getgenres').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
// async function getAllComments() {
//     return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
// }
async function passport() {


    const users = await getAllUsers();
    showUsers(users);
    const books = await getBooks();
    showBooks(books.books);
    await showAuthors();
    await showGenres();
}
function showUsers(arr) {
    const userWrapper = document.getElementById('users');

    arr.forEach(user => {
        let doit = user.status === 'banned' ? 'разбанить' : 'забанить';
            userWrapper.innerHTML +=`<tr>
            <td>${user.id}</td>
            <td>${user.email}</td>
            <td>${user.login}</td>
            <td>${user.image}</td>
            <td>${user.role}</td>
            <td>${user.status}</td>
            <td><button onclick="banUser(${user.id})">${doit}</button></td>
        </tr>`
    });
}

async function deleteBoook(id) {
    id = Number(id);
    console.log(id);
   await fetch('http://bookservice:88/admin/deletebook', {method: 'POST', body: JSON.stringify({id: id})});
}
async function banUser(id) {
    id = Number(id);
    const query = await fetch('http://bookservice:88/user/banuser', {method: 'POST', body: JSON.stringify({id: id})});
    const users = await getAllUsers();
    showUsers(users);
}
async function showAuthors() {
    const authors = await getAllAuthor();
    authors.forEach(author => {
        document.getElementById('authors').innerHTML +=`<option value="${author.id}">${author.firstName + ' ' +author.lastname}</option>`
    })
};
async function showGenres() {
    const genres = await getAllGenre();
    genres.forEach(genre => {
        document.getElementById('genres').innerHTML +=`<option value="${genre.id}">${genre.name}</option>`
    })
};
function showBooks(arr) {
    const bookWrapper = document.getElementById('books');
    arr.forEach(book=> {
        bookWrapper.innerHTML +=` <tr>
            <td>${book.book.id}</td>
            <td>${book.book.name}</td>
            <td>${book.book.releseYear}</td>
            <td>${book.book.description}</td>
            <td>${book.book.img}</td>
            <td><button onclick="deleteBoook(${book.book.id})">удалить</button></td>
            <td><button onClick="eddit(${book.book.id})">редактировать</button></td>
        </tr>`
    })
}
(async () => {
    await passport()

})();
$("#create_author").submit(function(e){
    e.preventDefault();
    let DataAuthor = new FormData();
    let firstName = $('#firstName_Author').val();
    let lastName = $('#lastName_Author').val();
    let image = $('#image_author')[0].files[0];
    DataAuthor.append('firstName', `${firstName}`);
    DataAuthor.append('lastName', `${lastName}`);
    DataAuthor.append('image', image);
    $.ajax({
        method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
        url: `http://bookservice:88/admin/newauthor`,
        data: DataAuthor,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            console.log('ok');
        },
        error: function (e) {
            console.log(e);
        }
    });
});
$("#create_book").submit(function(e){
    e.preventDefault();
    let DataBook = new FormData();
    let name_book = $('#name_book').val();
    DataBook.append('Name', name_book);
    let release = $('#release').val();
    DataBook.append('releseYear', `${release}`);
    let description = $('#description').val();
    DataBook.append('description', `${description}`);
    let image = $('#image_file')[0].files[0];
    DataBook.append('image', image);
    let genres = $('#genres :selected')
        .map((i, el) => Number(el.value))
        .toArray();
    let authors = $('#authors :selected')
        .map((i, el) => Number(el.value))
        .toArray();
    authors = authors.join();
    genres = genres.join()
    DataBook.append('authorId', `${genres}`);
    DataBook.append('GenreId', `${authors}`);
    console.log(DataBook.get('authorId'));
    for (let pair of DataBook.entries()) {
        console.log(pair[0]+ ', ' + pair[1]);
    }

    $.ajax({
        method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
        url: `http://bookservice:88/admin/createbook`,
        data: DataBook,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            console.log('ok');
        },
        error: function (e) {
           console.log(e);
        }
    });
});