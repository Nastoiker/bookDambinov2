async function getBooks() {
    return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllUsers() {
    return new Promise(resolve => fetch('http://bookservice:88/admin/users').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllAuthor() {
    return new Promise(resolve => fetch('http://bookservice:88/authors').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllGenre() {
    return new Promise(resolve => fetch('http://bookservice:88/books/getgenres').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
// async function getAllComments() {
//     return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
// }
async function passport() {
    const users = await getAllUsers();
    const books = await getBooks();
    showUsers(users);
    showBooks(books.books);
    await showAuthors();
    await showGenres();
}
function showUsers(arr) {
    const userWrapper = document.getElementById('users');
    arr.forEach(user => {
        userWrapper.innerHTML +=`<tr>
            <td>${user.id}</td>
            <td>${user.email}</td>
            <td>${user.login}</td>
            <td>${user.image}</td>
            <td>${user.role}</td>
            <td>${user.status}</td>
            <td><button onclick="banUser(${user.id})">забанить</button></td>
        </tr>`
    });
}
async function showAuthors() {
    const authors = await getAllAuthor();
    authors.forEach(author => {
        document.getElementById('authors').innerHTML +=`<option value="${author.id}">${author.firstName + ' ' +author.lastname}</option>`
    })
};
async function showGenres() {
    const authors = await getAllGenre();
    authors.forEach(genre => {
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
            <td><button>удалить</button></td>
            <td><button>редактировать</button></td>
        </tr>`
    })
}
(async () => {
    await passport()

})();
$("#create_book").submit(function(e){

    e.preventDefault();

    DataBook = new FormData();
    let name_book = $('#name_book').val();
    DataBook.append('Name', name_book);
    let release = $('#release').val();
    DataBook.append('releseYear', release);
    let description = $('#description').val();
    DataBook.append('description', description);
    let image = $('#image_file')[0].files[0];
    DataBook.append('image', image);


    const genres = $('#genres :selected')
        .map((i, el) => Number(el.value))
        .toArray();
    let authors = $('#authors :selected')
        .map((i, el) => Number(el.value))
        .toArray();
    console.log(authors);
    DataBook.append('authorId', genres);
    DataBook.append('GenreId', authors);
    $.ajax({
        method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
        url: `http://bookservice:88/admin/createbook`,
        data: DataBook,
        processData: false,
        cache: false,
        success: function (response) {
            console.log('ok');
        },
        error: function () {
            $('.notify').text('ошибка регистрации');
            $('.notify').css('background', 'red');
            $('.notify').fadeIn(function () {
                $('.notify').animate({
                    'width': '100%',
                    'left': 0
                }, 1000).animate({'top': 0});
            });
        }
    });
});