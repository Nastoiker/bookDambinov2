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


<form id="msform" enctype="multipart/data">
    <!-- progressbar -->
    <ul id="progressbar">
        <li class="active">Account Setup</li>
        <li>Social Profiles</li>
        <li>Personal Details</li>
    </ul>
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Создать свой аккаунт</h2>
        <h3 class="fs-subtitle">Ваш профиль</h3>
        <input type="text" name="email" placeholder="Email" />
        <input type="text" name="login" placeholder="Логин" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Пароль</h2>
        <h3 class="fs-subtitle">Укажите пароль для дальнейшнего использования</h3>
        <input type="password" name="pass" placeholder="Password" />
        <input type="password" name="cpass" placeholder="Подтвердите" />
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Установить аватарку </h2>
        <h3 class="fs-subtitle">опционально</h3>
        <input id="input-6" type="file" accept="image/jpeg,image/png,image/jpg"/>
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="submit" name="submit" class="submit action-button" value="Submit" />
    </fieldset>
</form>
<script src="assets/js/reg1.js"></script>

</body>
</html>