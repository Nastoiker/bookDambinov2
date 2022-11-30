
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>damir</title>
    <link rel="stylesheet" href="assets/styles/styles.css">


</head>
<?php include 'header.php';?>
<div class="filter">
    <h1 id="titleGenre"></h1>
    <div class="filter_btns">
        <img src="assets/src/icons/sort.svg" class="sort_img" alt="sort">
        <div onclick="sort(1)"><p id="sortBtnBook">По рейтингу</p></div>
        <div onclick="sort(2)"><p>По популярности</p></div>
        <div onclick="sort(3)"><p>Новые</p></div>
    </div>
</div>
<body >

    <div class="container_book">

    </div>
</body>
<script src="assets/js/book_genre.js"></script>

<?php include 'footer.php';?>

</html>