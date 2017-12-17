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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/main.css" />

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/util.js"></script>
        <script src="js/app.js"></script>
        
        <title>Phoodie</title>
    </head>
    <body>
        <?php include_once('nav.php'); ?>
        
        <div id="body" class="container-fluid">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p><span class="page-logo glyphicon glyphicon-shopping-cart"></span></p>
                    <hr />
                    <div id="cart-success" class="alert alert-success messages" role="alert">
                        <p class="text-center"><span id="cart-success-message"></span></p>
                    </div>
                    <div id="cart-fail" class="alert alert-danger messages" role="alert">
                        <p class="text-center"><span id="cart-fail-message"></span></p>
                    </div>
                    <div id="cart"></div>
                    <div class="row">
                        <div class="col-xs-6 col-xs-offset-6 text-right">
                            <strong>Subtotal:</strong> <span id="cart-subtotal"></span><br />
                            <strong>Delivery Fee:</strong> <span id="cart-deliveryfee"></span><br />
                            <strong>Total: </strong> <span id="cart-total"></span>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <p class="text-center"><a href="choose.php" class="btn btn-lg btn-default">Continue Swiping</a></p>
                    <p><a href="#" id="checkout-button" class="btn btn-lg btn-primary">Checkout</a></p>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            loadCart();
        </script>
        
    </body>
</html>