
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

        <div class="welcome aboutUs">
            <div class="left-slide ">
                <div class="right-side-welcome" style="background-image: url('assets/src/imgs/favorite.jpg')">
                </div>
                <div class="right-side-welcome" style="background-image: url('assets/src/imgs/searchbook.jpg')">
                </div>
                <div class="right-side-welcome"  style="background-image: url('assets/src/imgs/welcome.jpg')">
                </div>
            </div>
            <div class="right-slide infoAbout">
                <div class="">
                    <h1>
                        Книги могут изменить вашу жизнь
                        <p>Книжный сервис</p>
                        <button id="welcome__registration" class="welcome__registration" onclick="window.location.href = 'reg.php'">регистрация</button>
                    </h1>


                </div>
                <div class="">
                    <h1>

                      На этом сайте вы можете найти подходящую для вас книгу

                    </h1>
                </div>
                <div class="">
                    <h1>
                         Оставьте отзыв на понравшуюся вам книгу!
                    </h1>
                </div>

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


            </div>
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

        <div class="more_book" id="more_book"><a>
          <h3>Посмотреть все</h3>
          <img src="assets/src/icons/arrow_more.svg" alt="">
        </a>
      </div>

</body>

<script src="assets/js/script.js"></script>
<script src="assets/js/scroll.js"></script>
<?php include 'footer.php';?>

</html>