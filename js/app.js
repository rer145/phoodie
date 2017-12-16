// var config = {
//     apiKey: "AIzaSyAepagqgcRDo0X5fYjLf7YjcP04s38tBg0",
//     authDomain: "foodie-c6a25.firebaseapp.com",
//     databaseURL: "https://foodie-c6a25.firebaseio.com",
//     projectId: "foodie-c6a25",
//     storageBucket: "",
//     messagingSenderId: "447273589610"
// };
// firebase.initializeApp(config);




$(document).ready(function () {
    //$('.add-to-cart').click(function() {
    $('body').on('click', '.add-to-cart', function() {
        id = $(this).data('id');
        console.log(id);
        addToCart(id);
    });

    $('#signup-button').click(function() {
        email = $('#email_textbox').val();
        password = $('#password_textbox').val();
        registerUser(email, password)
    });

    $('#login-button').click(function() {
        email = $('#email_textbox').val();
        password = $('#password_textbox').val();
        loginUser(email, password)
    });
});

function registerUser(email, password) {
    $.ajax({
        url: 'ajax.php',
        dataType: 'json',
        method: 'GET',
        data: { method: "register_user", email: email, password: password }
    }).done(function(data) {
        console.log(data);
        if (!data.id) {
            $('#signup-error').show();
            $('#error-message').val(data.message);
        } else {
            window.location.href = 'login.php';
        }
    }).fail(function(msg) {
        console.log(msg);
    })
}

function loginUser(email, password) {
    $.ajax({
        url: 'ajax.php',
        dataType: 'json',
        method: 'GET',
        data: { method: "validate_user", email: email, password: password }
    }).done(function(data) {
        console.log(data);
        if (!data.id) {
            $('#login-error').show();
            $('#login-message').text(data.message);
        } else {
            window.location.href = 'choose.php';
        }
    }).fail(function(msg) {
        console.log(msg);
    })
}


function initSwipe() {
    var swiper = new Swiper('.swiper-container', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows : true,
        },
        pagination: {
            el: '.swiper-pagination',
        },
    });

    swiper.on('slideChange', function() {
        //remove slide from list, depending on right/left
        //console.log(swiper);
    });
}

function getFoodChoices() {
    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "get_food" }
        }).done(function(data) {
            console.log(data);

            var food = data;
            if (food.length > 0) {
                var items = [];
                for (var i = 0; i < food.length; i++) {
                    items.push('<div id="option' + food[i].id + '-slide" class="swiper-slide"><img src="' + food[i].photo_url + '" /><br /><p><strong>' + food[i].name + ' - $' + food[i].price + '</strong></p><p>' + food[i].description + '</p><p><a href="#" class="add-to-cart btn btn-primary" data-id="' + food[i].id + '">Add to Cart</a> <a href="info.php?id=' + food[i].id + '" class="more-info btn btn-danger" data-id="' + food[i].id + '">More Info</a></p></div>');
                }
                $('.swiper-wrapper').html(items.join(""));
            }
        }).fail(function(msg) {
            console.log(msg);
        })
    ).then(function() {
        initSwipe();
    });
}

function addToCart(id) {
    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "add_to_cart", id: id }
        }).done(function(data) {
            console.log(data);
            //update cart item, show checkout button
            //show message
        }).fail(function(msg) {
            console.log(msg);
        })
    );
}

function loadCart() {
    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "get_cart" }
        }).done(function(data) {
            console.log(data);
            if (data.length > 0) {
                var items = [];
                for (var i = 0; i < data.length; i++) {
                    items.push('<li>' + data[i].name + '</li>');
                }
                $('#cart').html('<ul>' + items.join("") + '</ul>');
            }
        }).fail(function(msg) {
            console.log(msg);
        })
    );
}

function loadFoodInfo(id) {
    if (!id) {
        id = getParameterByName('id');
    }

    console.log(id);
}