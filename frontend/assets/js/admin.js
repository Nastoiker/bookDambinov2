async function getBooks() {
    return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllUsers() {
    return new Promise(resolve => fetch('http://bookservice:88/admin/users').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllAuthor() {
    return new Promise(resolve => fetch('http://bookservice:88/authors').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
// async function getAllGenre() {
//     return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
// }
// async function getAllComments() {
//     return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
// }
async function passport() {
    const users = await getAllUsers();
    const books = await getBooks();
    showUsers(users);
    showBooks(books.books);
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
    let email = $('#emailInput').val();
    let login = $('#loginInput').val();
    let password = $('#passwordInput').val();
    let image = $('#image_file')[0].files[0];
    DataImage.append('image', image);
    const res1 = { email: email, login: login, password};
    const jsonres = JSON.stringify(res1);
    $.ajax({
        method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
        url: `http://bookservice:88/user/registration`,
        data: jsonres,
        processData: false,
        cache: false,
        success: function (response) {
            localStorage.setItem('id', response.data.id);
            localStorage.setItem('email', response.data.email);
            localStorage.setItem('login', response.data.login);
            let id = Number(response.data.id);
            DataImage.append('userId', id);
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