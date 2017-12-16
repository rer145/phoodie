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

    $('body').on('click', '.remove-cart', function() {
        id = $(this).data('id');
        console.log(id);
        removeFromCart(id);
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
                    items.push('<div id="option' + food[i].id + '-slide" class="swiper-slide"><img src="img/' + food[i].photo_url + '" class="img-responsive" /><br /><p><strong>' + food[i].name + ' - $' + food[i].price + '</strong></p><p>' + food[i].description + '</p><p class="text-center"><div class="row"><div class="col-xs-4 text-center"><a href="#" class="add-to-cart btn btn-success" data-id="' + food[i].id + '"><span class="glyphicon glyphicon-plus-sign"></span></a></div><div class="col-xs-4 text-center"><a href="info.php?id=' + food[i].id + '" class="more-info btn btn-info" data-id="' + food[i].id + '"><span class="glyphicon glyphicon-info-sign"></span></a></div><div class="col-xs-4 text-center"><a href="cart.php" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span></a></div></div></p></div>');
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
            console.log("done: " + data);
        }).fail(function(msg) {
            console.log("fail: " + msg);
        })
    ).then(function() {
        console.log("show modal");
        $("#cart-success").show();
        console.log("slide up");
        window.setTimeout(function() {
            $("#cart-success").slideUp(500, function() {
                $(this).hide();
            });
        }, 1500);
    });
}

function removeFromCart(id) {
    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "remove_from_cart", id: id }
        }).done(function(data) {
            console.log("done: " + data);
            $("#cartitem-" + id).remove();
            if ($("#cart").empty()) {
                showEmptyCart();
            }
        }).fail(function(msg) {
            console.log("fail: " + msg);
        })
    ).then(function() {
        console.log("show modal");
        $("#cart-success").show();
        $("#cart-success-message").html("Item was removed successfully!");
        console.log("slide up");
        window.setTimeout(function() {
            $("#cart-success").slideUp(500, function() {
                $(this).hide();
            });
        }, 1500);
    });
}

function loadCart() {
    subtotal = 0;
    deliveryfee = 3.0;
    total = 0;

    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "get_cart" }
        }).done(function(data) {
            console.log(data);
            
            if (data != "" && data.length > 0) {
                var items = [];
                for (var i = 0; i < data.length; i++) {
                    items.push('<div id="cartitem-' + data[i].id + '"><div class="row form-inline"><div class="col-xs-8 text-left">' + data[i].name + '<br /><a href="#" class="remove-cart small" data-id="' + data[i].id + '">Remove</a></div><div class="col-xs-4 text-right">$' + data[i].price + '</div></div><hr /></div>');

                    subtotal += (data[i].price * data[i].quantity);
                }
                $('#cart').html(items.join(""));
            } else {
                showEmptyCart();
            }
        }).fail(function(msg) {
            console.log(msg);
        })
    );

    total = subtotal + deliveryfee;
    $("#cart-subtotal").html(formatCurrency(subtotal));
    $("#cart-deliveryfee").html(formatCurrency(deliveryfee));
    $("#cart-total").html(formatCurrency(total));
}

function showEmptyCart() {
    $("#cart").html('<div class="row"><div class="col-xs-12 text-center"><p>There are no items in your cart. <a href="choose.php">Start Swiping!</a></p></div></div>');
}

function loadFoodInfo(id) {
    if (!id) {
        id = getParameterByName('id');
    }

    console.log(id);
}


function formatCurrency(val) {
    return '$' + parseFloat(val, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
}