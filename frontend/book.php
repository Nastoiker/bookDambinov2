
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
    <div style="display: flex; justify-content: space-between; align-items: center">
        <h3>Оставьте свой комментарий</h3>
        <fieldset class="rating">
            <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
            <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
            <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
            <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
            <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
            <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
        </fieldset>
    </div>
    <textarea class="comment_text" name="comment" id="" cols="50" rows="5" placeholder="Оставить комментарий"></textarea>

    <button type="submit" style="display: block">отправить</button>
</form>
<div class="comment">

</div>
</body>
<?php include 'footer.php';?>

<script src="assets/js/book.js"></script>
</html>