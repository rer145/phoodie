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
        <script src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
        <script src="js/app.js"></script>
        <script src="js/util.js"></script>
        
        <title>Foodie</title>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-3 text-left">
                        <!-- <span class="glyphicon glyphicon-user"></span> -->
                    </div>
                    <div class="col-xs-6 text-center">
                        <span id="logo-small"><a href="index.html">Foodie</a></span>
                    </div>
                    <div class="col-xs-3 text-right">
                        <!-- <span class="glyphicon glyphicon-user"></span> -->
                    </div>
                </div>
            </div>
        </nav>
        
        <div id="body" class="container-fluid">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p><a id="login-button" href="login.php" class="btn btn-lg btn-primary">Login</a></p>
                    <p><a id="signup-button" href="signup.php" class="btn btn-lg btn-info">Sign Up</a></p>
                </div>
            </div>
        </div>
        
    </body>
</html>