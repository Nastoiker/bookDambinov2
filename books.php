
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>damir</title>
    <link rel="stylesheet" href="assets/styles/styles.css">

</head>
<?php include 'header.php';?>
<body>



<div class="popular">
    <div class="filter">
        <h2>Книги</h2>
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
</body>
<?php include 'footer.php';?>
<script src="assets/js/books.js"></script>

</html>