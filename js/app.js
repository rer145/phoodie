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

    $("#address-button").click(function() {
        address1 = $("#address1_textbox").val();
        address2 = $("#address2_textbox").val();
        city = $("#city_textbox").val();
        state = $("#state_dropdown").val();
        zip = $("#zip_textbox").val();
        phone = $("#phone_textbox").val();
        updateDefaultAddress(address1, address2, city, state, zip, phone);
        return false;
    });

    $("#cc-button").click(function() {
        name = $("#ccname_textbox").val();
        number = $("#ccnumber_textbox").val();
        cvv = $("#cccvv_textbox").val();
        expmo = $("#ccexpmo_textbox").val();
        expyr = $("#ccexpyr_textbox").val();
        zip = $("#cczip_textbox").val();
        updateDefaultCC(name, number, cvv, expmo, expyr, zip);
        return false;
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
            window.location.href = 'account.php';
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
        }, 1000);
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
        }, 1000);
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

function loadAccountInfo() {
    $.ajax({
        url: 'ajax.php',
        dataType: 'json',
        method: 'GET',
        data: { method: "get_account" }
    }).done(function(data) {
        console.log("done: " + data);
        $("#address1_textbox").val(data.default_address1);
        $("#address2_textbox").val(data.default_address2);
        $("#city_textbox").val(data.default_city);
        $("#state_dropdown").val(data.default_state);
        $("#zip_textbox").val(data.default_zip);
        $("#phone_textbox").val(data.default_phone);

        $("#ccname_textbox").val(data.default_cc_name);
        $("#ccnumber_textbox").val(data.default_cc_number);
        $("#cccvv_textbox").val(data.default_cc_cvv);
        $("#ccexpmo_dropdown").val(data.default_cc_expmo);
        $("#ccexpyr_textbox").val(data.default_cc_expyr);
        $("#cczip_textbox").val(data.default_cc_zip);
    }).fail(function(msg) {
        console.log("fail: " + JSON.stringify(msg));
    });
}


function updateDefaultAddress(address1, address2, city, state, zip, phone) {
    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "update_address", address1: address1, address2: address2, city: city, state: state, zip: zip, phone: phone }
        }).done(function(data) {
            console.log("done: " + data);
        }).fail(function(msg) {
            console.log("fail: " + JSON.stringify(msg));
        })
    ).then(function() {
        $("#address-success").show();
        window.setTimeout(function() {
            $("#address-success").slideUp(500, function() {
                $(this).hide();
            });
        }, 1000);
    });
}

function updateDefaultCC(name, number, cvv, expmo, expyr, zip) {
    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "update_cc", name: name, number: number, cvv: cvv, expmo: expmo, expyr: expyr, zip: zip }
        }).done(function(data) {
            console.log("done: " + data);
        }).fail(function(msg) {
            console.log("fail: " + JSON.stringify(msg));
        })
    ).then(function() {
        $("#cc-success").show();
        window.setTimeout(function() {
            $("#cc-success").slideUp(500, function() {
                $(this).hide();
            });
        }, 1000);
    });
}



function formatCurrency(val) {
    return '$' + parseFloat(val, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
}