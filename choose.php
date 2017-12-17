<?php
    //session_start();
    include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include_once('head.php'); ?>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
        <link rel="stylesheet" href="css/main.css" />

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
        <script src="js/app.js"></script>
        <script src="js/util.js"></script>

        <title>Phoodie</title>
    </head>
    <body>
        <?php include_once('nav.php'); ?>
        
        <div id="body" class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div id="cart-success" class="alert alert-success messages" role="alert">
                        <p class="text-center">Food Added!</p>
                    </div>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div id="option1-slide" class="swiper-slide"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="food-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">More Information</h3>
                    <button type="button" id="food-info-close" class="close pull-right" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="panel-body">
                    <p><span id="food-info-name"></span><br />
                    from: <span id="food-info-restaurant"></span></p>
                    <p><span id="food-info-description"></span></p>
                    <p><strong>Price: </strong> <span id="food-info-price"></span></p>
                </div>
            </div> 
        </div>

        <script type="text/javascript">
            getFoodChoices();
        </script>
    </body>
</html>