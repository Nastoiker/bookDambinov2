
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>damir</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/genres.css">

</head>
<?php include 'header.php';
?>
<body>

        <div class="welcome">
            <div class="left-side-welcome">
                <h1>
                    Книги могут изменить вашу жизнь
                </h1>
                <p>Книжный сервис</p>
                <button id="welcome__registration" class="welcome__registration">регистрация</button>
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
                    <div onclick="sortGenre(1)"><p>Популярные</p></div>
                    
                </div>
            </div>
            <div class="container_genres">
                <div  onclick="window.location.href =`./genre.php?id=4`" id="genreCard4" data-genres="Детектив">
                    <div class="info_genre"><h3>Детектив</h3><span id="genres4" class="count_Bygenres"></span></div>
                    <img src="assets/src/genres/66.jpg" alt="genres">
                </div>
                <div onclick="window.location.href =`./genre.php?id=5`" id="genreCard5" data-genres="Приключения">
                    <div class="info_genre"><h3>Приключения</h3><span id="genres5" class="count_Bygenres"></span></div>
                    <img src="assets/src/genres/advanteres.jpg" alt="genres">
                </div>
                <div  onclick="window.location.href =`./genre.php?id=2`" id="genreCard2" data-genres="Драмма">
                    <div class="info_genre"><h3>Драмма</h3><span id="genres2" class="count_Bygenres"></span></div>
                    <img src="assets/src/genres/dramma.jpg" alt="genres">
                </div>
                <div  onclick="window.location.href =`./genre.php?id=3`" id="genreCard3" data-genres="Фантастика">
                    <div class="info_genre"><h3>Фантастика</h3><span id="genres3" class="count_Bygenres"></span></div>
                    <img src="assets/src/genres/fantasy.jpg" alt="genres">
                </div>
                <div  onclick="window.location.href =`./genre.php?id=1`"id="genreCard1" data-genres="Мистика">
                    <div class="info_genre"><h3>Мистика</h3><span id="genres1" class="count_Bygenres"></span></div>
                    <img src="assets/src/genres/mistikjpg.jpg" alt="genres">
                </div>

            </div>
            <div class="more_book"><a href=""><h3>Посмотреть все</h3> <img src="assets/src/icons/arrow_more.svg" alt=""></a></div>
        </div>
    <div class="popular">
        <div class="filter">
            <h2>Популярные</h2>
            <div class="filter_btns">
                <img src="assets/src/icons/sort.svg" class="sort_img" alt="sort">
                <div onclick="sort(1)"><p id="sortBtnBook">По рейтингу</p></div>
                <div onclick="sort(2)"><p>По популярности</p></div>
                <div onclick="sort(3)"><p>Новые</p></div>
            </div>
        </div>
        <div class="container_book">
        </div>
        </div>

        <div class="more_book"><a href="" >
          <h3>Посмотреть все</h3>
          <img src="assets/src/icons/arrow_more.svg" alt="">
        </a>
      </div>

</body>
<script src="assets/js/script.js"></script>

<?php include 'footer.php';?>

</html>