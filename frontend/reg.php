<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
    <link rel="stylesheet" href="assets/styles/reg.css">
</head>
<body>
<form>
    <img onclick="window.location.href =`./index.php`" src="assets/src/icons/arrow_more.svg" style="transform: rotate(180deg)" alt="">

    <input id="input-1" type="text" placeholder="John Doe" required autofocus />
    <label for="input-1">
        <span class="label-text">Full Name</span>
        <span class="nav-dot"></span>
        <div class="signup-button-trigger">Sign Up</div>
    </label>
    <input id="input-2" type="text" placeholder="john" required />
    <label for="input-2">
        <span class="label-text">Username</span>
        <span class="nav-dot"></span>
    </label>
    <input id="input-3" type="email" placeholder="email@address.com" required />
    <label for="input-3">
        <span class="label-text">Почта</span>
        <span class="nav-dot"></span>
    </label>
    <input id="input-4" type="text" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
    <label for="input-4">
        <span class="label-text">Пароль</span>
        <span class="nav-dot"></span>
    </label>
    <input id="input-5" type="text" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
    <label for="input-5">
        <span class="label-text">Подтвердите пароль</span>
        <span class="nav-dot"></span>
    </label>
    <button type="submit">Зарегестрироваться</button>
    <p class="tip">Enter</p>
    <div class="signup-button">Зарегестироваться</div>
</form>
</body>
</html>