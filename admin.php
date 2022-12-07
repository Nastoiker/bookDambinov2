<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css" />
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <script>
        if(localStorage.getItem('role')!=='admin') {
            window.location.href='./index.php';
            console.log(1);
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/styles/admin.css">
    <title>admin</title>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        admin
        <a
                class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"

                id="logoutAdmin"
        >выйти</a
        >


    </div>
</nav>

<main class="mt-5 pt-3">



                <div class="card">
                    <div class="card-header">
                        <span><i ></i></span> Книги
                    </div>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search..." id="search_book">
                    </form>
                    <div id="visibleBook" class="card-body visible">

                            <table
                                    id="books"
                                    class="table"
                                    style="width: 100%">

                              >
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>release</th>
                                    <th>description</th>
                                    <th>img</th>
                                    <th>delete</th>
                                    <th>eddit</th>
                                </tr>
                                </thead>
                                <tbody id="books">

                                </tbody>
                            </table>
                    </div>
                    <button id="BtnshowBookAll" onclick="showBookAll()">Вывести</button>
    </div>
    <div class="card">
        <div class="card-header">
            <span><i ></i></span> Пользователи
        </div>
        <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search..." id="search_user">
        </form>
        <div id="visibleUsers" class="card-body visible">

            <table
                    class="table"
                    style="width: 100%"
            >

                <thead>
                <tr>
                    <th>id</th>
                    <th>email</th>
                    <th>login</th>
                    <th>image</th>
                    <th>role</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody id="users">

                </tbody>
            </table>
        </div>
        <button id="BtnshowUserAll" onclick="showUserAll()">Вывести</button>
    </div>
    <div class="card">
        <div class="card-header">
            <span><i ></i></span> Комментарии
        </div>
        <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search..." id="search_comment">
        </form>
        <div id="visibleComment" class="card-body visible">

            <table
                    class="table"
                    style="width: 100%"
            >

                <thead>
                <tr>
                    <th>id</th>
                    <th>createdAt</th>
                    <th>comment</th>
                    <th>writtenById</th>
                    <th>bookId</th>
                </tr>
                </thead>
                <tbody id="comments">

                </tbody>
            </table>
        </div>
        <button id="BtnshowCommentsAll" onclick="showCommentsAll()">Вывести</button>
    </div>
    <form class="card" id="create_author" enctype="multipart/data">
        <h1>Создание нового автора</h1>
        <p><input type="text" id="firstName_Author" required placeholder="firstName_Author" name="name"></p>
        <p><input type="text" id="lastName_Author" required placeholder="lastName_Author" name="description"></p>
        <label for="image_file" required>Фотка автора </label>
        <p> <input id="image_author" required name="image_author"  type="file" accept="image/jpeg,image/png,image/jpg"/></p>
        <p><input type="submit" value="Отправить"></p>
    </form>
    <form class="card" id="create_genre" enctype="multipart/data">
        <h1>Добавление нового жанра</h1>
        <p><input type="text" id="nameGenre" required placeholder="жанр" name="name"></p>
        <p> <input id="image_genre" name="image_genre" required type="file" accept="image/jpeg,image/png,image/jpg"/></p>
        <p><input type="submit" value="Отправить"></p>
    </form>
    <form class="card" id="create_book" enctype="multipart/data">
        <h1 id="titleEdditCreatBook">Создание новой книги</h1>
        <p><input type="text" id="name_book" required placeholder="name" name="name"></p>
        <p><input type="date" id="release"  required placeholder="release" name="release"></p>
        <p><input type="text" id="description" required placeholder="description" name="description"></p>
        <label for="image_file">обложка </label>
        <p> <input id="image_file" name="image_file" type="file" accept="image/jpeg,image/png,image/jpg"/></p>
        <p>
            <label for="authors">Выберите жанры(ы)</label>
            <br>
            <select required size="5" multiple id="genres" name="genres">
                <option  disabled>Выберите жанр(ы)</option>
            </select>
        </p>
        <p>
            <label for="authors">Выберите автора(ы)</label>
            <br>
            <select required size="5" multiple id="authors" name="authors">
                <option  disabled></option>
            </select>
        </p>
        <p><input type="submit" value="Отправить"></p>
    </form>

</main>
<script src="assets/js/admin.js"> </script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</body>
</html>