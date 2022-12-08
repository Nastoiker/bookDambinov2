document.getElementById('logoutAdmin').addEventListener('click',  () => {
    localStorage.clear();
    window.location.href='./index.php';
});
async function getBooks() {
    return new Promise(resolve => fetch('http://bookDambinov2:80/backend/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllUsers() {
    return new Promise(resolve => fetch('http://bookDambinov2:80/backend/admin/users').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllAuthor() {
    return new Promise(resolve => fetch('http://bookDambinov2:80/backend/books/authors').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllGenre() {
    return new Promise(resolve => fetch('http://bookDambinov2:80/backend/books/getgenres').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
async function getAllComments() {
    return new Promise(resolve => fetch('http://bookDambinov2:80/backend/admin/getallcomments').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
$('#search_book').on('keyup', function() {
    var value = $(this).val();
    var patt = new RegExp(value, "i");
    $('#books').find('tr').each(function() {
        var $table = $(this);
        if (!($table.find('td').text().search(patt) >= 0)) {
            $table.not('.t_head').hide();
        }
        if (($table.find('td').text().search(patt) >= 0)) {
            $(this).show();
        }
    });
});
$('#search_user').on('keyup', function() {
    var value = $(this).val();
    var patt = new RegExp(value, "i");

    $('#users').find('tr').each(function() {
        var $table = $(this);

        if (!($table.find('td').text().search(patt) >= 0)) {
            $table.not('.t_head').hide();
        }
        if (($table.find('td').text().search(patt) >= 0)) {
            $(this).show();
        }

    });

});
$('#search_comment').on('keyup', function() {
    var value = $(this).val();
    var patt = new RegExp(value, "i");

    $('#comments').find('tr').each(function() {
        var $table = $(this);

        if (!($table.find('td').text().search(patt) >= 0)) {
            $table.not('.t_head').hide();
        }
        if (($table.find('td').text().search(patt) >= 0)) {
            $(this).show();
        }

    });
});
async function passport() {
    const users = await getAllUsers();
    showUsers(users);
    const books = await getBooks();
    showBooks(books.books);
    const comments = await getAllComments();
    showComments(comments);
    await showAuthors();
    await showGenres();
}
function showUsers(arr) {
    const userWrapper = document.getElementById('users');
    userWrapper.innerHTML = '';
    arr.forEach(user => {
        let doit = user.status === 'banned' ? '' : 'забанить';
            if (user.status !== 'banned') {
                userWrapper.innerHTML +=`<tr>
            <td>${user.id}</td>
            <td>${user.email}</td>
            <td>${user.login}</td>
            <td>${user.image}</td>
            <td>${user.role}</td>
            <td>${user.status}</td>
            <td><button onclick="banUser(${user.id})">${doit}</button></td>
        </tr>`
            } else {
                userWrapper.innerHTML +=`<tr>
            <td>${user.id}</td>
            <td>${user.email}</td>
            <td>${user.login}</td>
            <td>${user.image}</td>
            <td>${user.role}</td>
            <td>${user.status}</td>
        </tr>`
            }

    });
}

function showComments(arr) {
    const commentWrapper = document.getElementById('comments');
    commentWrapper.innerHTML = '';
    arr.forEach(comment => {
        commentWrapper.innerHTML +=`<tr>
            <td>${comment.id}</td>
            <td>${comment.createdAt}</td>
            <td>${comment.comment}</td>
            <td>${comment.writtenById}</td>
            <td><a href="./book.php?id=${comment.bookId}">${comment.bookId}</a></td>
            <td><button onclick="deleteComment(${comment.id})">удалить</button></td>
        </tr>`
    });
}
async function deleteBoook(id) {
    id = Number(id);
    await fetch('http://bookDambinov2:80/backend/admin/deletebook', {method: 'POST',  body: JSON.stringify({id: id})});
    await passport();
}
async function deleteComment(id) {
    id = Number(id);
    await fetch('http://bookDambinov2:80/backend/admin/deletecomment', {method: 'POST', body: JSON.stringify({id: id})});

    await passport();
}

async function banUser(id) {
    id = Number(id);
    const query = await fetch('http://bookDambinov2:80/backend/user/banuser', {method: 'POST', body: JSON.stringify({id: id})});
    const users = await getAllUsers();
    showUsers(users);
}
async function showAuthors() {
    const authors = await getAllAuthor();
    document.getElementById('authors').innerHTML = '';
    authors.forEach(author => {
        document.getElementById('authors').innerHTML +=`<option value="${author.id}">${author.firstName + ' ' +author.lastname}</option>`
    })
};
function showUserAll() {
    const visible = document.getElementById('visibleUsers');
    const btn = document.getElementById('BtnshowUserAll')
    if(visible.classList.contains('visible')) {
        visible.classList.remove('visible');
        btn.innerHTML = 'Скрыть';
    } else {
        visible.classList.add('visible');
        btn.innerHTML = 'Вывести';

    }
}
function showBookAll() {
    const visible = document.getElementById('visibleBook');
    const btn = document.getElementById('BtnshowBookAll')
    if(visible.classList.contains('visible')) {
        visible.classList.remove('visible');
        btn.innerHTML = 'Скрыть';
    } else {
        visible.classList.add('visible');
        btn.innerHTML = 'Вывести';

    }
}
function showCommentsAll() {
    const visible = document.getElementById('visibleComment');
    const btn = document.getElementById('BtnshowCommentsAll')
    if(visible.classList.contains('visible')) {
        visible.classList.remove('visible');
        btn.innerHTML = 'Скрыть';
    } else {
        visible.classList.add('visible');
        btn.innerHTML = 'Вывести';

    }
}
async function showGenres() {
    const genres = await getAllGenre();
    document.getElementById('genres').innerHTML = '';
    genres.forEach(genre => {
        document.getElementById('genres').innerHTML +=`<option value="${genre.id}">${genre.name}</option>`
    })
};
function showBooks(arr) {
    const bookWrapper = document.getElementById('books');
    bookWrapper.innerHTML = '';
    arr.forEach(book => {
        bookWrapper.innerHTML +=` <tr>
            <td><a href="./book.php?id=${book.book.id}">${book.book.id}</a></td>
            <td>${book.book.name}</td>
            <td>${book.book.releseYear}</td>
            <td>${book.book.description}</td>
            <td>${book.book.img}</td>
            <td><button onclick="deleteBoook(${book.book.id})">удалить</button></td>
            <td><button onclick="eddit('${book.book.name}', '${book.book.description}', '${book.book.releseYear}')">редактировать</button></td>
        </tr>`
    });
}
function scrollTo(element)
{
    window.scroll({
        left: 0,
        top: element.offsetTop,
        behavior: 'smooth'
    })
}
function eddit(name, description, releseYear) {
    document.getElementById("titleEdditCreatBook").innerHTML = 'Редактирование';
    document.getElementById("name_book").value = name;
    document.getElementById("release").value = releseYear;
    document.getElementById("description").value = description;
    scrollTo(document.getElementById("create_book"));
}
passport();
// (async () => {
//     await passport()
//
// })();
$("#create_genre").submit(async function(e){
    e.preventDefault();
    let DataGenre = new FormData();
    let name = $('#nameGenre').val();
    let image = $('#image_genre')[0].files[0];
    DataGenre.append('image', image);
    DataGenre.append('name', name);
    $.ajax({
        method: "POST",
        url: `http://bookDambinov2:80/backend/admin/newgenre`,
        data: DataGenre,
        processData: false,
        contentType: false,
        cache: false,
        success: async function (response) {
            await passport();
            $("#create_genre")[0].reset();
        },
        error: function (e) {
        }
    });
});
$("#create_author").submit(async function(e){
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
        url: `http://bookDambinov2:80/backend/admin/newauthor`,
        data: DataAuthor,
        processData: false,
        contentType: false,
        success: async function (response) {
            $("#create_author")[0].reset();
            await passport();
        },
        error: function (e) {
        }
    });
});
$("#create_book").submit(async function(e){
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
    DataBook.append('authorId', `${authors}`);
    DataBook.append('GenreId', `${genres}`);

    $.ajax({
        method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
        url: `http://bookDambinov2:80/backend/admin/createbook`,
        data: DataBook,
        processData: false,
        contentType: false,
        cache: false,
        success: async function (response) {
            await passport();
            $("#create_book")[0].reset();
        },
        error: function (e) {
        }
    });
});