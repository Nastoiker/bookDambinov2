
var current_fs, next_fs, previous_fs;
var left, opacity, scale;
var animating;
$(".next").click(function(){
    if(animating) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();


    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");


    next_fs.show();
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {

            scale = 1 - (1 - now) * 0.2;

            left = (now * 50)+"%";

            opacity = 1 - now;
            current_fs.css({
                'transform': 'scale('+scale+')',
                'position': 'absolute'
            });
            next_fs.css({'left': left, 'opacity': opacity});
        },
        duration: 800,
        complete: function(){
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

$(".previous").click(function(){
    if(animating) return false;
    animating = true;

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    previous_fs.show();
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            scale = 0.8 + (1 - now) * 0.2;
            left = ((1-now) * 50)+"%";
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
        },
        duration: 800,
        complete: function(){
            current_fs.hide();
            animating = false;
        },
        easing: 'easeInOutBack'
    });
});
var DataImage = new FormData();
$("#msform").submit(function(e){
        e.preventDefault();
        let email = $('#emailInput').val();
        let login = $('#loginInput').val();
        let password = $('#passwordInput').val();
        let image = $('#image_file')[0].files[0];
        DataImage.append('image', image);
        const res1 = { email: email, login: login, password};
        const jsonres = JSON.stringify(res1);
            $("#display").css({"padding": '10px'});
            $.ajax({
                method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
                url: `http://bookservice:88/user/registration`,
                data: jsonres,
                processData: false,
                cache: false,
                success: function (response) {
                    localStorage.setItem('id', response.data.id);
                    localStorage.setItem('email', response.data.email);
                    localStorage.setItem('login', response.data.login);
                    let id = Number(response.data.id);
                    DataImage.append('userId', id);
                    $.ajax({
                        method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
                        url: `http://bookservice:88/user/setavatar`,
                        data: DataImage,
                        processData: false,
                        contentType: false,
                        success: function (e) {
                            localStorage.setItem('image', e.picture);
                            $('.notify').fadeIn(function () {
                                $('.notify').text('успешная регистрация');
                                $('.notify').animate({
                                    'width': '100%',
                                    'left': 0
                                }, 1000).animate({'top': 0});
                            });
                            setTimeout(() => { window.location.href = './index.php'; }, 5000);
                        }
                    });
                },
                error: function () {
                    $('.notify').text('ошибка регистрации');
                    $('.notify').css('background', 'red');
                    $('.notify').fadeIn(function () {
                        $('.notify').animate({
                            'width': '100%',
                            'left': 0
                        }, 1000).animate({'top': 0});
                    });
                }
            });});



// $(document).ready(function() {
//     $('body').on('input', '.input-number', function(){
//         this.value = this.value.replace(/[^а-я]/g, '');
//     });
//     $("#regBtn").click(function() {
//         let email = $('#emailInput').val();
//         let login = $('#loginInput').val();
//         let password = $('#passwordInput').val();
//         const res1 = { email: email, login: login, password};
//         const jsonres = JSON.stringify(res1);
//             const res = JSON.stringify({ name: value});
//             $("#display").css({"padding": '10px'});
//             $.ajax({
//                 method: "POST", // Указываем что будем обращатся к серверу через метод 'POST'
//                 url: `http://bookservice:88/user/registration`,
//                 data: jsonres,
//                 success: function(response) {
//                     $("#display").empty();
//                     response.result.forEach((e) => {
//                         $("#display").append(`<a href="./book.php?id=${e.book.id}">${e.book.name}</a><br>`);
//                     })
//                 },
//                 error: function(){
//                     $("#search").addClass('animate')
//                 }
//             });// Указываем путь к обработчику. То есть указывем куда будем отправлять данные на сервере.
//
//
//     });
//
// });