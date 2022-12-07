console.log(localStorage);

switch (localStorage.
    role) {
    case 'admin': {
        window.location.href = 'admin.php'
    }
    case 'user': {
        document.querySelector('.reg-btn').style = "display: none";
        document.getElementById('logout').innerHTML = 'выйти';
        document.getElementById("icon_profile").src=`Static/avatars/${localStorage.getItem('avatar')}`;
        document.getElementById('profile').innerHTML+=`<div style="padding-left: 20%"><h5>${localStorage.getItem('login')}</h5><h5>${localStorage.getItem('email')}</h5></div>`
    }
}
$(document).ready(function() {


    $('body').on('input', '.input-number', function(){
        this.value = this.value.replace(/[^А-Яа-я]/g, '');
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
            $.ajax({
                method: "POST",
                url: `http://bookservice:88/books/name`,
                data: res,
                success: function(response) {
                    $("#display").css({"padding": '10px'});
                    $("#display").empty();
                    response.result.forEach((e) => {
                        $("#display").append(`<a href="./author.php?id=${e.book.id}">${e.book.name}</a><br>`);
                         console.log(e.book.name);
                    });
                   
                },
                error: function(){
                    $.ajax({
                        method: "POST",
                        url: `http://bookservice:88/authors/name`,
                        data: res,
                        success: function(response) {
                            $("#display").empty();
                            response.result.forEach((e) => {
                                $("#display").append(`<a href="./author.php?id=${e.author.id}">${e.author.firstName + ' '+ e.author.lastname}</a><br>`);
                            });
                            console.log(
                              e.author.firstName + " " + e.author.lastname
                            );
                        },
                        error: function(){
                            if($("#display").html() == '') {
                                $("#display").css({"padding": '0'});
                                console.log(0);
                            } else {
                                $("#display").css({"padding": '10px'});
                            }
                            $("#search").addClass('animate');
                        }
                    });
                }
            });


        }

    });

});

