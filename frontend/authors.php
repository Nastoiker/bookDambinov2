
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>damir</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="assets/styles/authors.css">
</head>
<?php include 'header.php';?>
<body>



</body>
<div class="popular">
    <div class="filter">
        <h2>Авторы</h2>
        <div class="filter_btns">
            <img src="assets/src/icons/sort.svg" class="sort_img" alt="sort">
            <div onclick="sort(1)"><p id="sortBtnBook">По рейтингу</p></div>
            <div onclick="sort(2)"><p>По популярности</p></div>
            <div onclick="sort(3)"><p>Новые</p></div>
        </div>
    </div>
    <div class="container_authors">

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
<script src="assets/js/authors.js"></script>

</html>