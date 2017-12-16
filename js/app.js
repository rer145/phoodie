var config = {
    apiKey: "AIzaSyAepagqgcRDo0X5fYjLf7YjcP04s38tBg0",
    authDomain: "foodie-c6a25.firebaseapp.com",
    databaseURL: "https://foodie-c6a25.firebaseio.com",
    projectId: "foodie-c6a25",
    storageBucket: "",
    messagingSenderId: "447273589610"
};
firebase.initializeApp(config);




$(document).ready(function () {
    $('.add-to-cart').click(function() {
        id = $(this).data('id');
        console.log(id);
        addToCart(id);
    });

    $('#login-button').click(function() {
        email = $('#email_textbox').val();
        password = $('#password_textbox').val();


        firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
            var errorCode = error.code;
            var errorMessage = error.message;
            if (errorMessage != "") {
                // alert("There was an error trying to login.");
                // console.log(errorCode);
                // console.log(errorMessage);
                $("#login-error").show();
                $("#error-message").val(errorCode + " - " + errorMessage);
            } else {
                window.location.href = 'choose.html';
            }
        });
    });

    $('#signup-button').click(function() {
        email = $('#email_textbox').val();
        password = $('#password_textbox').val();

        firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error) {
            var errorCode = error.code;
            var errorMessage = error.message;

            if (errorMessage != "") {
                $("#signup-error").show();
                $("#error-message").val(errorCode + " - " + errorMessage);
                //alert("There was an error trying to sign up.");
                //console.log(errorCode);
                //console.log(errorMessage);
            } else {
                firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    if (errorMessage != "") {
                        //alert("The user was registered but unable to login automatically.");
                        //console.log(errorCode);
                        //console.log(errorMessage);
                        $("#signup-error").show();
                        $("#error-message").innerText(errorCode + " - " + errorMessage);
                    } else {
                        window.location.href = 'choose.html';
                    }
                });
            }
        });

        return false;
    });
});


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

function addToCart(id) {

}

function loadFoodInfo(id) {
    if (!id) {
        id = getParameterByName('id');
    }

    console.log(id);
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
            if (food.length > 1) {
                var items = [];
                for (var i = 0; i < food.length; i++) {
                    items.push('<div id="option' + food[i].id + '-slide" class="swiper-slide"><img src="' + food[i].photo_url + '" /><br /><p><strong>' + food[i].name + ' - $' + food[i].price + '</strong></p><p>' + food[i].description + '</p><p><a href="#" class="add-to-cart btn btn-primary" data-id="' + food[i].id + '">Add to Cart</a> <a href="info.html?id=' + food[i].id + '" class="more-info btn btn-danger" data-id="' + food[i].id + '">More Info</a></p></div>');
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