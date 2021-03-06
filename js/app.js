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
        addToCart(id);
    });

    $('body').on('click', '.remove-cart', function() {
        id = $(this).data('id');
        removeFromCart(id);
    });

    $('body').on('click', '.more-info', function() {
        id = $(this).data('id');
        loadFoodInfo(id);
    });

    $("#food-info-close").click(function() {
        $("#food-info").hide();
        return false;
    });

    $('#signup-button').click(function() {
        name = $('#name_textbox').val();
        email = $('#email_textbox').val();
        password = $('#password_textbox').val();
        registerUser(name, email, password)
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

    $("#purchase-button").click(function() {
        completePurchase();
        return false;
    });

    $("#checkout-button").click(function() {
        st = $("#cart-subtotal").text();
        df = $("#cart-deliveryfee").text();
        t = $("#cart-total").text();
        window.location.href = 'confirm.php?st=' + st + ' &df=' + df + '&t=' + t;
    });

    $("#address_select_temp").click(function() {
        $("#temp-address-form").show();
    });
    $("#address_select_default").click(function() {
        $("#temp-address-form").hide();
    });

    $("#cc_select_temp").click(function() {
        $("#temp-cc-form").show();
    });
    $("#cc_select_default").click(function() {
        $("#temp-cc-form").hide();
    });


    // if ('serviceWorker' in navigator) {
    //     navigator.serviceWorker
    //         .register('./service-worker.js')
    //         .then(function() {
    //             console.log('[ServiceWorker] Registered');
    //         });
    // }
});

function registerUser(name, email, password) {
    $.ajax({
        url: 'ajax.php',
        dataType: 'json',
        method: 'GET',
        data: { method: "register_user", name: name, email: email, password: password }
    }).done(function(data) {
        //console.log(data);
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
        //console.log(data);
        if (!data.id) {
            $('#login-error').show();
            $('#login-message').text(data.message);
        } else {
            if (!(data.default_address1) || data.default_address1 == "") {
                window.location.href = 'account.php';
            } else {
                window.location.href = 'choose.php';
            }
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
            //console.log(data);

            var food = data;
            if (food.length > 0) {
                var items = [];
                for (var i = 0; i < food.length; i++) {
                    items.push('<div id="option' + food[i].id + '-slide" class="swiper-slide"><img src="img/' + food[i].photo_url + '" class="img-responsive" /><br /><p><strong>' + food[i].name + ' - $' + food[i].price + '</strong></p><p>' + food[i].restaurant + '</p><p class="text-center"><div class="row"><div class="col-xs-4 text-center"><a href="#" class="add-to-cart btn btn-success" data-id="' + food[i].id + '">Add Item</a></div><div class="col-xs-4 text-center"><a href="#" class="more-info btn btn-info" data-id="' + food[i].id + '">Info</a></div><div class="col-xs-4 text-center"><a href="cart.php" class="btn btn-primary">Checkout</a></div></div></p></div>');
                }
                $('.swiper-wrapper').html(items.join(""));
            }
        }).fail(function(msg) {
            console.log(JSON.stringify(msg));
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
            console.log("done: " + JSON.stringify(data));
        }).fail(function(msg) {
            console.log("fail: " + JSON.stringify(msg));
        })
    ).then(function() {
        $("#cart-success").show();
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
            console.log("done: " + JSON.stringify(data));
            $("#cartitem-" + id).remove();
            if ($("#cart").empty()) {
                showEmptyCart();
            }
        }).fail(function(msg) {
            console.log("fail: " + JSON.stringify(msg));
        })
    ).then(function() {
        $("#cart-success").show();
        $("#cart-success-message").html("Item was removed successfully!");
        window.setTimeout(function() {
            $("#cart-success").slideUp(500, function() {
                $(this).hide();
            });
        }, 1000);
    });
}

function loadCart() {
    var subtotal = 0;
    var deliveryfee = 1.50;
    var total = 0;

    var items = [];

    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "get_cart" }
        }).done(function(data) {
            //console.log(data);
            
            if (data != "" && data.length > 0) {
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
    ).then(function() {
        if (items.length == 0) {
            deliveryfee = 0.0;
        } else {
            deliveryfee *= items.length;
        }

        total = subtotal + deliveryfee;
        $("#cart-subtotal").html(formatCurrency(subtotal));
        $("#cart-deliveryfee").html(formatCurrency(deliveryfee));
        $("#cart-total").html(formatCurrency(total));
    });
}

function showEmptyCart() {
    $("#cart").html('<div class="row"><div class="col-xs-12 text-center"><p>There are no items in your cart. <a href="choose.php">Start Swiping!</a></p></div></div>');
}

function loadFoodInfo(id) {
    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "get_food_info", id: id }
        }).done(function(data) {
            console.log("done: " + JSON.stringify(data));
            $("#food-info-name").html(data.name);
            $("#food-info-restaurant").html(data.restaurant);
            $("#food-info-description").html(data.description);
            $("#food-info-price").html(formatCurrency(data.price));
        }).fail(function(msg) {
            console.log("fail: " + JSON.stringify(msg));
        })
    ).then(function() {
        $("#food-info").show();
    });
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

function loadCheckoutInfo() {
    st = getParameterByName('st');
    df = getParameterByName('df');
    t = getParameterByName('t');
    
    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "get_account" }
        }).done(function(data) {
            console.log("done: " + data);
            address = data.name + '<br />';
            address += data.default_address1;
            if (data.default_address2 != "")
                address += '<br />' + data.default_address2;
            address += '<br />' + data.default_city + ', ' + data.default_state + ' ' + data.default_zip;
            $("#confirm-default-address").html(address);

            cc = data.default_cc_name + '<br />' + data.default_cc_number.substring(0, 4) + '...<br />';
            cc += data.default_cc_exp_mo + ' / ' + data.default_cc_exp_yr;
            $("#confirm-default-cc").html(cc);

            $("#cart-subtotal").html(st);
            $("#cart-deliveryfee").html(df);
            $("#cart-total").html(t);
        }).fail(function(msg) {
            console.log("fail: " + JSON.stringify(msg));
        })
    );
}

function loadConfirmation() {
    var d1 = new Date (),
        d2 = new Date ( d1 );
        d2.setMinutes ( d1.getMinutes() + 30 );

    h = d2.getHours();
    if (d2.getHours() == 0)
        h = '12';
    if (d2.getHours() > 12)
        h = d2.getHours() - 12;

    m = d2.getMinutes();
    if (m < 10)
        m = '0' + String(m);

    ampm = 'AM';
    if (d2.getHours() > 12)
        ampm = 'PM';

    $("#confirm-delivery-date").html(d2.getMonth() + '/' + d2.getDate() + '/' + d2.getFullYear() + ' ' + h + ':' + m + ' '  + ampm + '.');
}

function completePurchase() {
    $.when(
        $.ajax({
            url: 'ajax.php',
            dataType: 'json',
            method: 'GET',
            data: { method: "complete_purchase" }
        }).done(function(data) {
            console.log("done: " + data);
        }).fail(function(msg) {
            console.log("fail: " + JSON.stringify(msg));
        })
    ).then(function() {
        window.location.href = 'complete.php';
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

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}