<?php

// paths

$router->get('/:name', function($param) {
    echo
        'Welcome To The Library'  . $param['name'];
        

});

// Get All Books And Authors
$router->get('/all', 'Books@index');

$router->get('/install', 'System@index');

// books router
$router->get('/books', 'Books@books');

// search books
$router->get('/books/name/:name', 'Books@searchBooksByTitle');

$router->get('/books/isbn/:isbn', 'Books@searchBooksByISBN');

$router->get('/books/author/:author', 'Books@searchBooksByAuthors');
$router->get('/books/author/:author/:page', 'Books@searchBooksByAuthors');

// authors router
$router->get('/authors', 'Books@authors');
$router->get('/authors/:page', 'Books@authors');

// search author
$router->get('/authors/:author', 'Books@searchBooksByAuthors');
$router->get('/authors/:author/:page', 'Books@searchBooksByAuthors');
$router->get('/home', 'home@index');
$router->get('/books/getbooksbygenre/:genreId', 'Books@getBooksByGenre');

// If you use SPACE in the url, it should convert the space to -, /home-index
$router->get('/home index', 'User@index');
$router->post('/user', 'User@post');
$router->post('/user/registration', 'User@Registration');
$router->post('/user/auth', 'User@auth');

$router->post('/books/setcomment', 'Books@setCommentByBookId');
$router->post('/books/setrating', 'Books@setRatingForBook');
$router->post('/books/setpicture', 'Books@uploadImage');
