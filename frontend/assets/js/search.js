$(document).ready(function() {

    // Обработчик события keyup, сработает после того как пользователь отпустит кнопку, после ввода чего-либо в поле поиска.
    // Поле поиска из файла 'index.php' имеет id='search'
    $("#search").keyup(function() {

        var name = $('#search').val();
        if (name === "") {
            $("#display").html("");
        }
        else {
            $("#display").css({"padding": '10px'});
            $.ajax({
                type: "get", // Указываем что будем обращатся к серверу через метод 'POST'
                url: `http://bookservice:88/books/name//${name}`, // Указываем путь к обработчику. То есть указывем куда будем отправлять данные на сервере.
                success: function(response) {
                    response.result.forEach( e =>{
                        console.log(e);
                        $("#display").append(`<a class="a" href="./book.php?id=${e.book.id}">${e.book.name}</a><br>`);
                    }
                    )
                }
            });

        }

    });

});

function fill(Value) {
    // Функция 'fill', является обработчиком события 'click'.
    // Она вызывается, когда пользователь кликает по элементу из результата поиска.

    $('#search').val(Value); // Берем значение элемента из результата поиска и добавляем его в значение поля поиска

    $('#display').hide(); // Скрываем результаты поиска

}
