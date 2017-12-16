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
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="choose.php">Phoodie</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="cart.php">My Cart</a></li>
                        <li><a href="choose.php">Find Food</a></li>
                        <li><a href="account.php">My Account</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
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
                    <p><a href="" class="btn btn-lg btn-primary">Checkout</a></p>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            loadCart();
        </script>
        
    </body>
</html>