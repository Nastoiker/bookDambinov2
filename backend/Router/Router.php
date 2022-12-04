<?php




$router->get('/all', 'Books@index');

$router->get('/install', 'System@index');

$router->get('/books', 'Books@books');

$router->post('/books/name', 'Books@searchBooksByTitle');


$router->get('/books/author/:author', 'Books@searchBooksByAuthors');

$router->get('/authors', 'Books@authors');
$router->post('/authors/name', 'Books@searchAthorByName');


$router->get('/authors/:author', 'Books@searchBooksByAuthors');
$router->get('/authors/:author/:page', 'Books@searchBooksByAuthors');
$router->get('/home', 'home@index');
$router->get('/books/getbooksbygenre/:genreId', 'Books@getBooksByGenre');

$router->get('/home index', 'User@index');
$router->post('/user', 'User@post');
$router->post('/user/registration', 'User@Registration');
$router->post('/user/auth', 'User@auth');

$router->post('/books/setcomment', 'Books@setCommentByBookId');
$router->post('/books/setrating', 'Books@setRatingForBook');
$router->post('/books/setpicture', 'Books@uploadImage');
$router->get('/books/searchbooksbyid/:id', 'Books@searchBooksById');
$router->post('/user/setavatar', 'User@uploadImage');
$router->post('/user/banuser', 'User@banUser');
$router->post('/books/getuserbyid', 'Books@getUserByid');
$router->delete('/books/getuserbyid', 'Books@getUserByid');
$router->get('/books/getbooksbyauthors/:id', 'Books@getbooksbyauthors');
//admin
$router->get('/admin/users', 'Admin@getAllUser');
$router->post('/admin/createbook', 'Admin@createBook');

$router->post('/admin/deletebook', 'Admin@deleteBook');
$router->post('/admin/newgenre', 'Admin@createNewGenre');
$router->post('/admin/newauthor', 'Admin@newAuthor');
$router->get('/books/authors', 'Books@allAuthors');
$router->get('/books/getgenres', 'Books@getGenres');
$router->post('/admin/deletecomment', 'Admin@deleteComment');
$router->get('/admin/getallcomments', 'Admin@getAllComments');
