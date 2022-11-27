<header>
    <div>

    </div>
    <div class="logo" onclick="window.location.href =`./index.php`"><img src="assets/src/icons/logo.svg"  width="100px" alt="logo"></div>
    <div class="categories">
        <h4><a href="books.php">Книги</a></h4>
        <h4><a href="">Рейтинг</a></h4>
        <h4><a href="">Жанры</a></h4>
    </div>
    <div class="search">
        <input class="input-number" pattern="[А-Яа-я]" id="search" type="text" placeholder="найти книгу">
        <img style="margin-left: -28px;"src="assets/src/icons/search.svg" alt="search">
    </div>
    <div class="reg_auth_btns">
        <button onclick="window.location.href = 'reg.php'" class="reg-btn">регистрация</button>
        <button onclick="window.location.href = 'auth.php'" class="auth-btn">авторизация</button>
    </div>
    <div id="display"></div>
    <div class="profile">
        <a href="profile.php"><img src="assets/src/icons/profile.svg" alt="profile"></a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="assets/js/search.js"></script>
</header>
<style>
    #display {
        position: fixed;
        margin-top: 200px;
        margin-left: 600px;
        color: white;
        background-color: white;
        border-radius: 25px;
        border: 1px solid black;
    }

</style>