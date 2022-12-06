<header>
    <div>

    </div>
    <div class="logo" onclick="window.location.href =`./index.php`"><img src="assets/src/icons/logo.svg"  width="100px" alt="logo"></div>
    <div class="categories">
        <h4><a href="books.php">Книги</a></h4>
        <h4><a href="authors.php">Авторы</a></h4>
        <h4 id="genres_selection"><a href="index.php?genres">Жанры</a></h4>
    </div>
    <div class="search">
        <input class="input-number" pattern="[А-Яа-я]" id="search" type="text" placeholder="найти книгу,автора">
        <img style="margin-left: -28px;"src="assets/src/icons/search.svg" alt="search">
    </div>
    <div class="reg_auth_btns">
        <button onclick="window.location.href = 'reg.php'" id="signUp" class="reg-btn">регистрация</button>
        <button onclick="window.location.href = 'auth.php'" id="logout" class="auth-btn">авторизация</button>
    </div>
    <div id="display"></div>
    <div id="profile"class="profile">
        <a href="profile.php"><img id="icon_profile" width=50 src="assets/src/icons/profile.svg" alt="profile"></a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="assets/js/search.js"></script>
</header>
<style>
    #display {
        position: absolute;
        margin-left: 600px;
        color: white;
        top: 100px;
        background-color: white;
        border-radius: 25px;
        border: 1px solid black;
        align-items: center
    }
    .animate {
        animation: shake .3s;
    }
    @keyframes shake {
        25% { transform: translateX(5px)}
        50% { transform: translateX(-5px)}
        50%: { transform: translateX(5px)}
    }

</style>
