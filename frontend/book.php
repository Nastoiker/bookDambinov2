
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>damir</title>
    <link rel="stylesheet" href="assets/styles/styles.css">

    <link rel="stylesheet" href="assets/styles/bookpage.css">
</head>
<?php include 'header.php';?>
<body>
<style>
    textarea {
        padding: 10px;
    };
</style>
<div  class="wrapper__book">

</div>
<form class="form_comment">
    <h3>Оставьте свой комментарий</h3>
    <textarea class="comment_text" name="comment" id="" cols="50" rows="5" placeholder="Оставить комментарий"></textarea>
    <button type="submit" style="display: block">отправить</button>
</form>
<div class="comment">

</div>
</body>
<?php include 'footer.php';?>
<script src="assets/js/comment.js"></script>

<script src="assets/js/book.js"></script>
</html>