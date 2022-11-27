$(document).ready(function() {

    // Обработчик события keyup, сработает после того как пользователь отпустит кнопку, после ввода чего-либо в поле поиска.
    // Поле поиска из файла 'index.php' имеет id='search'
    $('body').on('input', '.input-number', function(){
        this.value = this.value.replace(/[^а-я]/g, '');
    });
    $("#search").keyup(function() {

        let name = $('#search').val();
        name.replace(' ', '');
        if (name === "" || name.includes(' ')) {
            $("#display").empty();
            $("#display").css({"padding": '0px'});
        }
        else {
            $("#display").css({"padding": '10px'});
            $.ajax({
                type: "get", // Указываем что будем обращатся к серверу через метод 'POST'
                url: `http://bookservice:88/books/name/${name}`,
                success: function(response) {
                    $("#display").empty();
                    response.result.forEach( e =>{
                            console.log(e);
                        $("#display").append(`<a href="./book.php?id=${e.book.id}">${e.book.name}</a><br>`);
                    }
                    )
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
