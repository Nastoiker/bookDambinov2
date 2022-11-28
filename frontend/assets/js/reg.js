$(document).ready(function() {

    // Обработчик события keyup, сработает после того как пользователь отпустит кнопку, после ввода чего-либо в поле поиска.
    // Поле поиска из файла 'index.php' имеет id='search'
    $('body').on('input', '.input-number', function(){
        this.value = this.value.replace(/[^а-я]/g, '');
        // if( this.value === '') {};

    });
    $("#regBtn").click(function() {
        let email = $('#emailInput').val();
        let login = $('#loginInput').val();
        let password = $('#passwordInput').val();
        const res = { email: email, login: login, password};
        const jsonres = JSON.stringify(res);
        else {
            const res = JSON.stringify({ name: value});
            $("#display").css({"padding": '10px'});
            $.ajax({
                method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
                url: `http://bookservice:88/user/registration`,
                data: jsonres,
                success: function(response) {
                    $("#display").empty();
                    response.result.forEach((e) => {
                        $("#display").append(`<a href="./book.php?id=${e.book.id}">${e.book.name}</a><br>`);
                    })
                },
                error: function(){
                    $("#search").addClass('animate')
                }
            });// Указываем путь к обработчику. То есть указывем куда будем отправлять данные на сервере.
        }

    });

});