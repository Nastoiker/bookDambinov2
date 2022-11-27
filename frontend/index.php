
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>damir</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/genres.css">
    <script src="assets/js/script.js"></script>

</head>
<?php include 'header.php';?>
<body>

    <body>
        <div class="welcome">
            <div class="left-side-welcome">
                <h1>
                    Книги могут изменить вашу жизнь
                </h1>
                <p>Книжный сервис</p>
                <button class="welcome__registration">регистрация</button>
            </div>
            <div class="right-side-welcome">
                <img src="assets/src/imgs/welcome.jpg" alt="">
            </div>
        </div>

        <div class="genres">
            <div class="filter">
                <h2>Жанры</h2>
                <div class="filter_btns">
                    <img src="assets/src/icons/sort.svg" class="sort_img" alt="sort">
                    <div><p>Популярные</p></div>
                    <div><p>Популярное  в наличиии</p></div>
                    <div><p>Рейтинг</p></div>
                </div>
            </div>
            <div class="container_genres">
                <div  onclick="window.location.href =`./genre.php?id=4`" data-genres="Детектив">
                    <h3>Детектив</h3>
                    <img src="assets/src/genres/66.jpg" alt="genres">
                </div>
                <div onclick="window.location.href =`./genre.php?id=5`" data-genres="Приключения">
                    <h3>Приключения</h3>
                    <img src="assets/src/genres/advanteres.jpg" alt="genres">
                </div>
                <div  onclick="window.location.href =`./genre.php?id=2`" data-genres="Драмма">
                    <h3>Драмма</h3>
                    <img src="assets/src/genres/dramma.jpg" alt="genres">
                </div>
                <div  onclick="window.location.href =`./genre.php?id=3`" data-genres="Фантастика">
                    <h3>Фантастика</h3>
                    <img src="assets/src/genres/fantasy.jpg" alt="genres">
                </div>
                <div  onclick="window.location.href =`./genre.php?id=1`" data-genres="Мистика">
                    <h3>Мистика</h3>
                    <img src="assets/src/genres/mistikjpg.jpg" alt="genres">
                </div>

            </div>
            <div class="more_book"><a href=""><h3>Посмотреть все</h3> <img src="assets/src/icons/arrow_more.svg" alt=""></a></div>
        </div>
    </body>
    <div class="popular">
        <div class="filter">
            <h2>Популярные</h2>
            <div class="filter_btns">
                <img src="assets/src/icons/sort.svg" class="sort_img" alt="sort">
                <div><p id="sortBtnBook">По рейтингу</p></div>
                <div><p>По популярности</p></div>
                <div><p>Новые</p></div>
            </div>
        </div>
        <div class="container_book">

            </div>
        </div>
         
        </div>
        </div>
        <div class="more_book"><a href="" >
          <h3>Посмотреть все</h3>
          <img src="assets/src/icons/arrow_more.svg" alt="">
        </a>
      </div>
    </div>
</body>
<?php include 'footer.php';?>

</html>