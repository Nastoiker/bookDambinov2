console.log(localStorage);

switch (localStorage.role) {
    case 'admin': {
        window.location.href = 'admin.php'
    }
    case 'user': {
        document.querySelector('.reg_auth_btns').style = "display: none";
        document.getElementById("icon_profile").src=`Static/avatars/${localStorage.getItem('image')}`;
        document.getElementById('profile').innerHTML+=`<div style="padding-left: 20%"><h5>${localStorage.getItem('login')}</h5><h5>${localStorage.getItem('email')}</h5></div>`
    }
}
$(document).ready(function() {

    // Обработчик события keyup, сработает после того как пользователь отпустит кнопку, после ввода чего-либо в поле поиска.
    // Поле поиска из файла 'index.php' имеет id='search'
    $('body').on('input', '.input-number', function(){
        this.value = this.value.replace(/[^а-я]/g, '');
        // if( this.value === '') {};

    });
    $("#search").keyup(function() {
        $("#search").removeClass('animate');
        let value = $('#search').val();
        value.replace(' ', '');
        if (value === "" || value.includes(' ')) {
            $("#display").empty();

            $("#display").css({"padding": '0px'});
        }
        else {
            const res = JSON.stringify({ name: value});
            $("#display").css({"padding": '10px'});
            $.ajax({
                method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
                url: `http://bookservice:88/books/name`,
                data: res,
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

function fill(Value) {
    // Функция 'fill', является обработчиком события 'click'.
    // Она вызывается, когда пользователь кликает по элементу из результата поиска.

    $('#search').val(Value); // Берем значение элемента из результата поиска и добавляем его в значение поля поиска

    $('#display').hide(); // Скрываем результаты поиска

}
