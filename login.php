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
        
        <title>Phoodie</title>
    </head>
    <body id="page-login">
        <div id="body" class="container-fluid">
            <div class="row">
                <div class="col-xs-12">

                    <p><img src="img/phoodielogo.jpg" class="img-responsive center-block" /></p>

                    <p class="page-title text-center">
                        <span class="glyphicon glyphicon-lock"></span> Login
                    </p>

                    <div id="login-error" class="messages">
                        <div class="alert alert-danger" role="alert">
                            <p><span id="login-message"></span></p>
                        </div>
                    </div>

                    <form id="login" action="">
                        <div class="form-group">
                            <label for="email_textbox">Email</label>
                            <input type="email" class="form-control" id="email_textbox" name="email_textbox" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <label for="password_textbox">Password</label>
                            <input type="password" class="form-control" id="password_textbox" name="password_textbox" placeholder="Password" />
                        </div>
                        <a href="#" id="login-button" class="btn btn-primary">Login</a>
                    </form>

                    <p>&nbsp;</p>

                    <p class="small">No Account? <a href="signup.php">Sign Up for free</a></p>
                </div>
            </div>
        </div>
        
    </body>
</html>