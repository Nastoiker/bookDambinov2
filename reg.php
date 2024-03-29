<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
    <link rel="stylesheet" href="assets/styles/reg.css">
</head>
<script
        src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'>
</script>
<body>
<img onclick="window.location.href =`./index.php`" src="assets/src/icons/arrow_more.svg" autofocus style="transform: rotate(180deg)" alt="">
<?php
?>

<form id="msform" enctype="multipart/data">
    <ul id="progressbar">
        <li class="active">Персональные данные</li>
        <li>Пароль</li>
        <li>Аватар</li>
    </ul>
    <fieldset>
        <h2 class="fs-title">Создать свой аккаунт</h2>
        <h3 class="fs-subtitle">Ваш профиль</h3>
        <input type="email" required id="emailInput" name="email" placeholder="Email" />
        <input type="text" required id="loginInput" name="login" placeholder="Логин" />
        <input type="button" name="next" class="next action-button" value="Далeе" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Пароль</h2>
        <h3 class="fs-subtitle">Укажите пароль для дальнейшнего использования</h3>
        <input type="password" required name="pass" id="passwordInput" placeholder="Пароль" />
        <input type="password" required id="passwordInputConfirm" name="cpass" placeholder="Подтвердите" />
        <input type="button" name="previous" class="previous action-button" value="Пред." />
        <input type="button" id="nextConfirm" name="next" class="next action-button" value="Далeе" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Установить аватарку </h2>
        <h3 class="fs-subtitle">опционально</h3>
        <input id="image_file" required type="file" accept="image/jpeg,image/png,image/jpg"/>
        <input type="button" name="previous" class="previous action-button" value="Пред." />
        <input type="submit" id ="regist" name="submit" class="submit action-button" value="Создать" />
    </fieldset>
    <div class="wrap">
        <div id="check-part-1" class="check-sign"></div>
        <div id="check-part-2" class="check-sign"></div>
    </div>

</form>
<div class="notify">
    Успешный вход
</div>

<script src="assets/js/reg.js"></script>

</body>
</html>